<?php

namespace Cyclogram\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/main")
 */
class ContactPreferencesController extends Controller
{
    /**
     * @Route("/contact_prefs/{studyId}", name="_contact_prefs", defaults={"studyId"= null})
     * @Template()
     */
    public function contactPrefsAction($studyId)
    {
        $participant = $this->get('security.context')->getToken()->getUser();
        
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
    
        //choices
        $reminders = $em->getRepository('CyclogramProofPilotBundle:ParticipantStudyReminder')->findAll();
        $timezones = $em->getRepository('CyclogramProofPilotBundle:ParticipantTimezone')->findAll();
        $contactTimes = $em->getRepository('CyclogramProofPilotBundle:ParticipantContactTime')->findAll();
        $weekdays = array(
                0=>'day_sunday',
                1=>'day_monday',
                2=>'day_tuesday',
                3=>'day_wednesday',
                4=>'day_thursday',
                5=>'day_friday',
                6=>'day_saturday'
        );
        $parameters = array();
        $parameters["expandedForm"] = '';
        
        
        //first we process POST data if any
        if ($request->getMethod() == 'POST') {
        
            $savedata = $request->get('savedata');
            switch($savedata) {
                case 'reminders':
                    foreach($reminders as $reminder)
                    {
                        $reminder_id = $reminder->getParticipantStudyReminderId();
                        $reminderSMS = $request->get('sms_' . $reminder_id) ? true : false;
                        $reminderEmail = $request->get('email_' . $reminder_id) ? true : false;
                        $reminderLink = $em->getRepository('CyclogramProofPilotBundle:ParticipantStudyReminderLink')
                        ->getParticipantReminderLink($participant,$reminder);
                        $reminderLink->setParticipant($participant);
                        $reminderLink->setParticipantStudyReminder($reminder);
                        $reminderLink->setBySMS($reminderSMS);
                        $reminderLink->setByEmail($reminderEmail);
                        $em->persist($reminderLink);
                        $em->flush();
                    }
                    $parameters["expandedForm"] = 'reminders';
                    $parameters['message'] = 'Your contact prefernces have been saved';
                    break;
                case 'date_of_week':
                    foreach ($weekdays as $weekday=>$dayname)
                    {
                        $active = $request->get('weekday_' . $weekday) ? true : false;
                        $em->getRepository('CyclogramProofPilotBundle:ParticipantContactWeekdayLink')
                        ->updateParticipantContactWeekDay($participant, $weekday, $active);
                    }
                    $parameters["expandedForm"] = 'contactweekdays';
                    $parameters['message'] = 'Your contact prefernces have been saved';
                    break;
                case 'time_of_day':
                    foreach ($contactTimes as $contactTime)
                    {
                        $contactTimeId = $contactTime->getParticipantContactTimesId();
                        $active = $request->get('contactTime_' . $contactTimeId) ? true : false;
                        $timezoneid = $request->get('timezone');
                        $timezone = $em->getRepository('CyclogramProofPilotBundle:ParticipantTimeZone')->find($timezoneid);
                        $em->getRepository('CyclogramProofPilotBundle:ParticipantContactTimeLink')
                        ->updateParticipantContactTimeLink($participant, $contactTime, $active, $timezone);
                    }
                    $parameters["expandedForm"] = 'contacttimes';
                    $parameters['message'] = 'Your contact prefernces have been saved';
                    break;
        
            }
        }

        
        //actual data
        $remindersData = array();
        foreach($reminders as $reminder) {
            $reminderLink = $em->getRepository('CyclogramProofPilotBundle:ParticipantStudyReminderLink')
            ->getParticipantReminderLink($participant, $reminder);
            $remindersData[] = array(
                    'reminder' => $reminder,
                    'bySMS' => $reminderLink->getBySMS(),
                    'byEmail' => $reminderLink->getByEmail()
            );
        }
        
        
        //timeofday
        $contactTimesData = array();
        $weekDaysData = array();
        $timezone = 1;
        
        foreach($contactTimes as $contactTime) {
            $contactTimeLink = $em->getRepository('CyclogramProofPilotBundle:ParticipantContactTimeLink')
            ->getParticipantContactTimeLink($participant, $contactTime);
        
            if($contactTimeLink)
                $timezone = $contactTimeLink->getParticipantTimezone()->getParticipantTimezoneId();
        
            $contactTimeId = $contactTime->getParticipantContactTimesId();
             
            if(!isset($contactTimesData[$contactTimeId]) || $contactTimeLink) {
                $contactTimesData[$contactTimeId] = array(
                        'contactTime' => $contactTime,
                        'active' => $contactTimeLink ? true : false
                );
            }
        }
        
        foreach($weekdays as $weekday=>$dayname) {
            $weekdayLink = $em->getRepository('CyclogramProofPilotBundle:ParticipantContactWeekdayLink')
            ->getParticipantContactWeekdayLink($participant, $weekday);
            
            if(!isset($weekDaysData[$weekday]) || $weekdayLink) {
                $weekDaysData[$weekday] = array (
                        'dayname' => $dayname,
                        'dayid' => $weekday,
                        'active' => $weekdayLink ? true : false
                );
            }
            
        }

        $parameters['timezones'] = $timezones;
        $parameters['remindersData'] = $remindersData;
        $parameters['contactTimesData'] = $contactTimesData;
        $parameters['weekDaysData'] = $weekDaysData;
        $parameters['timezone'] = $timezone;
        $parameters["lastaccess"] = new \DateTime();
        $parameters["participant"] = $participant;
         
        if($participant->getFacebookId())
            $parameters["user"]["avatar"] = "http://graph.facebook.com/" . $participant->getParticipantUsername() . "/picture?width=80&height=82";
    
        $parameters["user"]["name"] = $participant->getParticipantFirstname() . ' ' . $participant->getParticipantLastname();
        $parameters["user"]["last_access"] = $participant->getParticipantLastTouchDatetime();
    
        return $this->render('CyclogramFrontendBundle:GeneralSettings:contact_prefs.html.twig', $parameters);
    }
}
