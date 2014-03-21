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

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantRaceLink;

use Cyclogram\FrontendBundle\Form\SignUpAboutForm;

use Cyclogram\FrontendBundle\Form\MailAddressForm;

use Cyclogram\FrontendBundle\Form\RegistrationForm;

use Cyclogram\FrontendBundle\Aop\Check;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantStudyReminderLink;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantContactTimeLink;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantStudyReminder;

use Symfony\Component\Security\Core\Exception\AuthenticationException;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantSurveyLink;

use Symfony\Component\HttpKernel\EventListener\ResponseListener;

use Symfony\Component\Config\Definition\Exception\DuplicateKeyException;

use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\HttpFoundation\Request;
use Cyclogram\CyclogramCommon;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Cyclogram\FrontendBundle\Form\MobilePhoneForm;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;
use Common\DefaultParticipantStudy;
use Symfony\Component\Security\Core\SecurityContext;

class AuthentificationController extends Controller
{

    private $parameters = array();
    
    public function preExecute()
    {
        $cc = $this->container->get('cyclogram.common');
        $this->parameters = $cc->defaultJsParameters($this->getRequest());
    }

    /**
     * @Route("/signup/{studyCode}/{surveyId}", name="_signup", defaults={"studyCode"= null, "surveyId" = null})
     * @Template()
     */
    public function signupStartAction(Request $request, $studyCode=null, $surveyId=null)
    {

        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $doitInterventionCode = $request->query->get('interventionCode');
        if (!empty($doitInterventionCode)) {
            $session->set('doitCode', $doitInterventionCode);
        }
        if ($this->get('security.context')->isGranted("ROLE_USER")){
            return $this->redirect($this->get('router')->generate("_main"));
        }
        // registration check
        $form = $this->createForm(new RegistrationForm($this->container));
        $form->handleRequest($request);
        $studyJoinButtonName = "";
        $studySpecificLoginHeader = "";
        $studyJoinGoogleButton = "";
        $studyJoinFacebookButton = "";
        $locale = $this->getRequest()->getLocale();
        $language = $em->getRepository('CyclogramProofPilotBundle:Language')->findOneBylocale($locale);
        if(!empty($studyCode) && $studyCode !== 'jsCode') {
	        $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
	        $studyContent = $em->getRepository('CyclogramProofPilotBundle:StudyContent')->findOneBy(array('study' => $study, 'language' => $language));
	        $studyJoinButtonName = $studyContent->getStudyJoinButtonName();
	        $studySpecificLoginHeader = $studyContent->getStudySpecificLoginHeader();
	        $studyJoinGoogleButton = $studyContent->getStudyJoinGoogleButton();
	        $studyJoinFacebookButton = $studyContent->getStudyJoinFacebookButton();
	        
    	}
        
        if ($form->isValid()) {
            $registration = $form->getData();
            $this->createParticipant($registration , $studyCode);
            if($session->has('nonEligible')) {
                $participant = $this->get('security.context')->getToken()->getUser();
                $studyArms = $em->getRepository('CyclogramProofPilotBundle:Study')->getStudyArms($session->get('nonEligible'));
                $participantArmLink = new ParticipantArmLink();
                $participantArmLink->setArm($studyArms[0]);
                $participantArmLink->setParticipant($participant);
                $participantArmLink->setStatus(ParticipantArmLink::STATUS_NOT_ELIGIBLE);
                $participantArmLink->setParticipantArmLinkDatetime(new \DateTime());
                $em->persist($participantArmLink);
                $em->flush($participantArmLink);
            }
            if ($request->isXmlHttpRequest()) {
                if(!empty($studyCode) && $studyCode !== 'jsCode') {
                $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
                    if ($study->getStudySkipAboutMe() && $study->getStudySkipConsent()) {
                        $redirectUrl = $this->generateUrl("_main");
                       $eligibilitySurvey = $studyContent->getStudyElegibilitySurvey();
                        if (!empty($surveyId)) {
                        	return new Response(json_encode(array('error' => false, 'url' => $this->generateUrl("_eligibility_survey", array('studyCode' => $studyCode,'surveyId' => $surveyId, 'redirectUrl' => $redirectUrl)))));
                        } else if (is_null($eligibilitySurvey)){
                        	$logic = $this->get('study_logic');
                        	$participant = $this->get('security.context')->getToken()->getUser();
                        	$url = $logic->studyRegistration($participant, $studyCode, null, null);
                        	return new Response(json_encode(array('error' => false, 'url' => $url)));
                        }
                    }
                }
                return new Response(json_encode(array('error' => false)));
            } elseif ($request->getMethod() == 'POST') {
                
                if ( $session->has('SurveyInfo')) {
                    
                    if ($session->has('referralSite') && $session->has('referralCampaign')){
                        $ls = $this->get('study_logic');
                        $bag = $session->get('SurveyInfo');
                        $surveyId = $bag->get('surveyId');  
                        $saveId = $bag->get('saveId');
                        $studyCode = $bag->get('studyCode');
                        $session->remove('SurveyInfo');
                        $securityContext = $this->container->get('security.context');
                        $participant = $securityContext->getToken()->getUser();
                        $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
                        $url = $ls->studyRegistration($participant, $studyCode, $surveyId, $saveId);
//                         if ($participant->getParticipantEmailConfirmed() == false){
//                             $this->confirmParticipantEmail($participant);
//                         }
                        if ($study->getStudySkipAboutMe()) {
                            return $this->redirect($url);
                        }
                    } else {
                        $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
                        $session->set("message", $this->get('translator')->trans('study_register_error', array(), 'register'));
                        $studyContent = $em->getRepository('CyclogramProofPilotBundle:StudyContent')->findOneByStudyUrl($studyCode);
                        return $this->redirect($this->generateUrl("_page", array("studyUrl" => $studyContent->getStudyUrl())));
                    }
                }
                    return $this->redirect( $this->generateUrl("_signup_about"));
            }
                
        } elseif ($request->isXmlHttpRequest() && !$form->isValid()){
             $messages = array();
             $validator = $this->container->get('validator');
             $errors = $validator->validate($form);
             foreach ($errors as $err) {
                if(strpos($err->getPropertyPath(),'[')) {
                    if ($err->getMessage() == "Passwords do not match") {
                        $property = substr($err->getPropertyPath(),strpos($err->getPropertyPath(),'[')+1,strlen($err->getPropertyPath()));
                        $messages[]= array('property' => substr($property,0,strlen($property)-1),
                                           'message' => $err->getMessage(),
                                           'password' => true);
                    } else {
                        $property = substr($err->getPropertyPath(),strpos($err->getPropertyPath(),'[')+1,strlen($err->getPropertyPath()));
                        $property = substr($property,0,strpos($property,'.')-1);
                        if ($property == "participantPassword" ) {
                            $messages[]= array('property' => $property,
                                               'message' => $err->getMessage(),
                                               'password' => true);
                        } else {
                            $messages[]= array('property' => $property ,
                                               'message' => $err->getMessage(),
                                               'password' => false);
                        }
                    }
                }elseif(strpos($err->getPropertyPath(),'.')){
                    $messages[]= array('property' => substr($err->getPropertyPath(),strpos($err->getPropertyPath(),'.')+1,strlen($err->getPropertyPath())),
                                       'message' => $err->getMessage(),
                                       'password' => false);
                    }
                }
                return new Response(json_encode(array('error' => true, 'messages' => $messages)));
        }
        //login check
        $error = $this->getErrorForRequest($request);
        if($error) {
            if ($request->isXmlHttpRequest()) {
                return new Response(json_encode(array('error' => true)));
            } else {
                $this->parameters = array_merge($this->parameters,array(
                        'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                		'studyJoinButtonName' => $studyJoinButtonName,
                		'studySpecificLoginHeader' => $studySpecificLoginHeader,
                        'form' => $form->createView(),
                        'studyJoinGoogleButton' =>  $studyJoinGoogleButton,
                        'studyJoinFacebookButton' =>  $studyJoinFacebookButton,
                        'error'         => $error
                ));
                return $this->render('CyclogramFrontendBundle:Authentification:signup.html.twig', $this->parameters);
            }
        }
        if (isset($studyCode)&&isset($surveyId)) {
            $bag = new AttributeBag();
            $bag->setName("ProtectedSurvey");
            $array = array();
            $bag->initialize($array);
            $bag->set('surveyId', $surveyId);
            $bag->set('studyCode', $studyCode);
            $session->registerBag($bag);
            $session->set('ProtectedSurvey', $bag);
        }

        //render forms
        $this->parameters = array_merge($this->parameters,array(
                    'last_username' => $session->get(SecurityContext::LAST_USERNAME),
	        		'studyJoinButtonName' => $studyJoinButtonName,
	        		'studySpecificLoginHeader' => $studySpecificLoginHeader,
        			'studyJoinGoogleButton' =>  $studyJoinGoogleButton,
        			'studyJoinFacebookButton' =>  $studyJoinFacebookButton,
                    'form' => $form->createView(),
                    'surveyId' => $surveyId
        ));
        return $this->render('CyclogramFrontendBundle:Authentification:signup.html.twig', $this->parameters);
    }
    
