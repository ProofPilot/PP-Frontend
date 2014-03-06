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



use Cyclogram\Bundle\ProofPilotBundle\Entity\Code;

use Cyclogram\FrontendBundle\Form\SignUpAboutForm;

use Cyclogram\FrontendBundle\Form\UserSmsCodeForm;

use Cyclogram\FrontendBundle\Form\MobilePhoneForm;

use Cyclogram\FrontendBundle\Form\AboutMeForm;

use Cyclogram\FrontendBundle\Form\MailingAddressForm;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink;

use Cyclogram\CyclogramCommon;
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
    
    private $parameters = array();
    
    public function preExecute()
    {
        $cc = $this->container->get('cyclogram.common');
        $this->parameters = $cc->defaultJsParameters($this->getRequest());
    }
    
    /**
     * @Route("/mapTest", name="_maptest")
     * @Secure(roles="ROLE_PARTICIPANT, IS_AUTHENTICATED_REMEMBERED")
     * @Template()
     */
    public function mapTestAction()
    {
        return $this->render('CyclogramFrontendBundle:Dashboard:maptest.html.twig');
    
    }
    
    
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
        $request = $this->getRequest();
        $session = $this->getRequest()->getSession();

        if (!is_null($sendMail) && $request->isXmlHttpRequest()){
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
            return new Response(json_encode(array('error' => true,'message' => $this->get('translator')->trans("another_verification_sent", array(), "dashboard", $locale))));
        }
        
        $this->get('study_logic')->interventionLogic($participant);
        $this->get('study_logic')->participantDefaultInterventionLogic($participant);

        $interventionLinks = $em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')->getActiveParticipantInterventionLinks($participant);

        $parameters = array();
        if ($session->has('doitCode')) {
            $parameters['doitInterventionCode'] = $session->get('doitCode');
            $session->remove('doitCode');
        }
        $parameters["studies"] = $em->getRepository('CyclogramProofPilotBundle:Study')->getRandomStudyInfo($locale, $participant);
        $enrolledStudies = $em->getRepository('CyclogramProofPilotBundle:Participant')->getEnrolledStudies($participant);
        $parameters["enrolledStudies"] = array();
        foreach ($enrolledStudies as $study) {
            $studyContent = $em->getRepository('CyclogramProofPilotBundle:StudyContent')->getStudyContent($study->getStudyCode(), $locale);
            $enroledStudy['studyName'] = addslashes(htmlspecialchars_decode(htmlspecialchars_decode(str_replace(array("\r\n", "\r", "\n"), "", strip_tags($studyContent->getStudyName())),ENT_QUOTES)));
            $enroledStudy['studyUrl'] = $studyContent->getStudyUrl();
            $enroledStudy['studyGraphic'] = $studyContent->getStudyGraphic();
            $site = $em->getRepository('CyclogramProofPilotBundle:Study')->getDefaultSites($study->getStudyId());
            $siteId = $em->getRepository('CyclogramProofPilotBundle:Site')->findOneBySiteName($site[0]['siteName']);
            $siteCampaignLink = $em->getRepository('CyclogramProofPilotBundle:CampaignSiteLink')->findOneBySite($siteId);
            $enroledStudy['studyRefferalShortUrl'] = $cc::generateGoogleShorURL($this->container->getParameter('site_url')."/".$locale."/".$study->getStudyCode()."/?utm_campaign=".$siteCampaignLink->getCampaign()->getCampaignName()."&utm_medium-Clinic&utm_source=".$site[0]['siteName']."&pid=".$participant->getParticipantId());
            $enroledStudy['reffferalFacebookStudyUrl'] = $this->container->getParameter('site_url')."/".$locale."/".$study->getStudyCode()."/?utm_campaign=".$siteCampaignLink->getCampaign()->getCampaignName()."&utm_medium-Clinic&utm_source=".$site[0]['siteName']."&pid=".$participant->getParticipantId();
            $enroledStudy['reffferalPinterestStudyUrl'] =urlencode($this->container->getParameter('site_url')."/".$locale."/".$study->getStudyCode()."/?utm_campaign=".$siteCampaignLink->getCampaign()->getCampaignName()."&utm_medium-Clinic&utm_source=".$site[0]['siteName']."&pid=".$participant->getParticipantId());
            $enroledStudy['studyAllowSharing'] = $study->getStudyAllowSharing();
            $enroledStudy["graphic"] = $this->container->getParameter('study_image_url') . '/' .$study->getStudyId(). '/' .$studyContent->getStudyGraphic();
            $enroledStudy['studyContent'] = addslashes(htmlspecialchars_decode(htmlspecialchars_decode(str_replace(array("\r\n", "\r", "\n"), "", strip_tags($studyContent->getStudyAbout())), ENT_QUOTES)));
            $enroledStudy['tagline'] = addslashes(htmlspecialchars_decode(htmlspecialchars_decode(str_replace(array("\r\n", "\r", "\n"), "", strip_tags($studyContent->getStudyTagline())), ENT_QUOTES)));
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
                    $intervention['reffferalPinterestStudyUrl'] = urlencode($this->container->getParameter('site_url')."/".$locale."/".$study->getStudyCode()."/?utm_campaign=".$siteCampaignLink->getCampaign()->getCampaignName()."&utm_medium-Clinic&utm_source=".$site[0]['siteName']."&pid=".$participant->getParticipantId());
                    $intervention['refferalStudyUrl'] = $this->container->getParameter('site_url')."/".$locale."/".$study->getStudyCode()."/?utm_campaign=".$siteCampaignLink->getCampaign()->getCampaignName()."&utm_medium-Clinic&utm_source=".$site[0]['siteName']."&pid=".$participant->getParticipantId();
                    $intervention['reffferalShortStudyUrl'] = $cc::generateGoogleShorURL($this->container->getParameter('site_url')."/".$locale."/".$study->getStudyCode()."/?utm_campaign=".$siteCampaignLink->getCampaign()->getCampaignName()."&utm_medium-Clinic&utm_source=".$site[0]['siteName']."&pid=".$participant->getParticipantId());
                    $intervention['studyName'] = $studyContent->getStudyName();
                    $intervention['tagline'] = addslashes($studyContent->getStudyTagline());
                    $intervention["graphic"] = $this->container->getParameter('study_image_url') . '/' .$study->getStudyId(). '/' .$studyContent->getStudyGraphic();
                    break;
                case "Referral" :
                    $intervention['refferalStudyUrl'] = $this->container->getParameter('site_url')."/".$locale."/".$study->getStudyCode()."/?utm_campaign=".$siteCampaignLink->getCampaign()->getCampaignName()."&utm_medium-Clinic&utm_source=".$site[0]['siteName']."&pid=".$participant->getParticipantId();
                    $intervention['reffferalShortStudyUrl'] = $cc::generateGoogleShorURL($this->container->getParameter('site_url')."/".$locale."/".$study->getStudyCode()."/?utm_campaign=".$siteCampaignLink->getCampaign()->getCampaignName()."&utm_medium-Clinic&utm_source=".$site[0]['siteName']."&pid=".$participant->getParticipantId());
                    $intervention['reffferalFacebookStudyUrl'] = $this->container->getParameter('site_url')."/".$locale."/".$study->getStudyCode()."/?utm_campaign=".$siteCampaignLink->getCampaign()->getCampaignName()."&utm_medium-Clinic&utm_source=".$site[0]['siteName']."&pid=".$participant->getParticipantId();
                    $intervention['reffferalPinterestStudyUrl'] = urlencode($this->container->getParameter('site_url')."/".$locale."/".$study->getStudyCode()."/?utm_campaign=".$siteCampaignLink->getCampaign()->getCampaignName()."&utm_medium-Clinic&utm_source=".$site[0]['siteName']."&pid=".$participant->getParticipantId());
                    $intervention['studyName'] = addslashes(htmlspecialchars_decode(htmlspecialchars_decode(str_replace(array("\r\n", "\r", "\n"), "", strip_tags($studyContent->getStudyName())), ENT_QUOTES)));
                    $intervention['tagline'] = addslashes(htmlspecialchars_decode(htmlspecialchars_decode(str_replace(array("\r\n", "\r", "\n"), "", strip_tags($studyContent->getStudyTagline())), ENT_QUOTES)));
                    
                    $intervention['studyContent'] = addslashes(htmlspecialchars_decode(htmlspecialchars_decode(str_replace(array("\r\n", "\r", "\n"), "", strip_tags(substr($studyContent->getStudyAbout(), 0,250))), ENT_QUOTES)));
                    $intervention["graphic"] = $this->container->getParameter('study_image_url') . '/' .$study->getStudyId(). '/' .$studyContent->getStudyGraphic();
                    break;
                case "Shipping Info" :
                    $formShippingInformation = $this->createForm(new MailingAddressForm($this->container));
                    if ($participant->getParticipantFirstname()){
                        $formShippingInformation->get('participantFirstname')->setData($participant->getParticipantFirstname());
                    }
                    if ($participant->getParticipantLastname()){
                        $formShippingInformation->get('participantLastname')->setData($participant->getParticipantLastname());
                    }
                    if ($participant->getParticipantAddress1()){
                        $formShippingInformation->get('participantAddress1')->setData($participant->getParticipantAddress1());
                    }
                    if ($participant->getParticipantAddress2()){
                        $formShippingInformation->get('participantAddress2')->setData($participant->getParticipantAddress2());
                    }
                    if ($participant->getParticipantZipcode()){
                        $formShippingInformation->get('participantZipcode')->setData($participant->getParticipantZipcode());
                    }
                    if ($participant->getCity()){
                        $city = $participant->getCity();
                        $formShippingInformation->get('city')->setData($city->getCityName());
                        $formShippingInformation->get('cityId')->setData($city->getCityId());
                    }
                    if ($participant->getState()){
                        $state = $participant->getState();
                        $formShippingInformation->get('state')->setData($state->getStateCode());
                        $formShippingInformation->get('stateId')->setData($state->getstateId());
                    }
                    $sign = $participant->getParticipantDeliverySign();
                    if (isset($sign)){
                        if ($sign == true) {
                            $formShippingInformation['sign']->setData('sign');
                        }else{
                            $formShippingInformation['sign']->setData('notSign');
                        }
                    }
                    $parameters['formShippingInformation'] =  $formShippingInformation->createView();
                    break;
                case "About Me Info" :
                    $formAbout = $this->createForm(new SignUpAboutForm($this->container));
                    
                    $participantData=null;
                    if ($participant->getCountry()){
                        $participantData['country'] = $participant->getCountry();
                    }
                    if ($participant->getParticipantZipcode()){
                        $formAbout->get('zipcode')->setData($participant->getParticipantZipcode());
                    }
                    if($participant->getParticipantBirthdate()) {
                        $date = $participant->getParticipantBirthdate();
                        $participantData['monthsLabel'] = date_format($date, 'M');
                        $participantData['months'] = date_format($date, 'm');
                        $formAbout->get('daysSelect')->setData(date_format($date, 'd'));
                        $formAbout->get('yearsSelect')->setData(date_format($date, 'Y'));
                    }
                    if($participant->getSex()) {
                        $participantData['sex'] = $participant->getSex();
                    }
                    if($participant->getParticipantInterested()){
                        if ($participant->getParticipantInterested() == 'w') {
                            $participantData['interested'] = 'w';
                            $participantData['interestedLabel'] = 'women';
                        } elseif ($participant->getParticipantInterested() == 'm') {
                            $participantData['interested'] = 'm';
                            $participantData['interestedLabel'] = 'men';
                        } elseif ($participant->getParticipantInterested() == 'mw') {
                            $participantData['interested']= 'mw';
                            $participantData['interestedLabel'] = 'men & women';
                        }
                    }
                    if($participant->getGradeLevel()) {
                        $participantData['grade'] = $participant->getGradeLevel();
                    }
                    if($participant->getIndustry()) {
                        $participantData['industry'] = $participant->getIndustry();
                    }
                    if($participant->getAnnualIncome()) {
                        $formAbout->get('anunalIncome')->setData($participant->getAnnualIncome());
                    }
                    if($participant->getMaritalStatus()){
                        $participantData['marital'] = $participant->getMaritalStatus();
                    }
                    if($participant->getChildren()){
                        if ($participant->getChildren()== 1) {
                            $participantData['children'] = 'have';
                            $participantData['childrenLabel'] = 'have';
                        }
                        if ($participant->getChildren()== 0){
                            $participantData['children'] = 'nothave';
                            $participantData['childrenLabel'] = 'do not have';
                        }
                    }
                    $participantRaces = $em->getRepository('CyclogramProofPilotBundle:ParticipantRaceLink')->findByParticipant($participant);
                    if (isset($participantRaces) && !empty($participantRaces)){
                        $race = $participantRaces[0]->getRace();
                        $participantData['race']= $race;
                    }
                    $parameters['data'] = $participantData;
                    $parameters['formAbout'] =  $formAbout->createView();
                    $clientIp = $request->getClientIp();
                    $geoip = $this->container->get('maxmind.geoip')->lookup($clientIp);
                    if ($geoip != false) {
                        $countryCode = $geoip->getCountryCode();
                        $country = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Country')->findOneByCountryCode($countryCode);
                    } elseif ($clientIp == '127.0.0.1' || strpos($clientIp, '192.168.244.')!== false) {
                        $country = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Country')->findOneByCountryCode('UA');
                    } else {
                        $country = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Country')->findOneByCountryCode('US');
                    }
                    
                    $parameters['countryName'] = $country->getCountryName();
                    $parameters['countryId'] = $country->getCountryId();
                    $parameters['currencySymbol'] = $country->getCurrency()->getCurrencySymbol();
                    break;
                case "Confirm Mobile Phone":
                    $formMobile = $this->createForm(new MobilePhoneForm($this->container));
                    $phone = CyclogramCommon::parsePhoneNumber($participant->getParticipantMobileNumber());
                    if (!empty($phone)) {
                        $formMobile->get('phone_small')->setData($phone['country_code']);
                        $formMobile->get('phone_wide')->setData($phone['phone']);
                    }
                    
                    $clientIp = $request->getClientIp();
                    if ($clientIp == '127.0.0.1') {
                        $formMobile->get('phone_small')->setData(380);
                    }
                    $geoip = $this->get('maxmind.geoip')->lookup($clientIp);
                    if ($geoip != false) {
                        $countryCode = $geoip->getCountryCode();
                        $country = $em->getRepository('CyclogramProofPilotBundle:Country')->findOneByCountryCode($countryCode);
                        if (isset($country)){
                            $formMobile->get('phone_small')->setData($country->getDailingCode());
                        }
                    }
                    
                    $formMobileConfirm = $this->createForm(new UserSmsCodeForm($this->container));
                    $parameters['formMobileConfirm'] =  $formMobileConfirm->createView();
                    $parameters['formMobile'] =  $formMobile->createView();
                    break;
                case "Choose Location":
                    $studyCode = $study->getStudyCode();
                    $studyLocations = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:Study")->getStudyLocations($studyCode);
                    $parameters['locations'] = $studyLocations;
                    $parameters['studyCode'] = $studyCode;
                    break;

            }


            $parameters["studyCode"] = $study->getStudyCode();
          
            $parameters['shortstudyUrl'] = $cc::generateGoogleShorURL($this->container->getParameter('site_url')."/".$locale."/".$study->getStudyCode());
            $parameters["studycontent"] = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:StudyContent")->getStudyContent($study->getStudyCode(), $locale);
            $parameters["interventions"][] = $intervention;
            
        }
        
        $promoCodes = $em->getRepository('CyclogramProofPilotBundle:Code')-> getCodesByParticipant($participant);
        
        $parameters['promocodes'] = array();
        foreach ($promoCodes as $promocode) {
            $parameters['promocodes'][] = $promocode;
        }
        
        //$parameters['organizations'] = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Organization')->findAll();
        
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
        
        $parameters["user"]["name"] = $participant->getParticipantFirstname() . ' ' . $participant->getParticipantLastname();
        $parameters["username"] = $participant->getParticipantUsername();
        $parameters["user"]["last_access"] = $participant->getParticipantLastTouchDatetime();

        if($session->has('nonEligible')) {
            $studyContent = $em->getRepository('CyclogramProofPilotBundle:StudyContent')->findOneByStudyUrl($session->get('nonEligible'));
            $parameters["eligibility"] = $studyContent->getStudyName();
            $session->remove('nonEligible');
        }
        
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
        
        $this->parameters = array_merge($this->parameters, $parameters);
        

      return $this->render('CyclogramFrontendBundle:Dashboard:main.html.twig', $this->parameters);
    
    }
    
    
    private function getInterventionUrl($interventionLink, $locale) {
        $intervention = $interventionLink->getIntervention();

        $studyCode = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Intervention')
            ->getInterventionStudyCode($intervention->getInterventionId());
        
        $typeName = $interventionLink->getIntervention()->getInterventionType()->getInterventionTypeName(); 
        switch($typeName) {
            case 'Activity':
            case 'Video':
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
    
    /**
     * @Route("/close_poromocode_ajax/", name="_close_prpmpcode_ajax")
     * @Secure(roles="ROLE_PARTICIPANT, IS_AUTHENTICATED_REMEMBERED")
     * @Template()
     */
    public function closePromoCodeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $participant = $this->get('security.context')->getToken()->getUser();
        if($request->isXmlHttpRequest()) {
            $data = $request->request->all();
            if (isset($data['promoCode']) && isset($data['promoUrl'])) {
                $code = $em->getRepository('CyclogramProofPilotBundle:Code')->findOneBy(
                        array('codeRedeemedByParticipant' => $participant, 'codeValue' => $data['promoCode'],'status' => Code::STATUS_UNUSED));
                $code->setStatus(Code::STATUS_USED);
                $em->persist($code);
                $em->flush();
                return new Response(json_encode(array('promoUrl' => 'http://'.$data['promoUrl'])));
            }
        }
        
    }
    
    
    
    /**
     * @Route("/close_referral_intervention/", name="_close_refferal_intervention")
     * @Secure(roles="ROLE_PARTICIPANT, IS_AUTHENTICATED_REMEMBERED")
     * @Template()
     */
    public function closeRefferalInterventionAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $participant = $this->get('security.context')->getToken()->getUser();
        if($request->isXmlHttpRequest()) {
            $data = $request->request->all();
            if (isset($data['interventionCode'])) {
                $intervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')->findOneByInterventionCode($data['interventionCode']);
                $participantInterventionLink = $em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')->findOneBy(array('participant' => $participant, 'intervention' => $intervention));
                $participantInterventionLink->setStatus(ParticipantInterventionLink::STATUS_CLOSED);
                $em->persist($participantInterventionLink);
                $em->flush();
                return new Response(json_encode(array('url' => $this->generateUrl("_main"))));
            }
        }
    
    }
    
    
    
    
    /**
     * @Route("/video_completed_ajax/", name="_video_completed_ajax")
     * @Secure(roles="ROLE_PARTICIPANT, IS_AUTHENTICATED_REMEMBERED")
     * @Template()
     */
    public function videoCompletedAjaxAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	$session = $this->getRequest()->getSession();
    	$participant = $this->get('security.context')->getToken()->getUser();
    	$participantEmail = $participant->getParticipantEmail();
    	if($request->isXmlHttpRequest()) {
    		$data = $request->request->all();
    		if (isset($data['interventionCode'])) {
    			$intervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')
    			->findOneBy(array("interventionCode" => $data['interventionCode'], "language" => $participant->getParticipantLanguage()));
    			if (empty($intervention)) {
    				$language = $em->getRepository('CyclogramProofPilotBundle:Language')->findOneBylocale('en');
    				$intervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')
    				->findOneBy(array("interventionCode" => $interventionCode, "language" => $language));
    				if(empty($intervention)) {
    					throw new \Exception("No intervention found with code \"" . $interventionCode . "\"");
    				}
    			}    
    			$participantInterventionLink = $em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')->findOneBy(array('participant' => $participant, 'intervention' => $intervention));
    			$participantInterventionLink->setStatus(ParticipantInterventionLink::STATUS_CLOSED);
    			$em->persist($participantInterventionLink);
    			$em->flush();
    			return new Response(json_encode(array('url' => $this->generateUrl("_main"))));
    		}
    	}
    }
    
    /**
     * @Route("/locationselect_completed_ajax/", name="_locationselect_completed_ajax", options={"expose"=true})
     * @Secure(roles="ROLE_PARTICIPANT, IS_AUTHENTICATED_REMEMBERED")
     * @Template()
     */
    public function locationSelectCompletedAjaxAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $participant = $this->get('security.context')->getToken()->getUser();
        $participantEmail = $participant->getParticipantEmail();
        

        if($request->isXmlHttpRequest()) {
            

            //participant_site_link
            $result = $em->getRepository('CyclogramProofPilotBundle:ParticipantCampaignLink')
                        ->setParticipantCampaignLink($participant, $request->get("siteId"));
            
            if($result) {
                $intervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')
                ->findOneBy(array("interventionCode" => "SexproLocation", "language" => $participant->getParticipantLanguage()));
                if (empty($intervention)) {
                    $language = $em->getRepository('CyclogramProofPilotBundle:Language')->findOneBylocale('en');
                    $intervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')
                    ->findOneBy(array("interventionCode" => $interventionCode, "language" => $language));
                    if(empty($intervention)) {
                        throw new \Exception("No intervention found with code \"" . $interventionCode . "\"");
                    }
                }
                $participantInterventionLink = $em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')->findOneBy(array('participant' => $participant, 'intervention' => $intervention));
                $participantInterventionLink->setStatus(ParticipantInterventionLink::STATUS_CLOSED);
                $em->persist($participantInterventionLink);
                $em->flush();
                return new Response(json_encode(
                        array(
                                'url' => $this->generateUrl("_main"),
                                'site' => $request->get("siteId")
                
                        )));
            } else {
                return new Response(json_encode(
                        array(
                                'url' => $this->generateUrl("_main"),
                                'site' => null
                
                        )));
            }


        }
    }
    
}
