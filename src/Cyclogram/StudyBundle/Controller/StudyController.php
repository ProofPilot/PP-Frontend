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

namespace Cyclogram\StudyBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;

use Cyclogram\Bundle\ProofPilotBundle\Entity\StudyContent;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Cyclogram\FrontendBundle\Form\RegistrationForm;
use Cyclogram\FrontendBundle\Form\SignUpAboutForm;
use Cyclogram\FrontendBundle\Form\MailAddressForm;
use Symfony\Component\Security\Core\SecurityContext;

class StudyController extends Controller
{
    private $parameters = array();

    
    public function preExecute()
    {
        $session = $this->getRequest()->getSession();

        $studyUrl = $this->getRequest()->get('studyUrl');
        $locale = $this->getRequest()->getLocale();
        
        $studyContent = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:StudyContent")->getStudyContent($studyUrl, $locale);
        if (empty($studyContent))
            throw new NotFoundHttpException();
        
        $cc = $this->container->get('cyclogram.common');
        $this->parameters = $cc->defaultJsParameters($this->getRequest());
        $study = $studyContent->getStudy();
        $studyId = $studyContent->getStudyId();
        $securityContext = $this->container->get('security.context');
        if ($this->get('security.context')->isGranted("ROLE_USER")){
            $participant = $this->get('security.context')->getToken()->getUser();
            $site = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Study')->getDefaultSites($studyId);
            $siteId = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Site')->findOneBySiteName($site[0]['siteName']);
            $siteCampaignLink = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:CampaignSiteLink')->findOneBySite($siteId);
            $this->parameters['reffferalFacebookStudyUrl'] = $this->container->getParameter('site_url')."/".$locale."/".$study->getStudyCode()."/?utm_campaign=".$siteCampaignLink->getCampaign()->getCampaignName()."&utm_medium-Clinic&utm_source=".$site[0]['siteName']."&pid=".$participant->getParticipantId();
            $this->parameters['reffferalShortStudyUrl'] = $cc::generateGoogleShorURL($this->container->getParameter('site_url')."/".$locale."/".$study->getStudyCode()."/?utm_campaign=".$siteCampaignLink->getCampaign()->getCampaignName()."&utm_medium-Clinic&utm_source=".$site[0]['siteName']."&pid=".$participant->getParticipantId());
            $this->parameters['reffferalPinterestStudyUrl'] = urlencode($this->container->getParameter('site_url')."/".$locale."/".$study->getStudyCode()."/?utm_campaign=".$siteCampaignLink->getCampaign()->getCampaignName()."&utm_medium-Clinic&utm_source=".$site[0]['siteName']."&pid=".$participant->getParticipantId());
        }else {
            $this->parameters['reffferalFacebookStudyUrl'] = $this->container->getParameter('site_url')."/".$locale."/".$studyUrl;
            $this->parameters['reffferalPinterestStudyUrl'] = urlencode($this->container->getParameter('site_url')."/".$locale."/".$studyUrl);
            $this->parameters['shortstudyUrl'] = $cc::generateGoogleShorURL($this->container->getParameter('site_url')."/".$locale."/".$studyUrl);
            
        }
        $this->parameters["facebookcontent"] = addslashes(htmlspecialchars_decode(htmlspecialchars_decode(str_replace(array("\r\n", "\r", "\n"), "", strip_tags($studyContent->getStudyAbout())), ENT_QUOTES)));
        $this->parameters["shareStudyName"] = addslashes(htmlspecialchars_decode(htmlspecialchars_decode(str_replace(array("\r\n", "\r", "\n"), "", strip_tags($studyContent->getStudyName())), ENT_QUOTES)));
        $this->parameters["shareStudyTagline"] = addslashes(htmlspecialchars_decode(htmlspecialchars_decode(str_replace(array("\r\n", "\r", "\n"), "", strip_tags($studyContent->getStudyTagline())), ENT_QUOTES)));
        $this->parameters["studycontent"] = $studyContent;
        $this->parameters['studyUrl'] = $studyUrl;
        $this->parameters['studyId'] = $studyId;
        $this->parameters['studyCode'] = $study->getStudyCode();
        $status = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Status')->find($study->getStatus());
        $this->parameters['studyStatus'] = $status->getStatusName();
        $this->parameters['studyAllowSharing'] = $study->getStudyAllowSharing();
        $this->parameters['studyParticipants'] = $study->getStudyNumberOfCurrentParticipants();
        $this->parameters['studyGoal'] = $study->getStudyParticipantsGoal();
        $this->parameters['urlAssets'] = $this->container->getParameter('url_assets');
        $this->parameters['studyOrganizations'] = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:Study")->getStudyOrganizations($study->getStudyCode());
        $this->parameters['affiliatedOrganizations'] = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:Study")->getAffiliatedOrganization($studyId);
        $this->parameters['studyStaff'] = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:Study")-> getStudyStaff($study->getStudyCode());
        $this->parameters['surveyId'] = $studyContent->getStudyElegibilitySurvey();
        $this->parameters["logo"] = $this->container->getParameter('study_image_url') . '/' . $studyId. '/' .$studyContent->getStudyLogo();
        //$vimeo = $studyContent->getStudyVimeoVideo();
        $youtube = $studyContent->getStudyVideo();
        if (!empty($youtube)) {
            $video_id = substr( $youtube, strrpos( $youtube, '/' )+1 );
            $this->parameters["youtubeVideoShare"] = "
            function postFeed2(){
            FB.ui({method: 'feed',
            source: 'http://www.youtube.com/v/{$video_id}',
            picture: 'http://img.youtube.com/vi/{$video_id}/0.jpg',
            caption: '{$this->parameters["shareStudyTagline"]}',
            link: '{$this->parameters['reffferalFacebookStudyUrl']}',
            name: '{$this->parameters["shareStudyName"]}',
            description: '{$this->parameters["facebookcontent"]}',
            },function(response) {
            window.location.reload();
        }); return false;}";//$youtube;
            }
        
        $this->parameters["graphic"] = $this->container->getParameter('study_image_url') . '/' .$studyId. '/' .$studyContent->getStudyGraphic();

        
        $logic = $this->get('study_logic');
        
        //check if study is supported
//         if(!$logic->supports($this->parameters['studyCode'])) {
//             $this->parameters["errorMessage"] = "Study with code '" . $study->getStudyCode() . "' not supported by the system.";
//             $this->parameters["errorChoicesMessage"] = "Supported codes are:";
//             $this->parameters["errorChoices"] = $logic->getSupportedStudies();
//             return true;
//         }
        //check for default campaigns
        if(!$campaignParameters = $this->container->get('doctrine')->getRepository("CyclogramProofPilotBundle:Campaign")->getDefaultCampaignParameters($studyId)) {
            $this->parameters["errorMessage"] = "Default campaign/sites must be set for study  '" . $this->parameters["studyCode"] . ", otherwise GoogleAnaytics will not work'";
            return true;
        } else {
            $this->parameters["campaignParameters"] = $campaignParameters;
        }

        if(in_array($this->parameters['studyCode'], $logic->getSupportedStudies())) {
        
            //check if study has at least one "Site" organization linked
            if(!$sol = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:Study")->getOrganizationLinks($studyId)) {
                $this->parameters["errorMessage"] = "Study '" . $study->getStudyCode() . "' has no organization with role Site linked";
                return true;
            } else {
                $this->parameters["siteOrganization"] = $sol[0]["organizationName"];
            }
            
            //check if organization has any default sites
            if(!$defaultSites = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:Study")->getDefaultSites($studyId)) {
                $this->parameters["errorMessage"] = "Organization '" . $this->parameters["siteOrganization"] . "' has no default sites.";
                return true;
            } else {
                $this->parameters["defaultSite"] = $defaultSites[0]["siteName"];
            }
            
            //check if required arms exist
            if(!$this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Study')->checkStudyArms($logic->getArmCodes($this->parameters['studyCode']), $this->parameters['studyId'])) {
                $this->parameters["errorMessage"] = "Not all required arms found for study  '" .  $this->parameters['studyCode']  . "'";
                $this->parameters["errorChoicesMessage"] = "Required arms are:";
                $this->parameters["errorChoices"] = $logic->getArmCodes($this->parameters['studyCode']);
                return true;
            }
            
            //check if required interventions exist
            if(!$this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Study')->checkStudyInterventions($logic->getInterventionCodes($this->parameters['studyCode']), $this->parameters['studyId'])) {
                $this->parameters["errorMessage"] = "Not all required interventions found for study  '" .  $this->parameters['studyCode']  . "'";
                $this->parameters["errorChoicesMessage"] = "Required interventions are:";
                $this->parameters["errorChoices"] = $logic->getInterventionCodes($this->parameters['studyCode']);
                return true;
            }
            
        }
        
        return false;
    }
    
