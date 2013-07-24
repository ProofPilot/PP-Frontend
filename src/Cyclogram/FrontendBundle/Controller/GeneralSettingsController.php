<?php

namespace Cyclogram\FrontendBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/main")
 */
class GeneralSettingsController  extends Controller
{
    /**
     * @Route("/general_settings", name="_settings")
     * @Template()
     */
    public function generalSettingsAction()
    {
        $participant = $this->get('security.context')->getToken()->getUser();
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $surveyscount = $em->getRepository('CyclogramProofPilotBundle:Participant')->getParticipantInterventions($participant);
        
        $parameters["lastaccess"] = new \DateTime();
         
        if(!$participant->getFacebookId())
            $parameters["user"]["avatar"] = "/images/tmp_avatar.jpg";
        else
            $parameters["user"]["avatar"] = "http://graph.facebook.com/" . $participant->getParticipantUsername() . "/picture?width=80&height=82";
        
        $parameters["user"]["name"] = $participant->getParticipantFirstname() . ' ' . $participant->getParticipantLastname();
        $parameters["user"]["last_access"] = $participant->getParticipantLastTouchDatetime();
        
//         $lastAccessDate = $participant->getParticipantLastTouchDatetime();
        
//         $locale = $request->getLocale();
        
//         echo "Last access: " . $lastAccessDate->format("d F Y, H:i");
        
//         setlocale(LC_TIME, 'nl_NL');
        
        
        
//         echo $locale . " " .  strftime("%d %B %Y, %H:%M", $lastAccessDate->getTimestamp());
//         return new Response("");
        
        
        return $this->render('CyclogramFrontendBundle:GeneralSettings:general_settings.html.twig', $parameters);
    }
    
    /**
     * @Route("/contact_prefs", name="_contact_prefs")
     * @Template()
     */
    public function contactPrefsAction()
    {
        $parameters = array();
        
        $parameters['preferences'] = array(
                array('title' => 'Study Task Reminder Preferences',
                      'subtitle' => 'The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters',
                      'col' => 'col_5',
                      'dontremind' => '',
                      'options' => array(
                        array('row' => 'Remind me to take surveys by'),
                        array('row' => 'Communicate with me about ORDERS by'),
                        array('row' => 'Remind me to participate in STUDY DIRECTORY by'),
                        array('row' => 'Remind me to take TREATMENTS by'),
                        array('row' => 'Remind me about APPOINTMENTS by'),
                        array('row' => 'Remind me to take MEASUREMENTS by'),
                        array('row' => 'Communicate with me about INCENTIVES by'),
                        array('personal' => '',
                              'row' => 'Communicate with me about personal issues'
                              ),
                        array('row' => 'Study News'),
                        array('row' => 'Other studies I might be eliglble for')
                      )
                ),
                array('title' => 'What day of the week suits you best?',
                      'subtitle' => 'The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters',
                      'col' => 'col_4',
                      'timezone' => '',
                      'options' => array(
                        array('row' => 'Early AM (6AM-8AM)'),
                        array('row' => 'Morning (8AM-Noon)'),
                        array('row' => 'Lunchtime (Noon-2PM)'),
                        array('row' => 'Afternoon (1PM-5PM)'),
                        array('row' => 'Early Evening (5PM-7PM)'),
                        array('row' => 'Evening (7PM-9PM)'),
                        array('row' => 'Night (9PM-Midnight)'),
                        array('row' => 'Late Night (midnight-6AM)')
                      )
                ),
                array('title' => 'Study Task Reminder Preferences',
                      'subtitle' => 'The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters',
                      'col' => 'col_4',
                      'options' => array(
                        array('row' => 'Sunday'),
                        array('row' => 'Monday'),
                        array('row' => 'Tuesday'),
                        array('row' => 'Wednesday'),
                        array('row' => 'Thursday'),
                        array('row' => 'Friday'),
                        array('row' => 'Saturday'),
                        array('row' => 'Sunday')
                      )
                )
        );
        
        $participant = $this->get('security.context')->getToken()->getUser();
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $surveyscount = $em->getRepository('CyclogramProofPilotBundle:Participant')->getParticipantInterventions($participant);
        
        $parameters["lastaccess"] = new \DateTime();
         
        if(!$participant->getFacebookId())
            $parameters["user"]["avatar"] = "/images/tmp_avatar.jpg";
        else
            $parameters["user"]["avatar"] = "http://graph.facebook.com/" . $participant->getParticipantUsername() . "/picture?width=80&height=82";
        
        $parameters["user"]["name"] = $participant->getParticipantFirstname() . ' ' . $participant->getParticipantLastname();
        $parameters["user"]["last_access"] = $participant->getParticipantLastTouchDatetime();
        
        return $this->render('CyclogramFrontendBundle:GeneralSettings:contact_prefs.html.twig', $parameters);
    }
}
