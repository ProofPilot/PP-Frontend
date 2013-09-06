<?php

namespace Cyclogram\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
/**
 * @Route("/main")
 * 
 */
class ContactPreferencesController extends Controller
{
    /**
     * @Route("/contact_prefs", name="_contact_prefs")
     * @Secure(roles="ROLE_PARTICIPANT")
     * @Template()
     */
    public function contactPrefsAction()
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
            
            foreach ($weekdays as $weekday=>$dayname)
            {
                foreach ($contactTimes as $contactTime)
                {
                    $isWeekdayActive = $request->get('weekday_' . $weekday) ? true : false;
                    $contactTimeId = $contactTime->getParticipantContactTimesId();
                    $isContactTimeActive = $request->get('contactTime_' . $contactTimeId) ? true : false;
                    $timezoneid = $request->get('timezone');
                    $timezone = $em->getRepository('CyclogramProofPilotBundle:ParticipantTimeZone')->find($timezoneid);
                    $em->getRepository('CyclogramProofPilotBundle:ParticipantContactTimeLink')
                    ->updateParticipantContactTimeLink($participant, $contactTime, $weekday, $timezone, $isWeekdayActive, $isContactTimeActive);
                    $parameters["expandedForm"] = 'contacttimes';
                    $parameters['message'] = 'Your contact prefernces have been saved';
                    
                }
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
            ->getParticipantContactTimeLinkByTime($participant, $contactTime);
        
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
            $contactTimeLinkDay = $em->getRepository('CyclogramProofPilotBundle:ParticipantContactTimeLink')
            ->getParticipantContactTimeLinkByDay($participant, $weekday);
            
            if(!isset($weekDaysData[$weekday])) {
                $weekDaysData[$weekday] = array (
                        'dayname' => $dayname,
                        'dayid' => $weekday,
                        'active' => $contactTimeLinkDay? true : false
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
