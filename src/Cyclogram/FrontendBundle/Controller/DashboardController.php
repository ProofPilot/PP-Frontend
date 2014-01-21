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



use Cyclogram\FrontendBundle\Form\AboutMeForm;

use Cyclogram\FrontendBundle\Form\MailingAddressForm;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        $cc = $this->container->get('cyclogram.common');
        $locale = $this->getRequest()->getLocale();
        
        
        if (!is_null($sendMail)){
            $cc = $this->get('cyclogram.common');
            $embedded = array();
            $embedded = $cc->getEmbeddedImages();
            $parameters['email'] = $participant->getParticipantEmail();
            $parameters['locale'] = $participant->getLocale() ? $participant->getLocale() : $request->getLocale();
            $parameters['host'] = $this->container->getParameter('site_url');
            $parameters['code'] = $participant->getParticipantEmailCode();
            $parameters["studies"] = $em->getRepository('CyclogramProofPilotBundle:Study')->getRandomStudyInfo($locale, $participant);
            
            $cc->sendMail(null,
                    $participant->getParticipantEmail(),
                    $this->get('translator')->trans("email_title_verify", array(), "email", $parameters['locale']),
                    'CyclogramFrontendBundle:Email:email_confirmation.html.twig',
                    null,
                    $embedded,
                    true,
                    $parameters);
        }
        
        $session = $this->getRequest()->getSession();
        
        $request = $this->getRequest();
        
        $this->get('study_logic')->interventionLogic($participant);
        $this->get('study_logic')->participantDefaultInterventionLogic($participant);

        $interventionLinks = $em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')->getActiveParticipantInterventionLinks($participant);

        $parameters = array();
        $parameters["studies"] = $em->getRepository('CyclogramProofPilotBundle:Study')->getRandomStudyInfo($locale, $participant);
        $enrolledStudies = $em->getRepository('CyclogramProofPilotBundle:Participant')->getEnrolledStudies($participant);
        $parameters["enrolledStudies"] = array();
        foreach ($enrolledStudies as $study) {
            $studyContent = $em->getRepository('CyclogramProofPilotBundle:StudyContent')->getStudyContent($study->getStudyCode(), $locale);
            $enroledStudy['studyName'] = $studyContent->getStudyName();
            $enroledStudy['studyUrl'] = $studyContent->getStudyUrl();
            $enroledStudy['studyGraphic'] = $studyContent->getStudyGraphic();
            $site = $em->getRepository('CyclogramProofPilotBundle:Study')->getDefaultSites($study->getStudyId());
            $siteId = $em->getRepository('CyclogramProofPilotBundle:Site')->findOneBySiteName($site[0]['siteName']);
            $siteCampaignLink = $em->getRepository('CyclogramProofPilotBundle:CampaignSiteLink')->findOneBySite($siteId);
            $enroledStudy['studyRefferalShortUrl'] = $cc::generateGoogleShorURL($this->container->getParameter('site_url')."/".$locale."/".$study->getStudyCode()."/?utm_campaign=".$siteCampaignLink->getCampaign()->getCampaignName()."&utm_medium-Clinic&utm_source=".$site[0]['siteName']."&pid=".$participant->getParticipantId());
            $enroledStudy['reffferalFacebookStudyUrl'] = $this->container->getParameter('site_url')."/".$locale."/".$study->getStudyCode()."/?utm_campaign=".$siteCampaignLink->getCampaign()->getCampaignName()."&utm_medium-Clinic&utm_source=".$site[0]['siteName']."&pid=".$participant->getParticipantId();
            $enroledStudy['studyAllowSharing'] = $study->getStudyAllowSharing();
            $enroledStudy["graphic"] = $this->container->getParameter('study_image_url') . '/' .$study->getStudyId(). '/' .$studyContent->getStudyGraphic();
            $enroledStudy['studyContent'] = str_replace(array("\r\n", "\r", "\n"), "", strip_tags($studyContent->getStudyAbout()));
            $parameters["enrolledStudies"][] = $enroledStudy;
        }
        $surveyscount = $em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')->getActiveParticipantInterventionsCount($participant);
        $parameters["interventioncount"] = $surveyscount;

       

        $parameters["interventions"] = array();
        foreach($interventionLinks as $interventionLink) {
            
            $interventionId = $interventionLink->getIntervention()->getInterventionId();
            $interventionContent = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:Intervention")->getInterventionContent($interventionId, $locale);
            
            $study = $interventionLink->getIntervention()->getStudy();
            $studyId = $study->getStudyId();
            $studyContent = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:StudyContent')->getStudyContentById($studyId, $participant->getLocale());
            
            $intervention = array();
            $intervention["name"] = $interventionContent->getInterventionName();
            $intervention["title"] = $interventionContent->getInterventionTitle();
            $intervention["content"] = $interventionContent->getInterventionDescripton();
            $intervention["code"] = $interventionContent->getInterventionCode();
            $site = $em->getRepository('CyclogramProofPilotBundle:Study')->getDefaultSites($studyId);
            $siteId = $em->getRepository('CyclogramProofPilotBundle:Site')->findOneBySiteName($site[0]['siteName']);
            $siteCampaignLink = $em->getRepository('CyclogramProofPilotBundle:CampaignSiteLink')->findOneBySite($siteId);
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
            $interventionTypeName = $interventionLink->getIntervention()->getInterventionType()->getInterventionTypeName();
            $intervention['type'] = $interventionTypeName;
            switch ($interventionTypeName) {
                case "Pledge" :
                    $intervention['reffferalFacebookStudyUrl'] = $this->container->getParameter('site_url')."/".$locale."/".$study->getStudyCode()."/?utm_campaign=".$siteCampaignLink->getCampaign()->getCampaignName()."&utm_medium-Clinic&utm_source=".$site[0]['siteName']."&pid=".$participant->getParticipantId();
                    $intervention['refferalStudyUrl'] = $this->container->getParameter('site_url')."/".$locale."/".$study->getStudyCode()."/?utm_campaign=".$siteCampaignLink->getCampaign()->getCampaignName()."&utm_medium-Clinic&utm_source=".$site[0]['siteName']."&pid=".$participant->getParticipantId();
                    $intervention['reffferalShortStudyUrl'] = $cc::generateGoogleShorURL($this->container->getParameter('site_url')."/".$locale."/".$study->getStudyCode()."/?utm_campaign=".$siteCampaignLink->getCampaign()->getCampaignName()."&utm_medium-Clinic&utm_source=".$site[0]['siteName']."&pid=".$participant->getParticipantId());
                    $intervention['studyName'] = $studyContent->getStudyName();
                    break;
                case "Referral" :
                    $intervention['refferalStudyUrl'] = $this->container->getParameter('site_url')."/".$locale."/".$study->getStudyCode()."/?utm_campaign=".$siteCampaignLink->getCampaign()->getCampaignName()."&utm_medium-Clinic&utm_source=".$site[0]['siteName']."&pid=".$participant->getParticipantId();
                    $intervention['reffferalShortStudyUrl'] = $cc::generateGoogleShorURL($this->container->getParameter('site_url')."/".$locale."/".$study->getStudyCode()."/?utm_campaign=".$siteCampaignLink->getCampaign()->getCampaignName()."&utm_medium-Clinic&utm_source=".$site[0]['siteName']."&pid=".$participant->getParticipantId());
                    $intervention['reffferalFacebookStudyUrl'] = $this->container->getParameter('site_url')."/".$locale."/".$study->getStudyCode()."/?utm_campaign=".$siteCampaignLink->getCampaign()->getCampaignName()."&utm_medium-Clinic&utm_source=".$site[0]['siteName']."&pid=".$participant->getParticipantId();
                    $intervention['studyName'] = $studyContent->getStudyName();
                    $intervention['studyContent'] = str_replace(array("\r\n", "\r", "\n"), "", strip_tags(substr($studyContent->getStudyAbout(), 0,250)));
                    $intervention["graphic"] = $this->container->getParameter('study_image_url') . '/' .$study->getStudyId(). '/' .$studyContent->getStudyGraphic();
                    break;
                case "Shipping Info" :
                    $formShippingInformation = $this->createForm(new MailingAddressForm($this->container));
                    $parameters['form'] =  $formShippingInformation->createView();
                    break;
                case "About Me Info" :
                    $formAboutMe = $this->createForm(new AboutMeForm($this->container));
                    $parameters['form'] =  $formAboutMe->createView();
                    $parameters["expandedFormClass"] = '';
                    $interested = $participant->getParticipantInterested();
                    if (isset($interested) && $interested == 'w') {
                        $parameters['interest'] = 'Woman';
                    } elseif (isset($interested) && $interested == 'm') {
                        $parameters['interest'] = 'Man';
                    } elseif (isset($interested) && $interested == 'mw') {
                        $parameters['interest'] = 'Man&Woman';
                    }else {
                        $parameters['interest'] = "";
                    }
                    break;
                    
            }


            $parameters["studyCode"] = $study->getStudyCode();
          
            $parameters['shortstudyUrl'] = $cc::generateGoogleShorURL($this->container->getParameter('site_url')."/".$locale."/".$study->getStudyCode());
            $parameters["studycontent"] = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:StudyContent")->getStudyContent($study->getStudyCode(), $locale);
            $parameters["interventions"][] = $intervention;
            
        }
        
        $parameters['organizations'] = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Organization')->findAll();
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
        if ($session->has('dismiss_message')) {
            $parameters['dismiss_message'] = $session->get('dismiss_message');
            $session->remove('dismiss_message');
        } elseif ($session->has('dismiss_error_message')) {
            $parameters['dismiss_message'] = $session->gets('dismiss_error_message');
            $session->remove('dismiss_error_message');
        }
        $parameters['participant_email'] = $participant->getParticipantEmail();
        $parameters['participant'] = $participant;
        

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
    
    /**
     * @Route("/dismiss_ajax/", name="_dismiss_ajax")
     * @Secure(roles="ROLE_PARTICIPANT, IS_AUTHENTICATED_REMEMBERED")
     * @Template()
     */
    public function dismissAjaxAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $participant = $this->get('security.context')->getToken()->getUser();
        $participantEmail = $participant->getParticipantEmail();
        if($request->isXmlHttpRequest()) {
            $data = $request->request->all();
            if (isset($data['interventionCode'])) {
                $intervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')->findOneByInterventionCode($data['interventionCode']);
                $interventionType = $intervention->getInterventionType()->getInterventionTypeName();
                
                $participantInterventionLink = $em->getRepository('CyclogramProofPilotBundle:Intervention')->getInterventionByParticipantandCode($participantEmail, $data['interventionCode']);
                $participantInterventionLink->setStatus(ParticipantInterventionLink::STATUS_DISMISS);
                $em->persist($participantInterventionLink);
                $em->flush();
                if ($interventionType != 'Pledge' || $interventionType != 'Referral') {
                    $studyCode = $em->getRepository('CyclogramProofPilotBundle:Intervention')->getInterventionStudyCode($intervention->getInterventionId());
                    $arm = $em->getRepository('CyclogramProofPilotBundle:ParticipantArmLink')->getStudyArm($participant, $studyCode);
                    $participantArmLink = $em->getRepository('CyclogramProofPilotBundle:ParticipantArmLink')->getArmByParticipantandCode ( $participantEmail, $arm->getArm()->getArmCode());
                    $participantArmLink->setStatus(ParticipantArmLink::STATUS_DISMISS);
                    $em->persist($participantArmLink);
                    $em->flush();
                }
                $session->set('dismiss_message', $this->get('translator')->trans('txt_dismiss', array('%interventionName%' => $intervention->getInterventionName()), 'dashboard'));
                return new Response(json_encode(array('url' => $this->generateUrl("_main"))));
            } else {
                $interventions = $em->getRepository('CyclogramProofPilotBundle:Intervention')->getAllParticipantIntervention($participantEmail);
                foreach ($interventions as $int) {
                    $int->setStatus(ParticipantInterventionLink::STATUS_DISMISS);
                    $em->persist($int);
                    $intervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')->findOneByInterventionCode($int->getIntervention()->getInterventionCode());
                    $em->flush();
                }
                $arms = $em->getRepository('CyclogramProofPilotBundle:ParticipantArmLink')->getAllParticipantArms($participantEmail);
                foreach ($arms as $arm) {
                    $arm->setStatus(ParticipantArmLink::STATUS_DISMISS);
                    $em->persist($arm);
                    $em->flush();
                }
                $session->set('dismiss_message', $this->get('translator')->trans('txt_dismiss_all', array(), 'dashboard'));
                return new Response(json_encode(array('url' => $this->generateUrl("_main"))));
            }
            $session->set('dismiss_error_message', $this->get('translator')->trans('txt_dismiss', array('%interventionName%' => $intervention->getInterventionName()), 'dashboard'));
            return new Response(json_encode(array('url' => $this->generateUrl("_main"))));
        }
    }
    
}
