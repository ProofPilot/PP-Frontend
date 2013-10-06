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

namespace Cyclogram\KnowatHomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Min;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\MinLength;
use Symfony\Component\Security\Core\SecurityContext;
use \Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;

use Cyclogram\CyclogramCommon;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Custom\DbCustom;

class DefaultController extends Controller
{
    private $parameters = array();

    public function indexAction()
    {
        $session = $this->get("session");
        $em = $this->getDoctrine()->getManager();
        $pageText = array();

        $referrerUrl = ( ! empty( $_SERVER["HTTP_REFERER"] ) ) ? $_SERVER["HTTP_REFERER"] : "";

        $lastPicN = $session->get("picN");

        $picN = rand(1, 4);

        $picN = CyclogramCommon::getRandomPicNumber($lastPicN, $picN);

        $session->set("refererUrl", $referrerUrl);
        $session->set("picN", $picN);

        //GET STUDY INFO
        $study = $em->getRepository("CyclogramProofPilotBundle:Study")->find(1);
        $language = $em->getRepository("CyclogramProofPilotBundle:Language")->find(1);
        $studyContent = $em->getRepository("CyclogramProofPilotBundle:StudyContent")->findOneBy(array("study"=>$study, "language"=>$language));

        $pageText['title'] = $studyContent->getStudyName();
        $pageText['description'] = $studyContent->getStudyDescription();

        return $this->render('CyclogramKnowatHomeBundle:website:home.html.twig', array('pageText'=>$pageText, "studyCode"=>$study->getStudyCode()));
    }

    public function aboutStudyAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pageText = array();

        //GET STUDY INFO
        $study = $em->getRepository("CyclogramProofPilotBundle:Study")->find(1);
        $language = $em->getRepository("CyclogramProofPilotBundle:Language")->find(1);
        $studyContent = $em->getRepository("CyclogramProofPilotBundle:StudyContent")->findOneBy(array("study"=>$study, "language"=>$language));

        $pageText['title'] = "About this study";
        $pageText['about'] = $studyContent->getStudyAbout();

