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
    public function indexAction($studyId=null)
    {
        $participant = $this->get('security.context')->getToken()->getUser();
        $request = $this->getRequest();
        $locale = $this->getRequest()->getLocale();
        
        
        $this->get('fpp_ls')->interventionLogic($participant, $studyId);
        
        $em = $this->getDoctrine()->getManager();
        $surveyscount = $em->getRepository('CyclogramProofPilotBundle:Participant')->getParticipantInterventionsCount($participant);

        $interventionLinks = $em->getRepository('CyclogramProofPilotBundle:Participant')->getParticipantInterventionLinks($participant);
        
        
        
        $session = $this->getRequest()->getSession();
        
        $parameters = array();
        $parameters['surveycount'] = $surveyscount;

        $parameters['text'] = array(
                "title" => "title",
                "content" => "content");
        $parameters['message'] = array(
                "activity" => "activity");
        
        
        $studyContent = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:StudyContent")->getStudyContentById($studyId, $locale);
    
        $parameters["interventions"] = array();
        foreach($interventionLinks as $interventionLink) {
            
            $interventionId = $interventionLink->getIntervention()->getInterventionId();
            $interventionContent = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:Intervention")->getInterventionContent($interventionId, $locale);
            
            $intervention = array();
            $intervention["title"] = $interventionContent->getInterventionTitle();
            $intervention["content"] = $interventionContent->getInterventionDescripton();
            $intervention["url"] = $this->getInterventionUrl($interventionLink, $studyId, $studyContent->getStudyUrl(), $locale);
            
            if($interventionLink->getStatus()->getStatusName() != "Active" ) {
                $intervention["status"] = "Completed";
            } else {
                $intervention["status"] = "Enabled";
            }
            $parameters["interventions"][] = $intervention;
        }
        
        if($studyContent)
            $parameters["logo"] = $this->container->getParameter('study_image_url') . '/' . $studyId. '/' .$studyContent->getStudyLogo();
        

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
    
    
    private function getInterventionUrl($interventionLink, $studyId, $studyUrl, $locale) {
        $intervention = $interventionLink->getIntervention();
        $typeName = $interventionLink->getIntervention()->getInterventionType()->getInterventionTypeName(); 
        switch($typeName) {
            case 'Activity':
                return $intervention->getInterventionUrl();
            case 'Survey & Observation':
                $surveyId = $intervention->getSidId();
                $redirectPath = $this->get('router')->generate('_main', array('studyId'=>$studyId));
                $path = $this->get('router')->generate('_survey', array(
                        'studyId'=>$studyId,
                        'studyUrl'=>$studyUrl, 
                        'surveyId'=>$surveyId,
                        'redirectUrl'=>urlencode($redirectPath)
                        
                        ));
                return $path;
            
        }
    }
}
