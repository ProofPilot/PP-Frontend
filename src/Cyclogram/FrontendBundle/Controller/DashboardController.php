<?php

namespace Cyclogram\FrontendBundle\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;
use JMS\SecurityExtraBundle\Annotation\Secure;


class DashboardController extends Controller
{
    /**
     * @Route("/main/{studyId}", requirements={"studyId" = "\d+"}, name="_main")
     * @Secure(roles="ROLE_PARTICIPANT")
     * @Template()
     */
    public function indexAction($studyId=0)
    {
        $participant = $this->get('security.context')->getToken()->getUser();
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $surveyscount = $em->getRepository('CyclogramProofPilotBundle:Participant')->getParticipantInterventionsCount($participant);

        $interventionsLinks = $em->getRepository('CyclogramProofPilotBundle:Participant')->getParticipantInterventions($participant);
        $session = $this->getRequest()->getSession();
        
        $parameters = array();
        $parameters['surveycount'] = $surveyscount;

        $parameters['text'] = array(
                "title" => "title",
                "content" => "content");
        $parameters['message'] = array(
                "activity" => "activity");
    
        $parameters["surveys"] = array(
//                 array('title' => 'Take the' . $interventionsLinks[0]->getIntervention()->getInterventionName(),
//                         'content' => 'Follow this link to begin your first follow-up survey.',
//                         'icon' => 'icon_1',
//                         'image' => '/images/sexpro_doit.png'
//                 ),
        );
        $parameters["actions"] = array(
                array('activity' => $this->get('translator')->trans('past_activity.emai_confirmation_status', array(), 'dashboard'),
                        'class' => 'icon1 first'
                ),
                array('activity' => $this->get('translator')->trans('past_activity.mobile_confirmation_status', array(), 'dashboard'),
                        'class' => 'icon2'
                ),
                array('activity' => $this->get('translator')->trans('past_activity.welcome_study', array(), 'dashboard'),
                        'class' => 'icon3'
                ),
                array('activity' => $this->get('translator')->trans('past_activity.mobile_status', array(), 'dashboard'),
                        'class' => 'icon4 last'
                )
        );
        $parameters["assistance"] = array(
                array('info' => $this->get('translator')->trans('what_next_list.help', array(), 'dashboard'), 'class' => 'first'),
                array('info' => $this->get('translator')->trans('what_next_list.how_activate_tests', array(), 'dashboard'),'class' => ''),
                array('info' => $this->get('translator')->trans('what_next_list.reade_instruction', array(), 'dashboard'), 'class' => ''),
                array('info' => $this->get('translator')->trans('what_next_list.collect_speciment', array(), 'dashboard'), 'class' => ''),
                array('info' => $this->get('translator')->trans('what_next_list.other_info', array(), 'dashboard'), 'class' => 'last')
        );
    
        $parameters["lastaccess"] = new \DateTime();
         
        if($this->get('security.context')->isGranted("ROLE_FACEBOOK_USER"))
            $parameters["user"]["avatar"] = "http://graph.facebook.com/" . $participant->getParticipantUsername() . "/picture?width=80&height=82";
        
        if($this->get('security.context')->isGranted("ROLE_GOOGLE_USER"))
            $parameters["user"]["avatar"] = "https://plus.google.com/s2/photos/profile/" . $participant->getGoogleId() . "?sz=80";
        
        $parameters["user"]["name"] = $participant->getParticipantFirstname() . ' ' . $participant->getParticipantLastname();
        $parameters["user"]["last_access"] = $participant->getParticipantLastTouchDatetime();
        
        
        if ($participant->getParticipantEmailConfirmed()){
            if ($session->get('confirmed'))
                $parameters["confirmed"] = $session->get('confirmed');
            $session->invalidate();
            $parameters["confirm_email"] = true;
        } else {
            $parameters["confirm_email"] = false;
            $parameters["email_alert"] = $this->get('translator')->trans('txt_please_verify_email', array(), 'dashboard');
        }

        return $this->render('CyclogramFrontendBundle:Dashboard:main.html.twig', $parameters);
    
    }
}
