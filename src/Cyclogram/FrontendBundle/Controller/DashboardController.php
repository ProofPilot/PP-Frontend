<?php
/*
* This is part of the ProofPilot package.
*
* (c)2012-2013 Cyclogram, Inc, West Hollywood, CA <crew@proofpilot.com>
* ALL RIGHTS RESERVED
*
* This software is provided by the copyright holders to Manila Consulting for use on the
* Center for Disease Control's Evaluation of Rapid HIV Self-Testing among MSM in High
* Prevalence Cities until 2016 or the project is completed.
*
* Any unauthorized use, modification or resale is not permitted without expressed permission
* from the copyright holders.
*
* KnowatHome branding, URL, study logic, survey instruments, and resulting data are not part
* of this copyright and remain the property of the prime contractor.
*
*/

namespace Cyclogram\FrontendBundle\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * @Route("/main")
 */
class DashboardController extends Controller
{
    /**
     * @Route("/dashboard/{sendMail}", name="_main", defaults={"sendMail"=null})
     * @Secure(roles="ROLE_PARTICIPANT, IS_AUTHENTICATED_REMEMBERED")
     * @Template()
     */
    public function indexAction($sendMail)
    {

        $em = $this->getDoctrine()->getManager();
        $participant = $this->get('security.context')->getToken()->getUser();
        
        if (!is_null($sendMail) && !$em->getRepository('CyclogramProofPilotBundle:Participant')->isEnrolledInStudy($participant, 'sexpro')){
            $cc = $this->get('cyclogram.common');
            $embedded = array();
            $embedded = $cc->getEmbeddedImages();
            $parameters['email'] = $participant->getParticipantEmail();
            $parameters['locale'] = $participant->getLocale() ? $participant->getLocale() : $request->getLocale();
            $parameters['host'] = $this->container->getParameter('site_url');
            $parameters['code'] = $participant->getParticipantEmailCode();
            
            $cc->sendMail(null,
                    $participant->getParticipantEmail(),
                    $this->get('translator')->trans("email_title_verify", array(), "email", $parameters['locale']),
                    'CyclogramFrontendBundle:Email:email_confirmation.html.twig',
                    null,
                    $embedded,
                    true,
                    $parameters);
        }
        
        $request = $this->getRequest();
        $locale = $this->getRequest()->getLocale();
        
        
        $this->get('study_logic')->interventionLogic($participant);
        $this->get('study_logic')->participantDefaultInterventionLogic($participant);

        
        $surveyscount = $em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')->getActiveParticipantInterventionsCount($participant);
        $interventionLinks = $em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')->getActiveParticipantInterventionLinks($participant);

        $session = $this->getRequest()->getSession();
        
        $parameters = array();
        $parameters["interventioncount"] = $surveyscount;


        $parameters["interventions"] = array();
        foreach($interventionLinks as $interventionLink) {
            
            $interventionId = $interventionLink->getIntervention()->getInterventionId();
            $interventionContent = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:Intervention")->getInterventionContent($interventionId, $locale);
            
            $study = $interventionLink->getIntervention()->getStudy();
            $studyId = $study->getStudyId();
            $studyContent = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:StudyContent')->getStudyContentById($studyId, $participant->getLocale());
            
            $intervention = array();
            $intervention["title"] = $interventionContent->getInterventionTitle();
            $intervention["content"] = $interventionContent->getInterventionDescripton();
            if ($study->getStudyCode() == 'defaultparticipant') {
                if ($interventionLink->getIntervention()->getInterventionCode() == 'DefaultParticipantCommunicationPreferences') {
                    $intervention["url"] =  $this->get('router')->generate('_contact_prefs');
                } elseif ($interventionLink->getIntervention()->getInterventionCode() == 'DefaultParticipantShippingInformation') {
                    $intervention["url"] =  $this->get('router')->generate('_shipping');
                }
            } else {
                $intervention["url"] = $this->getInterventionUrl($interventionLink, $locale);
            }
            $intervention["logo"] = $this->container->getParameter('study_image_url') . "/" . $studyId . "/" . $studyContent->getStudyLogo();
            $parameters["studyCode"] = $study->getStudyCode();
            $parameters["interventions"][] = $intervention;
        }
        
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
         
//         if($this->get('security.context')->isGranted("ROLE_FACEBOOK_USER"))
//             $parameters["user"]["avatar"] = "http://graph.facebook.com/" . $participant->getParticipantUsername() . "/picture?width=80&height=82";
        
//         if($this->get('security.context')->isGranted("ROLE_GOOGLE_USER"))
//             $parameters["user"]["avatar"] = "https://plus.google.com/s2/photos/profile/" . $participant->getGoogleId() . "?sz=80";
        
        $parameters["user"]["name"] = $participant->getParticipantFirstname() . ' ' . $participant->getParticipantLastname();
        $parameters["username"] = $participant->getParticipantUsername();
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
    
    
    private function getInterventionUrl($interventionLink, $locale) {
        $intervention = $interventionLink->getIntervention();

        $studyCode = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Intervention')
            ->getInterventionStudyCode($intervention->getInterventionId());
        
        $typeName = $interventionLink->getIntervention()->getInterventionType()->getInterventionTypeName(); 
        switch($typeName) {
            case 'Activity':
                return $intervention->getInterventionUrl();
            case 'Survey & Observation':
                $surveyId = $intervention->getSidId();
                $redirectPath = $this->get('router')->generate('_main');
                $path = $this->get('router')->generate('_survey_protected', array(
                        'studyCode'=>$studyCode,
                        'surveyId'=>$surveyId,
                        'redirectUrl'=>urlencode($redirectPath)
                        
                        ));
                return $path;
            
        }
    }
}
