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

    /**
     * @Route("/signup/{studyCode}/{surveyId}", name="_signup", defaults={"studyCode"= null, "surveyId" = null})
     * @Template()
     */
    public function signupStartAction(Request $request, $studyCode=null, $surveyId=null)
    {

        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        if ($this->get('security.context')->isGranted("ROLE_USER")){
            return $this->redirect($this->get('router')->generate("_main"));
        }
        // registration check
        $form = $this->createForm(new RegistrationForm($this->container));
        $form->handleRequest($request);
        if ($form->isValid()) {
            $registration = $form->getData();
            $this->createParticipant($registration);
            if ($request->isXmlHttpRequest()) {
                $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
                if ($study->getStudySkipAboutMe() && $study->getStudySkipConsent()) {
                    $redirectUrl = $this->generateUrl("_main");
                    return new Response(json_encode(array('error' => false, 'url' => $this->generateUrl("_eligibility_survey", array('studyCode' => $studyCode,'surveyId' => $surveyId, 'redirectUrl' => $redirectUrl)))));
                    
                }
                return new Response(json_encode(array('error' => false)));
            } elseif ($request->getMethod() == 'POST') {
                
                if ($session->has('SurveyInfo')) {
                    if ($session->has('referralSite') && $session->has('referralCampaign')){
                        $ls = $this->get('study_logic');
                        $bag = $session->get('SurveyInfo');
                        $surveyId = $bag->get('surveyId');
                        $saveId = $bag->get('saveId');
                        $studyCode = $bag->get('studyCode');
                        $session->remove('SurveyInfo');
                        $securityContext = $this->container->get('security.context');
                        $participant = $securityContext->getToken()->getUser();
                
                        $ls->studyRegistration($participant, $studyCode, $surveyId, $saveId);
                        $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
                        if ($study->getStudySkipAboutMe()) {
                            return $this->redirect( $this->generateUrl("_main"));
                        }
                    } else {
                        $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
                        $studyContent = $em->getRepository('CyclogramProofPilotBundle:StudyContent')->findOneByStudy($study);
                        $session->set("message", $this->get('translator')->trans('study_register_error', array(), 'register'));
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
            if ($request->isXmlHttpRequest()) 
                
                return new Response(json_encode(array('error' => true)));
            else
                return $this->render('CyclogramFrontendBundle:Authentification:signup.html.twig', array(
                        'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                        'form' => $form->createView(),
                        'error'         => $error
                ));
        }
        //render forms
        return $this->render('CyclogramFrontendBundle:Authentification:signup.html.twig', array(
                    'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                    'form' => $form->createView()
        ));
    }
    
    /**
     * @Route("/login_check", name="login_check")
     */
    public function securityCheckAction()
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
        if ($request->isXmlHttpRequest()) {
            if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
                return new Response(json_encode(array('error' => true)));
            }
            return new Response(json_encode(array('error' => false, 'url' => $this->generateUrl("_main"))));
        }
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            return $this->redirect($this->generateUrl("_signup", array('error' => true)));
        }
        return $this->redirect($this->generateUrl("_main"));
    }
    
    
    /**
     * @Route("/doOauth/{studyCode}/{surveyId}", name="_do_oauth", defaults={"studyCode"= null, "surveyId"=null})
     * @Template()
     */
    public function doOauthAction(Request $request, $studyCode, $surveyId){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $locale = $this->getRequest()->getLocale()?$this->getRequest()->getLocale():'en';
        $language = $em->getRepository('CyclogramProofPilotBundle:Language')->findOneByLocale($locale);
        
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            return $this->redirect($this->generateUrl("_signup", array('error' => true)));
        }
        
        $participant = $this->get('security.context')->getToken()->getUser();
        if ($session->has('confirmation')) {
            $this->confirmParticipantEmail($participant);
            $session->remove('confirmation');
        }
        
        
        if (isset($studyCode)) {
            $isEnrolled = $em->getRepository('CyclogramProofPilotBundle:Participant')->isEnrolledInStudy($participant, $studyCode);
            if ($isEnrolled)
                return $this->redirect($this->generateUrl("_main"));
            $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
            $studyContent =  $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:StudyContent")->findOneBy(array('study' => $study->getStudyId(),'language' => $language));
            if ($study->getStudySkipAboutMe() && $study->getStudySkipConsent()) {
                $redirectUrl = $this->generateUrl("_main");
                $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
                $language = $em->getRepository('CyclogramProofPilotBundle:Language')->findOneByLocale($request->getLocale());
                return $this->redirect($this->generateUrl("_eligibility_survey", array('studyCode'=> $studyCode, 'surveyId' => $studyContent->getStudyElegibilitySurvey(), 'redirectUrl' => $redirectUrl)));
            }elseif ($study->getStudySkipAboutMe()) {
                return $this->render('CyclogramFrontendBundle:Authentification:consent_main.html.twig', array('studyCode' => $studyCode, 'surveyId' => $studyContent->getStudyElegibilitySurvey(),'studycontent' => $studyContent));
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
            if (isset($studyCode)) {
                $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
                $studyContent =  $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:StudyContent")->getStudyContent($study->getStudyCode(), $locale);
                if ($study->getStudySkipConsent())
                    return $this->OauthRedirect($studyCode);
                else
                    return $this->render('CyclogramFrontendBundle:Authentification:consent_main.html.twig', array('studyCode' => $studyCode, 'surveyId' => $studyContent->getStudyElegibilitySurvey(), 'studycontent' => $studyContent));
            } else {
                return $this->OauthRedirect($studyCode);
            }
        }

        if (empty($participant)) {
            return $this->render("::error.html.twig", array(
                    "error"=>"Wrong participant id"));
        }
        $form = $this->createForm(new SignUpAboutForm($this->container));
        $clientIp = $request->getClientIp();
        if ($clientIp == '127.0.0.1') {
            $country = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Country')->findOneByCountryCode('UA');
        }
        $geoip = $this->container->get('maxmind.geoip')->lookup($clientIp);
        if ($geoip != false) {
            $countryCode = $geoip->getCountryCode();
            $country = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Country')->findOneByCountryCode($countryCode);
        }
        
        if ($request->getMethod() == 'POST') {
            $data = $request->request->all();
            $message = null;
            if (isset($data['signup_about']['raceSelect'])) {
                foreach ($data['signup_about']['raceSelect'] as $race) {
                        if ($race = $em->getRepository('CyclogramProofPilotBundle:Race')->find($race)) {
                            $raceLink = new ParticipantRaceLink();
                            $raceLink->setParticipant($participant);
                            $raceLink->setRace($race);
                            $em->persist($raceLink);
                            $em->flush();
                        } else {
                            $message[] = " race ";
                        } 
                    }
                }
         
                if (!empty($data['sexSelect'])) {
                    if($sex = $em->getRepository('CyclogramProofPilotBundle:Sex')->find($data['sexSelect']))
                        $participant->setSex($sex);
                    else
                        $message[] =" sex ";
                }
              
                if (!empty($data['countrySelect'])) {
                    if($participantcountry = $em->getRepository('CyclogramProofPilotBundle:Country')->find($data['countrySelect']))
                        $participant->setCountry($participantcountry);
                    else
                        $message[] =" country ";
                }
                    
                if (isset($data['signup_about']['zipcode']))
                    $participant->setParticipantZipcode($data['signup_about']['zipcode']);
                
                if (isset($data['signup_about']['yearsSelect']) || isset($data['monthsSelect']) || isset($data['daysSelect'])) {
                    $date = new \DateTime();
                    if($date = $date->setDate((int)$data['signup_about']['yearsSelect'], (int)$data['monthsSelect'], (int)$data['daysSelect']))
                        $participant->setParticipantBirthdate($date);
                    else
                        $message[] = " birthdate ";
                }
                if (!empty($data['gradeSelect'])) {
                    if ($gradeLevel = $em->getRepository('CyclogramProofPilotBundle:GradeLevel')->find($data['gradeSelect']))
                        $participant->setGradeLevel($gradeLevel);
                    else
                        $message[] = ' grade level ';
                }
                    
                if (!empty($data['industrySelect'])) {
                    if ($industry = $em->getRepository('CyclogramProofPilotBundle:Industry')->find($data['industrySelect']))
                        $participant->setIndustry($industry);
                    else
                        $message[] = ' industry ';
                }
                
                if (isset($data['signup_about']['anunalIncome']))
                    $participant->setAnnualIncome($data['signup_about']['anunalIncome']);
                
                if (!empty($data['maritalStatusSelect'])) {
                    if ($maritalStatus = $em->getRepository('CyclogramProofPilotBundle:MaritalStatus')->find($data['maritalStatusSelect']))
                        $participant->setMaritalStatus($maritalStatus);
                    else
                        $message[] = ' marital status ';
                }
                
                $participant->setParticipantInterested($data['interestedSelect']);
                
                if (isset($data['childrenSelect']) ){
                     if ($data['childrenSelect'] == 'have')
                         $participant->setChildren(1);
                     if ($data['childrenSelect'] == 'nothave')
                         $participant->setChildren(0);
                     if (empty($data['childrenSelect']))
                         $participant->setChildren(0);
                }
                
                $participant->setParticipantBasicInformation(true);
                
                $em->persist($participant);
                $em->flush();
                
                if ($request->isXmlHttpRequest()) {
                    if ($message == null) {
                        $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
                        if ($study->getStudySkipConsent()) {
                            $participant = $this->get('security.context')->getToken()->getUser();
                            if ($participant != 'anon.') {
                                $redirectUrl = $this->generateUrl("_main");
                            } else {
                                $redirectUrl = $this->generateUrl("_signup");
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
                    if (isset($studyCode)) {
                        $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
                        $studyContent =  $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:StudyContent")->getStudyContent($study->getStudyCode(), $locale);
                        if ($study->getStudySkipConsent())
                            return $this->OauthRedirect($studyCode);
                        else
                            return $this->render('CyclogramFrontendBundle:Authentification:consent_main.html.twig', array('studyCode' => $studyCode, 'surveyId' => $studyContent->getStudyElegibilitySurvey(), 'studycontent' => $studyContent));
                    } else {
                        return $this->OauthRedirect($studyCode);
                    }
                } else {
                   return $this->render('CyclogramFrontendBundle:Authentification:signup_about.html.twig',
                            array (
                                    'formAbout' => $form->createView(),
                                    'countryName' => $country->getCountryName(),
                                    'countryId' => $country->getCountryId(),
                                    'currencySymbol' => $country->getCurrency()->getCurrencySymbol(), 
                                    'error' =>'Invalid : '.implode(',', $message)
                                ));
                }
            }
        
        return $this->render('CyclogramFrontendBundle:Authentification:signup_about.html.twig',
                array (
                        'formAbout' => $form->createView(),
                        'countryName' => $country->getCountryName(),
                        'countryId' => $country->getCountryId(),
                        'currencySymbol' => $country->getCurrency()->getCurrencySymbol()
                       ));
    }
    
    /**
     * @Route("/consent/{studyCode}/{surveyId}", name="_consent")
     * @Template()
     */
    public function signupConsentAction($studyCode, $surveyId) {
            $participant = $this->get('security.context')->getToken()->getUser();
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
            return $this->render('CyclogramFrontendBundle:Email:email_confirm.html.twig', array('error' => $error));
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
                $parameters['userName'] = $participant->getParticipantUsername();
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
                if($send['status'] == true)
                    return $this->render('CyclogramFrontendBundle:Authentification:username_sent.html.twig');
                else 
                    return $this->render('CyclogramFrontendBundle:Authentification:forgot_username.html.twig',
                            array(
                                    'formForgorUsername' => $form->createView(),
                                    'error' => $send['message']
                            ));
            } elseif ($request->isXmlHttpRequest()) {
                $validator = $this->container->get('validator');
                $errors = $validator->validate($form);
                foreach ($errors as $err) {
                    $messages = $err->getMessage();
                }
                return new Response(json_encode(array('error' => true, 'message' => $messages)));
            }
        }
        return $this->render('CyclogramFrontendBundle:Authentification:forgot_username.html.twig',
                array(
                        'formForgorUsername' => $form->createView()
                ));
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
                    if ($request->isXmlHttpRequest())
                        if ($send['status'] == true)
                            return new Response(json_encode(array('error' => false)));
                        else 
                            return new Response(json_encode(array('error' => true, 'message' => $send['message'] )));
                    return $this->render('CyclogramFrontendBundle:Authentification:reset_password_confirmation.html.twig');
                } else {
                    if ($request->isXmlHttpRequest())
                        return new Response(json_encode(array('error' => true, 'message' => $this->get('translator')->trans("doesnt_match_records", array(), "login"))));
                    return $this->render('CyclogramFrontendBundle:Authentification:forgot_your_password.html.twig',
                            array(
                                    "formForgotPassword" => $form->createView(),
                                    "error" => $this->get('translator')->trans("doesnt_match_records", array(), "login")
                            ));
                }
            } elseif ($request->isXmlHttpRequest()) {
                if ($request->isXmlHttpRequest())
                    return new Response(json_encode(array('error' => true, 'message' => $this->get('translator')->trans("doesnt_match_records", array(), "login"))));
            }
        }
        return $this->render('CyclogramFrontendBundle:Authentification:forgot_your_password.html.twig',
                array(
                        "formForgotPassword" => $form->createView()
                ));
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
                return $this->render('CyclogramFrontendBundle:Authentification:password_changed.html.twig');
            }
        }
        return $this->render('CyclogramFrontendBundle:Authentification:create_new_password.html.twig',
                array(
                        "form" => $form->createView(),
                        'id' => $id
                ));
    }
    
    /**
     * Create new participant
     * @param Participant $formData
     */
    private function createParticipant($formData) {
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
        if ($participant->getParticipantEmailConfirmed() == false)
            $this->confirmParticipantEmail($participant);

        $em->persist($participant);
        $em->flush($participant);
        
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
            if (!empty($studyCodey))
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
        if (isset($studyCode)) {
            $redirectUrl = $this->generateUrl("_main");
            $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
            $language = $em->getRepository('CyclogramProofPilotBundle:Language')->findOneByLocale($request->getLocale());
            $studyContent =  $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:StudyContent")->findOneBy(array('study' => $study->getStudyId(),'language' => $language));
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

}