    public function errorAction()
    {   
        return $this->render('CyclogramStudyBundle:Study:error.html.twig', $this->parameters);
    }
    

    
    /**
     * @Route("/{studyUrl}/", name="_page")
     * @Template()
     */
    public function pageAction($studyUrl)
    {
        $locale = $this->getRequest()->getLocale();
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $cc = $this->container->get('cyclogram.common');
        $url_query = $request->query->all();
        if (isset ($url_query['pid']))
            $session->set('refferal_participant', $url_query['pid']);
        if ($session->has("message")) {
            $this->parameters["message"] = $session->get("message");
            $session->remove("message");
        }
        
        //depending on request parameters get campaign and site name
        if($this->getRequest()->get('utm_source') && $this->getRequest()->get('utm_campaign')) {
            $campaignName = $this->getRequest()->get('utm_campaign');
            $siteName = $this->getRequest()->get('utm_source');
            $csl = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:CampaignSiteLink")->getCSLParameters($campaignName, $siteName);
            if (!$csl) {
                $this->parameters =array_merge($this->parameters, array(
                        "error" => "Referral URL parameters are wrong"
                        ));
                return $this->render("::error.html.twig", $this->parameters);
            }
            $siteId = $csl->getSite()->getSiteId();
            $campaignId = $csl->getCampaign()->getCampaignId();
                    
        } else {
            $campaignName = $this->parameters["campaignParameters"]["campaignName"];
            $campaignId = $this->parameters["campaignParameters"]["campaignId"];
            $siteName = $this->parameters["campaignParameters"]["siteName"];
            $siteId =  $this->parameters["campaignParameters"]["siteId"];
            
            $str = "utm_source=" . urlencode($this->parameters["campaignParameters"]["siteName"]);
            $str .= "&utm_medium=" . urlencode($this->parameters["campaignParameters"]["campaignTypeName"]);
            $str .= "&utm_term=" . urlencode($this->parameters["campaignParameters"]["placementName"]);
            $str .= "&utm_content=" . urlencode($this->parameters["campaignParameters"]["affinityName"]);
            $str .= "&utm_campaign="  . urlencode($this->parameters["campaignParameters"]["campaignName"]);
            
            $this->parameters["google_pars"] = $str;
        }
        
        //save referral site&campaign in session
        $session->set('referralSite', $siteId);
        $session->set('referralCampaign', $campaignId);
        $form = $this->createForm(new RegistrationForm($this->container));
        $formAbout = $this->createForm(new SignUpAboutForm($this->container));
        $formForgorUsername = $this->createForm(new MailAddressForm($this->container));
        $formForgotPassword = $this->createFormBuilder()
        ->add('participantUsername', 'text', array(
                'label'=>'label_username'
        ))
        ->add('sendPass', 'submit', array(
                'label' => 'btn_send_pass'))
                ->getForm();
        $studyContent = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:StudyContent")->getStudyContent($studyUrl, $locale);
        $studyJoinButtonName = $studyContent->getStudyJoinButtonName();
        $studySpecificLoginHeader = $studyContent->getStudySpecificLoginHeader();
        $studyPrelaunchMessage = $studyContent->getStudyPrelaunchMessage();
        $studyJoinGoogleButton = $studyContent->getStudyJoinGoogleButton();
        $studyJoinFacebookButton = $studyContent->getStudyJoinFacebookButton();
        $studyAboutit = $studyContent->getStudyaboutit();
        $study = $studyContent->getStudy();
        $status = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Status')->find($study->getStatus());
        $securityContext = $this->container->get('security.context');
        if ($this->get('security.context')->isGranted("ROLE_USER") && $status == "Pre-Launch"){
            $participant = $this->get('security.context')->getToken()->getUser();
            $campaignLinkCheck = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Campaign')->checkIfIssetParticipanCampaigLink($studyUrl,$campaignId, $siteId, $participant);
            if(isset($campaignLinkCheck))
                $this->parameters['preLaunchNotified'] = true;
        }
        $this->parameters['form'] =  $form->createView();
        $this->parameters['formAbout'] =  $formAbout->createView();
        $this->parameters['formForgorUsername'] = $formForgorUsername->createView();
        $this->parameters['formForgotPassword'] = $formForgotPassword->createView();
        $this->parameters['host'] = $this->container->getParameter('site_url');
        $this->parameters['studyUrl'] = $studyUrl;
        $this->parameters['last_username'] = $session->get(SecurityContext::LAST_USERNAME);
        $this->parameters['studySpecificLoginHeader'] =  $studySpecificLoginHeader;
        
        $this->parameters['studyPrelaunchMessage'] =  $studyPrelaunchMessage;
        $this->parameters['studyJoinGoogleButton'] =  $studyJoinGoogleButton;
        $this->parameters['studyJoinFacebookButton'] =  $studyJoinFacebookButton;
        $this->parameters['studyAboutit'] =  $studyAboutit;
        
        $this->parameters['studyJoinButtonName'] =  $studyJoinButtonName;
        $participant = $this->get('security.context')->getToken()->getUser();
        if ($participant != 'anon.') {
            $this->parameters['participant_email'] = $participant->getParticipantEmail();
        } else {
            unset($this->parameters['participant_email']);
        }
        
        $request = $this->container->get('request');
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
        $this->parameters['countryName'] = $country->getCountryName();
        $this->parameters['countryId'] = $country->getCountryId();
        $this->parameters['currencySymbol'] = $country->getCurrency()->getCurrencySymbol();
        
        

        return $this->render('CyclogramStudyBundle:Study:page.html.twig', $this->parameters);

    }
    
    /**
     * @Route("/study", name="_study")
     * @Template()
     */
    public function studyAction($studyUrl)
    {
        return $this->render('CyclogramStudyBundle:Study:study_eligibility.html.twig', $this->parameters);
    }
    
    
    /**
     * @Route("/newsletter", name="_newsletter")
     * @Template()
     */
    public function newslatterAction($studyUrl)
    {
        $parameters["email"] = array(
                'title' => 'E-mail title placeholder', 
                'info' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat 
                           volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. 
                           Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at 
                           vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. 
                           Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non 
                           habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius 
                           quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam 
                           littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. 
                           Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.',
                'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tristique, enim vel pretium commodo, dui purus cursus tellus, vel sodales 
                           nisl elit a arcu. Curabitur ultrices aliquam nisi, in venenatis arcu porta vitae. Sed hendrerit mollis nibh vel faucibus.'
                );
        $parameters["surveys"] = array(
                array('title' => 'iTest@Home Public Survey',
                      'content' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt',
                      'image' => '/newsletter/images/newsletter_tmp_image.jpg'
                )
        );
        $this->parameters = array_merge($this->parameters, $parameters);
        return $this->render('CyclogramStudyBundle:Email:_newsletter.html.twig', $this->parameters);
    }
    
}