        return $this->render('CyclogramKnowatHomeBundle:website:aboutStudy.html.twig', array('pageText'=>$pageText) );
    }

    public function privacyAndSecurityAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pageText = array();

        //GET STUDY INFO
        $study = $em->getRepository("CyclogramProofPilotBundle:Study")->find(1);
        $language = $em->getRepository("CyclogramProofPilotBundle:Language")->find(1);
        $studyContent = $em->getRepository("CyclogramProofPilotBundle:StudyContent")->findOneBy(array("study"=>$study, "language"=>$language));

        $pageText['title'] = "Privacy and Security";
        $pageText['privacy'] = $studyContent->getStudyPrivacy();

        return $this->render('CyclogramKnowatHomeBundle:website:privacyAndSecurity.html.twig', array("pageText"=>$pageText));
    }

    public function contactUsAction()
    {

        $request = $this->getRequest();

        $collectionConstraint = new Collection(array(
            'fields' => array(
                'name' => new NotBlank(),
                'email' => new Email(),
            ),
            'allowExtraFields' => true
        ));

        $formContact = $this->createFormBuilder()
            ->add('name', 'text', array('label'=>'Your name:'))
            ->add('email', 'email', array('label'=>'Your email:'))
            ->add('message', 'textarea', array('label'=>'Your message:'))
            ->getForm();

        $sent = false;
        if( $request->getMethod() == "POST" ){
            $formContact->bindRequest($request);

            if( $formContact->isValid() ) {
                $values = $request->request->get('form');

                $frmName = ( $values['name'] ) ? $values['name'] : null;
                $frmEmail = ( $values['email'] ) ? $values['email'] : null;
                $frmMessage = ( $values['message'] ) ? $values['message'] : null;

                $frmBody = "";
                if( $frmEmail && $frmMessage && $frmName ){

                    $frmBody = "Name: $frmName";
                    $frmBody .= "<br><br>";
                    $frmBody .= "Message:<br>";
                    $frmBody .= "$frmMessage";

                    $message = \Swift_Message::newInstance()
                        ->setSubject('KnowAtHome Contact Message')
                        ->setFrom($frmEmail)
                        ->setTo("knowathome@emory.edu")
                        ->setBody( $frmBody, 'text/html' );

                    $sent = $this->get('mailer')->send($message);
                }
            }
        }

        $formContactView = $formContact->createView();

        return $this->render('CyclogramKnowatHomeBundle:website:contactUs.html.twig', array('form'=>$formContactView, 'sent'=>$sent) );
    }

    public function eligibilityAction($studyUrl = null)
    {

        $studyCode = ('knowathome');

        $locale = $this->getRequest()->getLocale();
        
        $studyContent = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:StudyContent")->getStudyContentByCode($studyCode, $locale);
        if (empty($studyContent))
            throw new NotFoundHttpException();
        
        $parameters = array();
        
        $study = $studyContent->getStudy();
        $studyId = $studyContent->getStudyId();
        $parameters["studycontent"] = $studyContent;
        $parameters['studyUrl'] = $studyUrl;
        $parameters['studyId'] = $studyId;
        $parameters['studyCode'] = $study->getStudyCode();
        $parameters['surveyId'] = $studyContent->getStudyElegibilitySurvey();
        $parameters["logo"] = $this->container->getParameter('study_image_url') . '/' . $studyId. '/' .$studyContent->getStudyLogo();
        $parameters["graphic"] = $this->container->getParameter('study_image_url') . '/' .$studyId. '/' .$studyContent->getStudyGraphic();
        
        $logic = $this->get('study_logic');
        
        //check if study is supported
        //         if(!$logic->supports($this->parameters['studyCode'])) {
        //             $this->parameters["errorMessage"] = "Study with code '" . $study->getStudyCode() . "' not supported by the system.";
        //             $this->parameters["errorChoicesMessage"] = "Supported codes are:";
        //             $this->parameters["errorChoices"] = $logic->getSupportedStudies();
        //             return true;
        //         }
        
        $isEligible = true;
        
        //check for default campaigns
        if(!$campaignParameters = $this->container->get('doctrine')->getRepository("CyclogramProofPilotBundle:Campaign")->getDefaultCampaignParameters($studyId)) {
            $parameters["errorMessage"] = "Default campaign/sites must be set for study  '" . $parameters["studyCode"] . ", otherwise GoogleAnaytics will not work'";
            $isEligible = false;
        } else {
            $parameters["campaignParameters"] = $campaignParameters;
        }
        
        if(in_array($parameters['studyCode'], $logic->getSupportedStudies())) {
        
            //check if study has at least one "Site" organization linked
            if(!$sol = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:Study")->getOrganizationLinks($studyId)) {
                $parameters["errorMessage"] = "Study '" . $study->getStudyCode() . "' has no organization with role Site linked";
                $isEligible = false;
            } else {
                $parameters["siteOrganization"] = $sol[0]["organizationName"];
            }
        
            //check if organization has any default sites
            if(!$defaultSites = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:Study")->getDefaultSites($studyId)) {
                $parameters["errorMessage"] = "Organization '" . $parameters["siteOrganization"] . "' has no default sites.";
                $isEligible = false;
            } else {
                $parameters["defaultSite"] = $defaultSites[0]["siteName"];
            }
        
            //check if required arms exist
            if(!$this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Study')->checkStudyArms($logic->getArmCodes($parameters['studyCode']), $parameters['studyId'])) {
                $parameters["errorMessage"] = "Not all required arms found for study  '" .  $parameters['studyCode']  . "'";
                $parameters["errorChoicesMessage"] = "Required arms are:";
                $parameters["errorChoices"] = $logic->getArmCodes($parameters['studyCode']);
                $isEligible = false;
            }
        
            //check if required interventions exist
            if(!$this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Study')->checkStudyInterventions($logic->getInterventionCodes($parameters['studyCode']), $parameters['studyId'])) {
                $parameters["errorMessage"] = "Not all required interventions found for study  '" .  $parameters['studyCode']  . "'";
                $parameters["errorChoicesMessage"] = "Required interventions are:";
                $parameters["errorChoices"] = $logic->getInterventionCodes($parameters['studyCode']);
                $isEligible = false;
            }
        
        }
        
        if($isEligible == false)
            return $this->redirect( $this->generateUrl('CyclogramKnowatHomeBundle_error', array('parameters' => $parameters)));
        
        if ($this->getRequest()->getMethod('POST')) {
            $value = $this->getRequest()->request->get('specimen');
        }
        $session = $this->get("session");
        $em = $this->getDoctrine()->getManager();
        $pageText = array();

        $lastPicN = $session->get("picN");
        $picN = rand(1, 4);
        $picN = CyclogramCommon::getRandomPicNumber($lastPicN, $picN);
        $session->set("picN", $picN);

        $surveyUrl = "";
        $surveyUrl = $this->container->getParameter('url_survey_kah');
        $surveyUrl .= "?redirectUrl=%2Fen%2Fknowathome%2Fstudy";

        $uniqId = uniqid();
        $session->set("uniqId", $uniqId);

        //GET STUDY INFO
        $study = $em->getRepository("CyclogramProofPilotBundle:Study")->find(1);
        $language = $em->getRepository("CyclogramProofPilotBundle:Language")->find(1);
        $studyContent = $em->getRepository("CyclogramProofPilotBundle:StudyContent")->findOneBy(array("study"=>$study, "language"=>$language));

        $pageText['title'] = "Consent";
        $pageText['consent_introduction'] = $studyContent->getStudyConsentIntroduction();

        return $this->render('CyclogramKnowatHomeBundle:website:eligibility.html.twig',
            array(
                 "studyUrl" => $studyUrl,
                "uniqid"=>$uniqId,
                "surveyLink"=>$surveyUrl,
                "pageText"=>$pageText

            )
        );
    }
    
    public function errorAction() {
        
        $session = $this->get("session");
        
        $lastPicN = $session->get("picN");
        $picN = rand(1, 4);
        $picN = CyclogramCommon::getRandomPicNumber($lastPicN, $picN);
        $session->set("picN", $picN);
        
        $parameters = $this->getRequest()->get('parameters');
        return $this->render('CyclogramKnowatHomeBundle:website:error.html.twig', $parameters);
    }

    public function loginAction()
    {

        return $this->redirect($this->generateUrl("CyclogramKnowatHomeBundle_homepage"));

        $request = $this->getRequest();
        $session = $request->getSession();

        $lastPicN = $session->get("picN");
        $picN = rand(1, 4);
        $picN = CyclogramCommon::getRandomPicNumber($lastPicN, $picN);
        $session->set("picN", $picN);

        /*$collectionConstraint = new Collection(array(
            'fields' => array(
                'user' => new NotBlank(),
                'password' => new MinLength(array('limit'=>6)),
            ),
            'allowExtraFields' => true
        ));

        $formLogin = $this->createFormBuilder(null, array('validation_constraint' => $collectionConstraint))
            ->add('user', 'text', array('label'=>'Enter your Email'))
            ->add('password', 'password', array('label'=>'Enter your Password'))
            ->getForm();

        $formLoginView = $formLogin->createView();*/

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('CyclogramKnowatHomeBundle:website:login.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }

    public function eligibleAction(){
        $session = $this->get("session");
        $lastPicN = $session->get("picN");
        $em = $this->getDoctrine()->getManager();
        $pageText = array();

        $picN = rand(1, 4);
        $picN = CyclogramCommon::getRandomPicNumber($lastPicN, $picN);
        $session->set("picN", $picN);

        //GET STUDY INFO
        $study = $em->getRepository("CyclogramProofPilotBundle:Study")->find(1);
        $language = $em->getRepository("CyclogramProofPilotBundle:Language")->find(1);
        $studyContent = $em->getRepository("CyclogramProofPilotBundle:StudyContent")->findOneBy(array("study"=>$study, "language"=>$language));

        $pageText['title'] = "Eligible";
        $pageText['requirements'] = $studyContent->getStudyRequirements();

        $svid = $session->get("svid");
        $sid = $session->get("sid");

        return $this->render('CyclogramKnowatHomeBundle:website:eligible.html.twig', array("pageText"=>$pageText, "svid"=>$svid, "sid"=>$sid, "studyId"=>$study->getStudyId()));
    }

    public function notEligibleAction()
    {
        $session = $this->get("session");
        $lastPicN = $session->get("picN");

        $picN = rand(1, 4);
        $picN = CyclogramCommon::getRandomPicNumber($lastPicN, $picN);
        $session->set("picN", $picN);
        
        return $this->render('CyclogramKnowatHomeBundle:website:notEligible.html.twig');
    }

    public function surveyResultAction()
    {
        $svid = $this->getRequest()->get('svid');
        $sid = $this->getRequest()->get('sid');

        $session = $this->get("session");

        $session->set('svid', $svid);
        $session->set('sid', $sid);

        if( is_null($svid) || is_null($sid) ){
            return $this->redirect( $this->generateUrl("CyclogramKnowatHomeBundle_notEligible") );
        }

        $surveyResult = $this->get('custom_db')->getFactory('ElegibilityCustom')->getSurveyResponseData( $svid, $sid );
        
        $sl = $this->get('study_logic');
        $isElegible = $sl->checkEligibility('knowathome',$surveyResult);


        /*echo "<pre>";
        var_dump($isElegible);
        print_r( $reason );
        echo "</pre>";
        die("debug");*/
        
        if( $isElegible ){

            //store surveyid and saveid in session
            $locale = $this->getRequest()->getLocale();
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();

            //depending on request parameters get campaign and site name
            if($this->getRequest()->get('utm_source') && $this->getRequest()->get('utm_campaign')) {
                $campaignName = $this->getRequest()->get('utm_campaign');
                $siteName = $this->getRequest()->get('utm_source');
                $csl = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:CampaignSiteLink")->getCSLParameters($campaignName, $siteName);
                if (!$csl)
                    return $this->render("::error.html.twig", array(
                                "error" => "Referral URL parameters are wrong"
                            ));
                $siteId = $csl->getSite()->getSiteId();
                $campaignId = $csl->getCampaign()->getCampaignId();
            
            } else {
                if(!$campaignParameters = $this->container->get('doctrine')->getRepository("CyclogramProofPilotBundle:Campaign")->getDefaultCampaignParameters(1)) {
                    //             $this->parameters["errorMessage"] = "No campains are linked with site  '" . $this->parameters["defaultSite"] . "'";
                    $this->parameters["errorMessage"] = "No campains are linked with site  '" . $this->parameters["defaultSite"] . "'";
                    return $this->render('CyclogramStudyBundle:Study:error.html.twig', $this->parameters);
                } else {
                    $this->parameters["campaignParameters"] = $campaignParameters;
                }
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
            
            $session = $this->getRequest()->getSession();
            $bag = new AttributeBag();
            $bag->setName("SurveyInfo");
            $array = array();
            $bag->initialize($array);
            $bag->set('surveyId', $sid);
            $bag->set('saveId', $svid);
            $bag->set('studyCode', "knowathome");
            $session->registerBag($bag);
            $session->set('SurveyInfo', $bag);
            
            return $this->redirect( $this->generateUrl("CyclogramKnowatHomeBundle_eligible") );
        } else {
            $logger = $this->get('logger');
            $logger->err('PARTICIPANT NOT ELIGIBLE ');
            return $this->redirect( $this->generateUrl("CyclogramKnowatHomeBundle_notEligible") );
        }
    }

    public function disclaimerAction()
    {
        $session = $this->get("session");
        $lastPicN = $session->get("picN");
        $picN = rand(1, 4);
        $picN = CyclogramCommon::getRandomPicNumber($lastPicN, $picN);
        $session->set("picN", $picN);
        

        $em = $this->getDoctrine()->getManager();
        $pageText = array();

        //GET STUDY INFO
        $study = $em->getRepository("CyclogramProofPilotBundle:Study")->find(1);
        $language = $em->getRepository("CyclogramProofPilotBundle:Language")->find(1);
        $studyContent = $em->getRepository("CyclogramProofPilotBundle:StudyContent")->findOneBy(array("study"=>$study, "language"=>$language));
        $pageText['title'] = "Consent";
        $pageText['consent'] = $studyContent->getStudyConsent();

        return $this->render('CyclogramKnowatHomeBundle:website:disclaimer.html.twig', array("pageText"=>$pageText));
    }

    public function noConsentAction()
    {

        $session = $this->get("session");
        $lastPicN = $session->get("picN");
        $picN = rand(1, 4);
        $picN = CyclogramCommon::getRandomPicNumber($lastPicN, $picN);
        $session->set("picN", $picN);

        return $this->render('CyclogramKnowatHomeBundle:website:noConsent.html.twig');
    }

    public function  ajaxStateValidationAction(){

        $em = $this->getDoctrine()->getManager();

        $request = $this->getRequest();
        $callback = $request->query->get('callback');
        $state = strtolower($request->query->get('state'));
        $zipcode = $request->query->get('zipcode');
        $responseCode = null;

        //make queries
        $DbState = "";
        $city = $em->getRepository("CyclogramProofPilotBundle:City")->findOneBy(array("cityZipcode"=>$zipcode));
        if( $city ){
            $DbState = strtolower($city->getState()->getStateName());
            $responseCode = ( $DbState == $state )? "true" : "false";
        }else{
            $responseCode = "false";
        }

        $content = "$callback(".json_encode(array("responseCode"=>$responseCode)).")";
        
        $response = new \Symfony\Component\HttpFoundation\Response();

        $response->setContent( $content );
        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'application/jsonp');
        
        $response->send();
    }

}