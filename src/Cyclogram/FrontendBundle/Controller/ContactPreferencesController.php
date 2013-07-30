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
     * @Route("/contact_prefs", name="_contact_prefs")
     * @Template()
     */
    public function contactPrefsAction()
    {
        $participant = $this->get('security.context')->getToken()->getUser();
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
    
        $reminders = $em->getRepository('CyclogramProofPilotBundle:ParticipantStudyReminder')->findAll();
        $reminderLinks = $em->getRepository('CyclogramProofPilotBundle:ParticipantStudyReminderLink')->findByParticipant($participant);
    
        $remindersData = array();
    
        foreach($reminders as $reminder) {
            $reminderId = $reminder->getParticipantStudyReminderId();
            $reminderLinks = $em->getRepository('CyclogramProofPilotBundle:ParticipantStudyReminderLink')->findBy(
                    array('participant'=>$participant,
                            'participantStudyReminder'=>$reminder));
            $bySMS = false;
            $byEmail = false;
            if($reminderLinks) {
    
                if($reminderLinks[0]->getBySMS() == true) {
                    $bySMS = true;
                }
                if($reminderLinks[0]->getByEmail() == true) {
                    $byEmail = true;
                }
            }
    
    
            $remindersData[] = array(
                    'reminder' => $reminder,
                    'bySMS' => $bySMS,
                    'byEmail' => $byEmail
            );
        }
    
    
        $datetimes = $em->getRepository('CyclogramProofPilotBundle:ParticipantContactTime')->findAll();
        $timezones = $em->getRepository('CyclogramProofPilotBundle:ParticipantTimezone')->findAll();
        $parameters = array();
    
         
    
        $parameters['datetimes'] = $datetimes;
        $parameters['timezones'] = $timezones;
        $parameters['weekdays'] =  array(
                0=>'day_sunday',
                1=>'day_monday',
                2=>'day_tuesday',
                3=>'day_wednesday',
                4=>'day_thursday',
                5=>'day_friday',
                6=>'day_saturday'
        );
    
        if ($request->getMethod() == 'POST') {
    
    
            $savedata = $request->get('savedata');
            switch($savedata) {
                case 'reminders':
                    $reminders = $em->getRepository('CyclogramProofPilotBundle:ParticipantStudyReminder')->findAll();
                    foreach($reminders as $reminder)
                    {
                        $reminder_id = $reminder->getParticipantStudyReminderId();
                        $reminderSMS = $request->get('sms_' . $reminder_id);
                        $reminderEmail = $request->get('email_' . $reminder_id);
                        $reminderLinks = $em->getRepository('CyclogramProofPilotBundle:ParticipantStudyReminderLink')->findBy(
                                array('participant'=>$participant,
                                        'participantStudyReminder'=>$reminder));
    
                        if($reminderLinks) {
                            $participantReminderLink = $reminderLinks[0];
                        } else {
                            $participantReminderLink = new ParticipantStudyReminderLink();
                        }
                        $participantReminderLink->setParticipant($participant);
                        $participantReminderLink->setParticipantStudyReminder($reminder);
                        if($reminderSMS) {
                            $participantReminderLink->setBySMS(true);
                        } else {
                            $participantReminderLink->setBySMS(false);
                        }
                        if($reminderEmail) {
                            $participantReminderLink->setByEmail(true);
                        } else {
                            $participantReminderLink->setByEmail(false);
                        }
                        $em->persist($participantReminderLink);
                        $em->flush();
    
    
    
    
                    }
                    $parameters['message'] = 'Your contact prefernces have been saved';
                    break;
                case 'date_of_week':
                    $parameters['message'] = 'Your contact prefernces have been saved';
                    break;
                case 'time_of_day':
                    $parameters['message'] = 'Your contact prefernces have been saved';
                    break;
    
            }
            $parameters['savedata'] = $savedata;
    
    
    
        }
    
        $remindersData = array();
    
        foreach($reminders as $reminder) {
            $reminderId = $reminder->getParticipantStudyReminderId();
            $reminderLinks = $em->getRepository('CyclogramProofPilotBundle:ParticipantStudyReminderLink')->findBy(
                    array('participant'=>$participant,
                            'participantStudyReminder'=>$reminder));
            $bySMS = false;
            $byEmail = false;
            if($reminderLinks) {
    
                if($reminderLinks[0]->getBySMS() == true) {
                    $bySMS = true;
                }
                if($reminderLinks[0]->getByEmail() == true) {
                    $byEmail = true;
                }
            }
    
    
            $remindersData[] = array(
                    'reminder' => $reminder,
                    'bySMS' => $bySMS,
                    'byEmail' => $byEmail
            );
        }
        $parameters['remindersData'] = $remindersData;
    
    
        $parameters["lastaccess"] = new \DateTime();
        $parameters["participant"] = $participant;
         
        if(!$participant->getFacebookId())
            $parameters["user"]["avatar"] = "/images/tmp_avatar.jpg";
        else
            $parameters["user"]["avatar"] = "http://graph.facebook.com/" . $participant->getParticipantUsername() . "/picture?width=80&height=82";
    
        $parameters["user"]["name"] = $participant->getParticipantFirstname() . ' ' . $participant->getParticipantLastname();
        $parameters["user"]["last_access"] = $participant->getParticipantLastTouchDatetime();
    
        return $this->render('CyclogramFrontendBundle:GeneralSettings:contact_prefs.html.twig', $parameters);
    }
}