    /**
     * @Route("/login_check", name="login_check", defaults={"studyCode"= null, "surveyId" = null})
     */
    public function securityCheckAction($studyCode=null, $surveyId=null)
    {
        // The security layer will intercept this request
    }
    
    
    /**
     * @Route("/logout", name="_logout" , options={"expose"=true})
     */
    public function logoutAction()
    {
        // The security layer will intercept this request
    }
    
    /**
     * @Route("/doLogin/{studyCode}/{surveyId}", name="_do_login", defaults={"studyCode"= null, "surveyId"=null})
     * @Template()
     */
    public function doLoginAction(Request $request, $studyCode, $surveyId){
        $language = $this->getRequest()->getLocale();
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        if ($request->isXmlHttpRequest()) {
            if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
                return new Response(json_encode(array('error' => true)));
            }
            return new Response(json_encode(array('error' => false, 'url' => $this->generateUrl("_main"))));
        }
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            return $this->redirect($this->generateUrl("_signup", array('error' => true)));
        }
        if ($session->has('ProtectedSurvey')) {
            $bag = $session->get('ProtectedSurvey');
            $surveyId = $bag->get('surveyId');
            $studyCode = $bag->get('studyCode');
            $session->remove('ProtectedSurvey');
            $participant = $this->get('security.context')->getToken()->getUser();
            $enrolled = $em->getRepository('CyclogramProofPilotBundle:Participant')->isEnrolledInStudy($participant, $studyCode);
            $closed = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')->checkIfSurveyClosed($participant, $surveyId);
            if ($enrolled && !$closed) {
                $redirectPath = $this->get('router')->generate('_main');
                return $this->redirect($this->get('router')->generate('_survey_protected', array(
                        'studyCode'=>$studyCode,
                        'surveyId'=>$surveyId,
                        'redirectUrl'=>urlencode($redirectPath
                        ))));
            }
        }
        return $this->redirect($this->generateUrl("_main"));
    }
    
    
    /**
     * @Route("/doOauth/{studyCode}/{recruiter}", name="_do_oauth", defaults={"studyCode"= null, "recruiter" = null})
     * @Template()
     */
    public function doOauthAction(Request $request, $studyCode= null,$recruiter = null){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $locale = $this->getRequest()->getLocale()?$this->getRequest()->getLocale():'en';
        $language = $em->getRepository('CyclogramProofPilotBundle:Language')->findOneByLocale($locale);
        
       
        
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            return $this->redirect($this->generateUrl("_signup", array('error' => true)));
        }
        
        $participant = $this->get('security.context')->getToken()->getUser();
        if($session->has('preLaunch')) {
            $message = $session->get('preLaunch');
            $session->remove('preLaunch');
            $this->prelauncCmpaignRegistration($participant, $studyCode, $recruiter);
            return $this->redirect($this->generateUrl('_page', array(
                    'studyUrl' => $studyCode,
                    'preLaunch' => $message
            )));
        }
        if ($session->has('confirmation') && !isset($studyCode)) {
            $this->confirmParticipantEmail($participant);
            $session->remove('confirmation');
        }
        
        
        if (isset($studyCode) && $studyCode !== 'jsCode') {
            $isEnrolled = $em->getRepository('CyclogramProofPilotBundle:Participant')->isEnrolledInStudy($participant, $studyCode);
            if ($isEnrolled)
                return $this->redirect($this->generateUrl("_main"));
            $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
            $studyContent =  $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:StudyContent")->findOneBy(array('study' => $study->getStudyId(),'language' => $language));
            if ($study->getStudySkipAboutMe() && $study->getStudySkipConsent()) {
                $redirectUrl = $this->generateUrl("_main");
                $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
                $language = $em->getRepository('CyclogramProofPilotBundle:Language')->findOneByLocale($request->getLocale());
                $eligibilitySurvey = $studyContent->getStudyElegibilitySurvey();
                if (!empty($eligibilitySurvey)) {
                	return $this->redirect($this->generateUrl("_eligibility_survey", array('studyCode'=> $studyCode, 'surveyId' => $eligibilitySurvey, 'redirectUrl' => $redirectUrl)));
                } else {
                	$logic = $this->get('study_logic');
                	$participant = $this->get('security.context')->getToken()->getUser();
                	$url = $logic->studyRegistration($participant, $studyCode, null, null);
                	return $this->redirect($url);
                }
            }elseif ($study->getStudySkipAboutMe()) {
                $this->parameters = array_merge($this->parameters, array('surveyId' => $studyContent->getStudyElegibilitySurvey(),'studycontent' => $studyContent));
                return $this->render('CyclogramFrontendBundle:Authentification:consent_main.html.twig',  $this->parameters);
            } else {
                return $this->redirect($this->generateUrl("_signup_about", array('studyCode' => $studyCode, 'surveyId' => $studyContent->getStudyElegibilitySurvey())));
            }
        }
        return $this->redirect($this->generateUrl("_signup_about"));
    }
    
    
    /**
     * @Route("/signupabout/{studyCode}/{surveyId}", name="_signup_about", defaults={"studyCode"= null, "surveyId" = null})
     * @Template()
     */
    public function signupAboutAction(Request $request, $studyCode=null, $surveyId = null) {
        $locale = $this->getRequest()->getLocale();
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $participant = $this->get('security.context')->getToken()->getUser();

        
        if (($this->get('security.context')->isGranted('ROLE_FACEBOOK_USER') || $this->get('security.context')->isGranted('ROLE_GOOGLE_USER')) 
                        && ($participant->getParticipantBasicInformation() == true)) {
            if (isset($studyCode) && $studyCode !== 'jsCode') {
                $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
                $studyContent =  $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:StudyContent")->getStudyContent($study->getStudyCode(), $locale);
                if ($study->getStudySkipConsent()) {
                    return $this->OauthRedirect($studyCode);
                } else {
                    $this->parameters = array_merge($this->parameters, array('surveyId' => $studyContent->getStudyElegibilitySurvey(),'studycontent' => $studyContent));
                    return $this->render('CyclogramFrontendBundle:Authentification:consent_main.html.twig', $this->parameters);
                }
            } else {
                return $this->OauthRedirect($studyCode);
            }
        }

        if (empty($participant)) {
            $this->parameters = array_merge($this->parameters, array("error"=>"Wrong participant id"));
            return $this->render("::error.html.twig",
                    $this->parameters);
        }
        $form = $this->createForm(new SignUpAboutForm($this->container));
        $clientIp = $request->getClientIp();
        if ($clientIp == '127.0.0.1'|| strpos($clientIp, '192.168.244.')!== false) {
            $country = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Country')->findOneByCountryCode('UA');
        }
        $geoip = $this->container->get('maxmind.geoip')->lookup($clientIp);
        if ($geoip != false) {
            $countryCode = $geoip->getCountryCode();
            $country = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Country')->findOneByCountryCode($countryCode);
        }
        
        if ($request->getMethod() == 'POST') {
            $data = $request->request->all();
            $participantData = array();
            $message = null;
            if (isset($data['signup_about']['raceSelect'])) {
                foreach ($data['signup_about']['raceSelect'] as $race) {
                        if ($race = $em->getRepository('CyclogramProofPilotBundle:Race')->find($race)) {
                            $raceLink = new ParticipantRaceLink();
                            $raceLink->setParticipant($participant);
                            $raceLink->setRace($race);
                            $em->persist($raceLink);
                            $em->flush();
                            $participantData['RACE'][] = $race->getRaceId();
                        } else {
                            $message[] = " race ";
                        } 
                    }
                } else {
                    $participantData['RACE'] = null;
                }
         
                if (!empty($data['sexSelect'])) {
                    if($sex = $em->getRepository('CyclogramProofPilotBundle:Sex')->find($data['sexSelect'])){
                        $participant->setSex($sex);
                        $participantData['SEX'] = $sex->getSexId();
                    } else {
                        $message[] =" sex ";
                    }
                } else {
                    $participantData['SEX'] = null;
                }
              
                if (!empty($data['countrySelect'])) {
                    if($participantcountry = $em->getRepository('CyclogramProofPilotBundle:Country')->find($data['countrySelect'])) {
                        $participant->setCountry($participantcountry);
                        $participantData['COUNTRY'] = $participantcountry->getCountryId();
                    } else {
                        $message[] =" country ";
                    }
                } else {
                    $participantData['COUNTRY'] = null;
                }
                    
                if (isset($data['signup_about']['zipcode']) && !empty($data['signup_about']['zipcode'])) {
                    $participant->setParticipantZipcode($data['signup_about']['zipcode']);
                    $participantData['ZIPCODE'] = $data['signup_about']['zipcode'];
                } else {
                    $participantData['ZIPCODE'] = null;
                }
                
                if (!empty($data['signup_about']['yearsSelect']) || !empty($data['monthsSelect']) || !empty($data['signup_about']['daysSelect'])) {
                    $date = new \DateTime();
                    if($date = $date->setDate((int)$data['signup_about']['yearsSelect'], (int)$data['monthsSelect'], (int)$data['signup_about']['daysSelect'])) {
                        $participant->setParticipantBirthdate($date);
                        $currentDate = new \DateTime();
                        $diff = $currentDate->diff($date);
                        $participant->setAge($diff->y);
                        $participantData['AGE'] = $diff->y;
                    }else{
                        $message[] = " birthdate ";
                    }
                } else {
                    $participantData['AGE'] = null;
                }
                if (!empty($data['gradeSelect'])) {
                    if ($gradeLevel = $em->getRepository('CyclogramProofPilotBundle:GradeLevel')->find($data['gradeSelect'])) {
                        $participant->setGradeLevel($gradeLevel);
                        $participantData['GRADELEVEL'] = $gradeLevel->getGradeLevelId();
                    } else {
                        $message[] = ' grade level ';
                    }
                }else {
                    $participantData['GRADELEVEL'] = null;
                }
                    
                if (!empty($data['industrySelect'])) {
                    if ($industry = $em->getRepository('CyclogramProofPilotBundle:Industry')->find($data['industrySelect'])) {
                        $participant->setIndustry($industry);
                        $participantData['INDUSTRY'] = $industry->getIndustryId();
                    } else {
                        $message[] = ' industry ';
                    }
                }else {
                    $participantData['INDUSTRY'] = null;
                }
                
                if (isset($data['signup_about']['anunalIncome'])) {
                    $participant->setAnnualIncome($data['signup_about']['anunalIncome']);
                    $participantData['INCOME'] = $data['signup_about']['anunalIncome'];
                } else {
                    $participantData['INCOME'] = null;
                }
                
                if (!empty($data['maritalStatusSelect'])) {
                    if ($maritalStatus = $em->getRepository('CyclogramProofPilotBundle:MaritalStatus')->find($data['maritalStatusSelect'])) {
                        $participant->setMaritalStatus($maritalStatus);
                        $participantData['MARITALSTATUS'] = $maritalStatus->getMaritalStatusId();
                    }else{
                        $message[] = ' marital status ';
                    }
                } else {
                    $participantData['MARITALSTATUS'] = null;
                }
                
                $participant->setParticipantInterested($data['interestedSelect']);
                if ($data['interestedSelect'] == 'm')
                    $participantData['SEXWITH'] = 1;
                if ($data['interestedSelect'] == 'w')
                    $participantData['SEXWITH'] = 2;
                if ($data['interestedSelect'] == 'mw'){
                    $participantData['SEXWITH'][] = 1;
                    $participantData['SEXWITH'][] = 2;
                }
                if (isset($data['childrenSelect']) ){
                     if ($data['childrenSelect'] == 'have') {
                         $participant->setChildren(1);
                         $participantData['CHILDREN'] = 'Y';
                     }
                     if ($data['childrenSelect'] == 'nothave') {
                         $participant->setChildren(0);
                         $participantData['CHILDREN'] = 'N';
                     };
                     if (empty($data['childrenSelect'])) {
                         $participant->setChildren(0);
                         $participantData['CHILDREN'] = 'N';
                     }
                } else {
                    $participantData['CHILDREN'] = null;
                }
                
                $participantData['PHONE'] = $participant->getParticipantMobileNumber();
                $participantData['MAILING_ADDRESS'] = $participant->getParticipantAddress1();
                $participant->setParticipantBasicInformation(true);
                $participant->setParticipantAboutMe(json_encode($participantData));
                $em->persist($participant);
                $em->flush();
                
                if ($request->isXmlHttpRequest()) {
                    if ($message == null &&$studyCode !== 'jsCode') {
                        $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
                        if ($study->getStudySkipConsent()) {
                            $participant = $this->get('security.context')->getToken()->getUser();
                            if ($participant != 'anon.') {
                                $redirectUrl = $this->generateUrl("_main");
                            } else {
                                $redirectUrl = $this->generateUrl("_signup");
                            }
                            $studyContent = $em->getRepository('CyclogramProofPilotBundle:StudyContent')->findOneByStudyUrl($studyCode);
                            $eligibilitySurvey = $studyContent->getStudyElegibilitySurvey();
                            if(is_null($eligibilitySurvey)) {
                                $logic = $this->get('study_logic');
                                $url = $logic->studyRegistration($participant, $studyCode, null, null);
                                return new Response(json_encode(array('error' => false, 'url' => $url)));
                            }
                             return new Response(json_encode(array('error' => false, 'url' => $this->generateUrl("_eligibility_survey", array('studyCode' => $studyCode,'surveyId' => $surveyId, 'redirectUrl' => $redirectUrl)))));
                        } else {
                            return new Response(json_encode(array('error' => false)));
                        }
                    } else { 
                        return new Response(json_encode(array('error' => true, 'message' => 'Invalid : '.implode(',', $message) )));
                    }
                }
                if ($message == null) {
                    if (isset($studyCode) && $studyCode !== 'jsCode') {
                        $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
                        $studyContent =  $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:StudyContent")->getStudyContent($study->getStudyCode(), $locale);
                        if ($study->getStudySkipConsent()) {
                            return $this->OauthRedirect($studyCode);
                        } else {
                            $this->parameters = array_merge($this->parameters , array('surveyId' => $studyContent->getStudyElegibilitySurvey(), 'studycontent' => $studyContent));
                            return $this->render('CyclogramFrontendBundle:Authentification:consent_main.html.twig',$this->parameters );
                        }
                    } else {
                        return $this->OauthRedirect($studyCode);
                    }
                } else {
                    $this->parameters = array_merge($this->parameters , array (
                                    'formAbout' => $form->createView(),
                                    'error' =>'Invalid : '.implode(',', $message)
                                ));
                   return $this->render('CyclogramFrontendBundle:Authentification:signup_about.html.twig',$this->parameters);
                }
            }
            $this->parameters = array_merge($this->parameters , array (
                    'formAbout' => $form->createView()
            ));
        return $this->render('CyclogramFrontendBundle:Authentification:signup_about.html.twig',$this->parameters);
    }
    
    /**
     * @Route("/consent/{studyCode}/{surveyId}", name="_consent", defaults={"surveyId" = null})
     * @Template()
     */
    public function signupConsentAction($studyCode, $surveyId =null) {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $participant = $this->get('security.context')->getToken()->getUser();
            $studyContent = $em->getRepository('CyclogramProofPilotBundle:StudyContent')->findOneByStudyUrl($studyCode);
            $eligibilitySurvey = $studyContent->getStudyElegibilitySurvey();
            if(is_null($eligibilitySurvey)) {
                if ($participant == 'anon.') {
                    $bag = new AttributeBag();
                    $bag->setName("SurveyInfo");
                    $array = array();
                    $bag->initialize($array);
                    $bag->set('surveyId', null);
                    $bag->set('saveId', null);
                    $bag->set('studyCode', $studyCode);
                    $session->registerBag($bag);
                    $session->set('SurveyInfo', $bag);
                    return $this->redirect( $this->generateUrl("_signup"));
                } else {
                    $logic = $this->get('study_logic');
                    $url = $logic->studyRegistration($participant, $studyCode, null, null);
                    return $this->redirect( $url);
                }
            }
            if ($participant != 'anon.') {
                $redirectUrl = $this->generateUrl("_main");
            } else {
                $redirectUrl = $this->generateUrl("_signup");
            }

                
            return $this->redirect( $this->generateUrl("_eligibility_survey", array('studyCode' => $studyCode,'surveyId' => $surveyId, 'redirectUrl' => $redirectUrl)));
    }
    

    
    /**
     * @Route("/signup_email_verify/{email}/{code}", name="email_verify")
     * @Template()
     */
    public function confirmEmailAction($email, $code)
    {
        $request = $this->getRequest();
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
    
        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->findOneBy(array('participantEmailCode' =>$code, 'participantEmail' => $email));
    
        if ($participant) {
            $participant->setParticipantEmailConfirmed(true);
            $em->persist($participant);
            $em->flush($participant);
    
            $session->set('confirmed', $this->get('translator')->trans('mail_confirmation_success', array(), 'register'));
            return $this->redirect( $this->generateUrl("_main"));
    
        } else {
            $error = $this->get('translator')->trans('mail_confirmation_fail', array(), 'register');
            $this->parameters = array_merge($this->parameters, array('error' => $error));
            return $this->render('CyclogramFrontendBundle:Email:email_confirm.html.twig', $this->parameters);
        }
         
    }
    
    /**
     * @Route("/forgot_username", name="_forgot_username")
     * @Template()
     */
    public function forgotUserAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        if ($this->get('security.context')->isGranted("ROLE_PARTICIPANT")){
            return $this->redirect($this->get('router')->generate("_main"));
        }
        
        $form = $this->createForm(new MailAddressForm($this->container));
    
        if( $request->getMethod() == "POST"){
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            if( $form->isValid() ) {
                $values = $form->getData();
                $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->findOneByParticipantEmail($values['participantEmail']);
                $userName = $participant->getParticipantUserName();
                if (is_null($userName)) {
                    $fid = $participant->getFacebookId();
                    $gid = $participant->getGoogleId();
                    if (!is_null($fid))
                        $parameters['registrationWith'] = 'Facebook';
                    elseif (!is_null($gid))
                        $parameters['registrationWith'] = 'Google';
                } else {
                    $parameters['userName'] = $participant->getParticipantUsername();
                }
                $parameters['email'] = $values['participantEmail'];
                $parameters['locale'] = $request->getLocale();
                $parameters['host'] = $this->container->getParameter('site_url');
                
                $cc = $this->get('cyclogram.common');
                
                $embedded = array();
                $embedded = $cc->getEmbeddedImages();
                
                $send = $cc->sendMail(null,
                        $values['participantEmail'],
                        $this->get('translator')->trans("forgot_username", array(), "email", $parameters['locale']),
                        'CyclogramFrontendBundle:Email:forgot_username_email.html.twig',
                        null,
                        $embedded,
                        true,
                        $parameters);

                if ($request->isXmlHttpRequest()){
                    if($send['status'] == true)
                        return new Response(json_encode(array('error' => false, 'message' => $this->get('translator')->trans("forgot_username_email_send", array(), "login",$request->getLocale()))));
                    else 
                        return new Response(json_encode(array('error' => true, 'message' => $send['message'])));
                }
                if($send['status'] == true) {
                    return $this->render('CyclogramFrontendBundle:Authentification:username_sent.html.twig', $this->parameters);
                } else { 
                    $this->parameters = array_merge($this->parameters, array(
                                    'formForgorUsername' => $form->createView(),
                                    'error' => $send['message']
                            ));
                    return $this->render('CyclogramFrontendBundle:Authentification:forgot_username.html.twig',$this->parameters);
                }
            } elseif ($request->isXmlHttpRequest()) {
                $validator = $this->container->get('validator');
                $errors = $validator->validate($form);
                foreach ($errors as $err) {
                    $messages = $err->getMessage();
                }
                return new Response(json_encode(array('error' => true, 'message' => $messages)));
            }
        }
        $this->parameters = array_merge($this->parameters, array(
                'formForgorUsername' => $form->createView(),
        ));
        return $this->render('CyclogramFrontendBundle:Authentification:forgot_username.html.twig',$this->parameters);
    }
    
    /**
     * @Route("/forgot_pass", name="_forgot_pass")
     * @Template()
     */
    public function forgotPassAction(Request $request)
    {
        $form = $this->createFormBuilder()
        ->add('participantUsername', 'text', array(
                'label'=>'label_username'
        ))
        ->add('sendPass', 'submit', array(
                'label' => 'btn_send_pass'))
                ->getForm();
    
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
    
        if( $request->getMethod() == "POST" ){
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            if( $form->isValid() ) {
    
                $values = $request->request->get('form');
                $username = $values['participantUsername'];
                $participant = $em->getRepository("CyclogramProofPilotBundle:Participant")->findOneByParticipantUsername($username);
    
                if (!empty($participant)) {
                    $parameters['id'] = $participant->getParticipantId();
                    $parameters['email'] = $participant->getParticipantEmail();
                    $parameters['locale'] = $participant->getLocale() ? $participant->getLocale() : $request->getLocale();
                    $parameters['host'] = $this->container->getParameter('site_url');
    
                    $cc = $this->get('cyclogram.common');
    
                    $embedded = array();
                    $embedded = $cc->getEmbeddedImages();
    
                    $send = $cc->sendMail(null,
                            $participant->getParticipantEmail(),
                            $this->get('translator')->trans("email_reset_password", array(), "email", $parameters['locale']),
                            'CyclogramFrontendBundle:Email:reset_password_email.html.twig',
                            null,
                            $embedded,
                            true,
                            $parameters);
                    if ($request->isXmlHttpRequest()) {
                        if ($send['status'] == true)
                            return new Response(json_encode(array('error' => false)));
                        else 
                            return new Response(json_encode(array('error' => true, 'message' => $send['message'] )));
                    }
                    return $this->render('CyclogramFrontendBundle:Authentification:reset_password_confirmation.html.twig', $this->parameters);
                } else {
                    if ($request->isXmlHttpRequest())
                        return new Response(json_encode(array('error' => true, 'message' => $this->get('translator')->trans("doesnt_match_records", array(), "login"))));
                    $this->parameters = array_merge($this->parameters,  array(
                                    "formForgotPassword" => $form->createView(),
                                    "error" => $this->get('translator')->trans("doesnt_match_records", array(), "login")
                            ));
                    return $this->render('CyclogramFrontendBundle:Authentification:forgot_your_password.html.twig',$thi->parameters);
                }
            } elseif ($request->isXmlHttpRequest()) {
                if ($request->isXmlHttpRequest())
                    return new Response(json_encode(array('error' => true, 'message' => $this->get('translator')->trans("doesnt_match_records", array(), "login"))));
            }
        }
        $this->parameters = array_merge($this->parameters,  array(
                "formForgotPassword" => $form->createView()
        ));
        return $this->render('CyclogramFrontendBundle:Authentification:forgot_your_password.html.twig',$this->parameters);
    }
    
    /**
     * @Route("/create_pass/{id}" , name="_create_new_pass")
     * @Template()
     */
    public function createPassAction($id)
    {
        $request = $this->getRequest();
        $session = $this->getRequest()->getSession();
    
        $collectionConstraint = new Collection(array(
                'fields' => array(
                        'participantPassword' => new Length(array('min' => 8))
                )
        ));
        $form = $this->createFormBuilder(null, array('constraints' => $collectionConstraint))
        ->add('participantPassword', 'repeated', array(
                'type' => 'password',
                'first_options'  => array(
                        'label' => 'label_new_pass'
                ),
                'second_options' => array(
                        'label' => 'label_repeat_pass'
                ),
                'invalid_message' => 'The password fields must match.',
        ))
        ->add('savePass', 'submit', array(
                'label' => 'btn_save_pass'
        ))
        ->getForm();
    
        $em = $this->getDoctrine()->getManager();
        $study = null;
        $request = $this->getRequest();
    
        if( $request->getMethod() == "POST" ){
            $participant = $em->getRepository("CyclogramProofPilotBundle:Participant")->find($id);
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            if( $form->isValid() ) {
                $values = $request->request->get('form');
                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($participant);
    
                $participant->setParticipantPassword($encoder->encodePassword($values['participantPassword']['first'], $participant->getSalt()));
    
                $em->persist($participant);
                $em->flush($participant);
                return $this->render('CyclogramFrontendBundle:Authentification:password_changed.html.twig', $this->parameters);
            }
        }
        $this->parameters = array_merge($this->parameters,                 array(
                        "form" => $form->createView(),
                        'id' => $id
                ));
        return $this->render('CyclogramFrontendBundle:Authentification:create_new_password.html.twig',$this->parameters);
    }
    
    /**
     * Create new participant
     * @param Participant $formData
     */
    private function createParticipant($formData, $studyCode = null) {
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $participant = new Participant();
        $participnat_level = $em->getRepository('CyclogramProofPilotBundle:ParticipantLevel')->findOneByParticipantLevelName('Lead');
        $participant->setLevel($participnat_level);
        $participant->setParticipantEmail($formData->getParticipantEmail());
        $participant->setParticipantAppreciationEmail($formData->getParticipantEmail());
        $factory = $this->get('security.encoder_factory');
        $encoder = $factory->getEncoder($participant);
        
        $participant->setParticipantPassword($encoder->encodePassword($formData->getParticipantPassword(), $participant->getSalt()));
        $participant->setParticipantUsername($formData->getParticipantUsername());
        $question = $em->getRepository('CyclogramProofPilotBundle:RecoveryQuestion')->find(1);
        $participant->setRecoveryQuestion($question);
        $participant->setRecoveryPasswordCode('Default');
        $participant->setParticipantEmailConfirmed(false);
        $participant->setParticipantBasicInformation(false);
        //$participant->setParticipantMobileNumber('');
        $participant->setParticipantMobileSmsCodeConfirmed(false);
        $participant->setParticipantIncentiveBalance(false);
        $participant->setLocale($request->getLocale());
        $language = $em->getRepository('CyclogramProofPilotBundle:Language')->findOneByLocale($request->getLocale());
        $participant->setParticipantLanguage($language);
        $participant->setParticipantRegistrationTime(new \DateTime('now'));
        $timezone = $em->getRepository('CyclogramProofPilotBundle:ParticipantTimeZone')->find(1);
        $participant->setParticipantTimezone($timezone);
        $participant->setParticipantLastTouchDatetime(new \DateTime(null, new \DateTimeZone($participant->getParticipantTimezone()->getParticipantTimezoneName())));
        $participant->setParticipantZipcode('');
        $role = $em->getRepository('CyclogramProofPilotBundle:ParticipantRole')->find(1);
        $participant->setParticipantRole($role);
        $participant->setStatus(Participant::STATUS_ACTIVE);
        $mailCode = substr(md5( md5( $participant->getParticipantEmail() . md5(microtime()))), 0, 4);
        $roles = array("ROLE_USER", "ROLE_PARTICIPANT");
        $participant->setRoles($roles);
        $participant->setParticipantEmailCode($mailCode);
//         if ($participant->getParticipantEmailConfirmed() == false && (is_null($studyCode) && !$session->has('SurveyInfo'))) {
            $this->confirmParticipantEmail($participant);
//         }
        $em->persist($participant);
        $em->flush($participant);
        
        //default contact time to SAT morning
	        $contactTimes = $em->getRepository('CyclogramProofPilotBundle:ParticipantContactTime')
	        										->findAll();
	        foreach ($contactTimes as $contactTime) {
    	        for ($i=0; $i<7; $i++){
    	            $em->getRepository('CyclogramProofPilotBundle:ParticipantContactTimeLink')
    	            ->updateParticipantContactTimeLink($participant, $contactTime, $i, true, true);
    	        }
	        }
	        $psrs = $em->getRepository('CyclogramProofPilotBundle:ParticipantStudyReminder')
	        						->findAll();
	        foreach ($psrs as $psr) {
    	        $psrl = new ParticipantStudyReminderLink();
    	        $psrl->setParticipantStudyReminder($psr);
    	        $psrl->setParticipant($participant);
    	        $psrl->setByEmail(true);
    	        $psrl->setBySms(true);
    	        $em->persist($psrl);
	        }
        //END
        $em->flush();
        
        $token = new UsernamePasswordToken($participant, null, 'main', $roles);
        $this->get('security.context')->setToken($token);
    }
    
    /**
     * Send email to confirm participant has indicated a real email address
     * @param Participant $participant
     */
    public  function confirmParticipantEmail(Participant $participant, $studyCode = null)
    {
        $locale = $this->getRequest()->getLocale();
        $em = $this->getDoctrine()->getManager();
        if($participant->getParticipantEmailConfirmed() == false) {
            $cc = $this->get('cyclogram.common');
    
            $embedded = array();
            $embedded = $cc->getEmbeddedImages();
    
            $parameters['code'] = $participant->getParticipantEmailCode();
            $participant->setParticipantEmailCode($parameters['code']);
            $em->persist($participant);
            $em->flush($participant);
            if (!empty($studyCode) && $studyCode !== 'jsCode')
                $parameters['studyCode'] = $studyCode;
            $parameters['email'] = $participant->getParticipantEmail();
    
            $parameters['locale'] = $participant->getLocale() ? $participant->getLocale() : $request->getLocale();
            $parameters['host'] = $this->container->getParameter('site_url');
            $parameters["studies"] = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Study')->getRandomStudyInfo($locale, $participant);
    
            $cc->sendMail(null,
                    $participant->getParticipantEmail(),
                    $this->get('translator')->trans("email_title_verify", array(), "email", $parameters['locale']),
                    'CyclogramFrontendBundle:Email:email_confirmation.html.twig',
                    null,
                    $embedded,
                    true,
                    $parameters);
        }
    }
    
    /**
     * Get the security error for a given request.
     *
     * @param Request $request
     *
     * @return string|\Exception
     */
    protected function getErrorForRequest(Request $request)
    {
        $session = $request->getSession();
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }
    
        return $error;
    }
    
    protected function OauthRedirect($studyCode = null)
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        if (isset($studyCode) && $studyCode !== 'jsCode') {
            $redirectUrl = $this->generateUrl("_main");
            $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
            $language = $em->getRepository('CyclogramProofPilotBundle:Language')->findOneByLocale($request->getLocale());
            $studyContent =  $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:StudyContent")->findOneBy(array('study' => $study->getStudyId(),'language' => $language));
            $eligibilitySurvey = $studyContent->getStudyElegibilitySurvey();
            if(is_null($eligibilitySurvey)) {
                $participant = $this->get('security.context')->getToken()->getUser();
                $logic = $this->get('study_logic');
                $url = $logic->studyRegistration($participant, $studyCode, null, null);
                return $this->redirect($url);
            }
            return $this->redirect($this->generateUrl("_eligibility_survey", array('studyCode'=> $studyCode, 'surveyId' => $studyContent->getStudyElegibilitySurvey(), 'redirectUrl' => $redirectUrl)));
        } else {
            return $this->redirect($this->generateUrl("_main"));
        }
    }
    
    /**
     * @param Request $request
     * @param string  $service
     *
     * @return RedirectResponse
     */
    public function redirectToServiceAction(Request $request, $service)
    {
        // Check for a specified target path and store it before redirect if present
        $param = $this->container->getParameter('hwi_oauth.target_path_parameter');
    
        $studyCode = $request->get('studyCode');
        $recruiter = $request->get('recruiter');
        $extraParameters = array();
        if($studyCode)
            $extraParameters["state"] = $studyCode;
    
        if (!empty($param) && $request->hasSession() && $targetUrl = $request->get($param, null, true)) {
            $providerKey = $this->container->getParameter('hwi_oauth.firewall_name');
            $request->getSession()->set('_security.' . $providerKey . '.target_path', $targetUrl);
        }
    
        return new RedirectResponse(
                $this->container->get('hwi_oauth.security.oauth_utils')->getAuthorizationUrl(
                        $request,
                        $service,
                        null,
                        $extraParameters)
    
        );
    }

    
    /**
     * @Route("/prelaunch/{studyCode}/{recruiter}/{email}", name="_pre_launch", defaults={"email" = null})
     * @Template()
     */
    public function preLaunchRegistrationAction($studyCode,$recruiter, $email = null)
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        if ($this->get('security.context')->isGranted("ROLE_USER")){
            $participant = $this->get('security.context')->getToken()->getUser();
            $this->prelauncCmpaignRegistration($participant,$studyCode, $recruiter);
            return $this->redirect($this->generateUrl('_page', array(
                    'studyUrl' => $studyCode,
                    'preLaunch' => $this->get('translator')->trans("we_will_notify_prelaunch", array(), "study")
            )));
        }
        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->findOneByParticipantEmail($email);
        if (isset($participant)) {
            $participantLevel = $participant->getLevel()->getParticipantLevelName();
            if ($participantLevel == 'Pre-Launch') {
                $this->prelauncCmpaignRegistration($participant, $studyCode, $recruiter);
                return $this->redirect($this->generateUrl('_page', array(
                        'studyUrl' => $studyCode,
                        'preLaunch' => $this->get('translator')->trans("we_will_notify_prelaunch", array(), "study")
                )));
            }
            return $this->redirect($this->generateUrl('_page', array(
                    'studyUrl' => $studyCode,
                    'preLaunch' => $this->get('translator')->trans("login_to_prelaunch", array(), "study")
            )));
        }else {
            $participant = new Participant();
            $participant->setParticipantEmail($email);
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($participant);
            $participant->setParticipantPassword($encoder->encodePassword(md5(uniqid($email, true)), $participant->getSalt()));
            $question = $em->getRepository('CyclogramProofPilotBundle:RecoveryQuestion')->find(1);
            $participant->setRecoveryQuestion($question);
            $participant->setRecoveryPasswordCode('Default');
            $participnat_level = $em->getRepository('CyclogramProofPilotBundle:ParticipantLevel')->findOneByParticipantLevelName('Pre-Launch');
            $participant->setLevel($participnat_level);
            $mailCode = substr(md5( md5( $participant->getParticipantEmail() . md5(microtime()))), 0, 4);
            $participant->setParticipantEmailCode($mailCode);
            $participant->setParticipantEmailConfirmed(false);
            $roles = array("ROLE_USER", "ROLE_PARTICIPANT");
            $participant->setRoles($roles);
            $participant->setParticipantMobileSmsCodeConfirmed(false);
            $participant->setParticipantIncentiveBalance(0);
            $timezone = $em->getRepository('CyclogramProofPilotBundle:ParticipantTimeZone')->find(1);
            $participant->setParticipantTimezone($timezone);
            $participant->setParticipantLastTouchDatetime(new \DateTime(null, new \DateTimeZone($participant->getParticipantTimezone()->getParticipantTimezoneName())));
            $participant->setParticipantZipcode(' ');
            $role = $em->getRepository('CyclogramProofPilotBundle:ParticipantRole')->find(1);
            $participant->setParticipantRole($role);
            $participant->setStatus(Participant::STATUS_ACTIVE);
            $participant->setLocale($request->getLocale());
            $language = $em->getRepository('CyclogramProofPilotBundle:Language')->findOneByLocale($request->getLocale());
            $participant->setParticipantLanguage($language);
            $participant->setParticipantBasicInformation(false);
            $em->persist( $participant);
            
            $this->prelauncCmpaignRegistration($participant,$studyCode, $recruiter);
            
            return $this->redirect($this->generateUrl('_page', array(
                    'studyUrl' => $studyCode,
                    'preLaunch' => $this->get('translator')->trans("we_will_notify_prelaunch", array(), "study")
            )));
        }
        
        return $this->redirect($this->generateUrl("_page", array('studyUrl' => $studyCode)));
    }
    
    private function prelauncCmpaignRegistration($participant, $studyCode, $recruiter) {
        $request = $this->getRequest();
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $siteId = $session->get('referralSite');
        $campaignId = $session->get('referralCampaign');
        $session->remove('referralSite');
        $session->remove('referralCampaign');
        if(!$siteId || !$campaignId )
            throw new \Exception("Could not reliably determine campaign and site from session. Cancelling registration");
        
        $campaign = $em->getRepository('CyclogramProofPilotBundle:Campaign')->find($campaignId);
        $site = $em->getRepository('CyclogramProofPilotBundle:Site')->find($siteId);
        
        $participantLevelRepo = $em->getRepository('CyclogramProofPilotBundle:ParticipantLevel');
        $participantLevel = $participantLevelRepo->findOneByParticipantLevelName('Pre-Launch');
        
        //Campaign
        $ParticipantCampaignLinkCountData =  $em->getRepository('CyclogramProofPilotBundle:ParticipantCampaignLink')
            ->findBy( array("participantCampaignLinkParticipantEmail"=>$participant->getParticipantEmail()) );
        
        $ParticipantCampaignLinkCount = ( is_array($ParticipantCampaignLinkCountData) ) ? count($ParticipantCampaignLinkCountData) : 0;
        
        $participantCampaignLinkId = CyclogramCommon::generateParticipantCampaignLinkID(
                $participantLevel->getParticipantLevelId(),
                $participant->getParticipantId(),
                $campaign->getCampaignId(),
                $ParticipantCampaignLinkCount
        );
        
        //ParticipantCampaignLink
        $uniqId = uniqid();
        $campaignLinkCheck =$em->getRepository('CyclogramProofPilotBundle:Campaign')->checkIfIssetParticipanCampaigLink($studyCode,$campaignId, $siteId, $participant);
        
        $campaignLink = isset($campaignLinkCheck) ? $campaignLinkCheck : new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantCampaignLink();
        $campaignLink->setParticipant( $participant );
        $campaignLink->setCampaign( $campaign );
        $campaignLink->setParticipantLevel( $participantLevel );
        $campaignLink->setParticipantSurveyLinkUniqid( $uniqId );
        $campaignLink->setParticipantCampaignLinkId( $participantCampaignLinkId );
        $campaignLink->setParticipantCampaignLinkParticipantEmail( $participant->getParticipantEmail() );
        $campaignLink->setParticipantCampaignLinkIpAddress( $_SERVER['REMOTE_ADDR'] );
        $campaignLink->setParticipantCampaignLinkDatetime( new \DateTime("now") );
        $campaignSiteLink = $em->getRepository('CyclogramProofPilotBundle:CampaignSiteLink')->findOneBy(array('campaign' => $campaign,'site' => $site));
        $campaignLink->setCampaignSiteLink($campaignSiteLink);
        if($recruiter)
            $campaignLink->setIsParticipantRecruiter(true);
        else
            $campaignLink->setIsParticipantRecruiter(false);
        if($site)
            $campaignLink->setSite( $site );
        
        $em->persist( $campaignLink );
        $em->flush();
        
        $parameters['locale'] = $locale = $participant->getLocale() ? $participant->getLocale() : $request->getLocale();
        
        $cc = $this->get('cyclogram.common');
        $embedded = array();
        $embedded = $cc->getEmbeddedImages();
            if (!empty($studyCode)  && $studyCode !== 'jsCode')
                $parameters['studyCode'] = $studyCode;
            $parameters['email'] = $participant->getParticipantEmail();
            $studyEntity = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneBystudyCode($studyCode);
            $studyContent = $em->getRepository('CyclogramProofPilotBundle:StudyContent')->findOneBy(
            													array(
            															'studyId' => $studyEntity->getStudyId(), 
            															'language' => $em->getRepository('CyclogramProofPilotBundle:Language')->findOneBylocale($locale))
            														 );
            $parameters['studyName'] = $studyContent->getStudyName();
            $parameters['study_logo'] = $this->container->getParameter('study_image_url') . '/' .
            $campaignLink->getCampaign()->getPlacement()->getStudy()->getStudyId() . '/' .$studyContent->getStudyGraphic();
    
            $parameters['host'] = $this->container->getParameter('site_url');
            $randomStudies = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Study')->getRandomStudyInfo($locale, $participant, $studyCode);
            
            $study = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
            $preLaunchStudy[$studyEntity->getStudyId()] = $studyCode;
            foreach ($randomStudies as $study) {
                if (!array_key_exists($study['studyId'],$preLaunchStudy))
                    $studies[] = $study;
            }
            if (count($studies) >= 3) {
                $resultsKeys = array_rand($studies, 3);
                foreach ($resultsKeys as $key=>$val) {
                    $parameters['studies'][] = $studies[$val];
                }
            } else {
                $parameters['studies'] = $studies;
            }
    
            $cc->sendMail(null,
                    $participant->getParticipantEmail(),
                    $this->get('translator')->trans("email_title_prelaunch", array('%studyName%' => $parameters['studyName']), "email", $parameters['locale']),
                    'CyclogramFrontendBundle:Email:email_prelaunch_confirmation.html.twig',
                    null,
                    $embedded,
                    true,
                    $parameters);
        
    }
}
