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
use Symfony\Component\HttpFoundation\Response;
use Cyclogram\FrontendBundle\Form\MobilePhoneForm;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;
use Common\DefaultParticipantStudy;
use Symfony\Component\Security\Core\SecurityContext;

class AuthentificationController extends Controller
{

    /**
     * @Route("/signup/{studyCode}", name="_signup", defaults={"studyCode"= null})
     * @Template()
     */
    public function signupStartAction(Request $request, $studyCode=null)
    {

        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        
        // registration check
        $form = $this->createForm(new RegistrationForm($this->container));
        $form->handleRequest($request);
        if ($request->isXmlHttpRequest()) {
            if ($form->isValid()) {
                $registration = $form->getData();
                $this->createParticipant($registration);
                return new Response(json_encode(array('error' => false)));
             } else {
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
        } elseif ($request->getMethod() == 'POST') {
            if ($form->isValid()) {
                $registration = $form->getData();
                $this->createParticipant($registration);
                
                return $this->redirect( $this->generateUrl("_signup_about"));
            }
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
     * @Route("/doLogin", name="_do_login")
     * @Template()
     */
    public function doLoginAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        if ($request->isXmlHttpRequest()) {
            if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
                return new Response(json_encode(array('error' => true)));
            }
            return new Response(json_encode(array('error' => false, 'url' => $this->generateUrl("_main"))));
        }
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            return $this->redirect($this->generateUrl("_authentification", array('error' => true)));
        }
        return $this->redirect($this->generateUrl("_main"));
    }
    
    /**
     * @Route("/signupabout/{studyCode}", name="_signup_about", defaults={"studyCode"= null})
     * @Template()
     */
    public function signupAboutAction(Request $request, $studyCode=null) {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $participant = $this->get('security.context')->getToken()->getUser();
        if (empty($participant)) {
            return $this->render("::error.html.twig", array(
                    "error"=>"Wrong participant id"));
        }
        
        $form = $this->createForm(new SignUpAboutForm($this->container));
        $form->handleRequest($request);

            if ($form->isValid()) {
                $data = $form->getData();
                $participant->setCountry($data['countrySelect']);
                $participant->setRace($data['raceSelect']);
                $participant->setSex($data['sexSelect']);
                $em->persist($participant);
                $em->flush();
                if ($request->isXmlHttpRequest()) {
                    return new Response(json_encode(array('error' => false)));
                } elseif ($request->getMethod() == 'POST') { 
                    $this->confirmParticipantEmail($participant);
                    return $this->redirect($this->generateUrl("_main"));
                }
            }
        
        return $this->render('CyclogramFrontendBundle:Authentification:signup_about.html.twig',
                array (
                        'formAbout' => $form->createView()
                       ));
    }
    
    /**
     * @Route("/consent/{studyCode}/{surveyId}", name="_consent")
     * @Template()
     */
    public function signupConsentAction($studyCode, $surveyId) {
            $participant = $this->get('security.context')->getToken()->getUser();
            $redirectUrl = $this->generateUrl("_main");
            if ($participant->getParticipantEmailConfirmed() == false)
                $this->confirmParticipantEmail($participant);
            return $this->redirect( $this->generateUrl("_eligibility_survey", array('studyCode' => $studyCode,'surveyId' => $surveyId, 'redirectUrl' => $redirectUrl)));
    }
    

    
    /**
     * @Route("/signup_email_verify/{email}/{code}/studyCode", name="email_verify")
     * @Template()
     */
    public function confirmEmailAction($email, $code, $studyCode = null)
    {
        $request = $this->getRequest();
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
    
        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->findOneBy(array('participantEmailCode' =>$code, 'participantEmail' => $email));
    
        if ($participant) {
            $participant->setParticipantEmailConfirmed(true);
            $em->persist($participant);
            $em->flush($participant);
    
            $session->set('confirmed', "Congratilations!!! Your e-mail is confirmed!");
            if (!empty($studyCode))
                return $this->redirect( $this->generateUrl("_main"));
            else
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
                    if($send)
                        return new Response(json_encode(array('error' => false, 'message' => $this->get('translator')->trans("forgot_username_email_send", array(), "login",$request->getLocale()))));
                    else 
                        return new Response(json_encode(array('error' => true, 'message' => $this->get('translator')->trans("forgot_username_send_error", array(), "login",$request->getLocale()))));
                }
                if($send)
                    return $this->render('CyclogramFrontendBundle:Authentification:username_sent.html.twig');
                else 
                    return $this->render('CyclogramFrontendBundle:Authentification:forgot_username.html.twig',
                            array(
                                    'formForgorUsername' => $form->createView(),
                                    'error' => $this->get('translator')->trans("forgot_username_send_error", array(), "login",$request->getLocale())
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
    
                    $cc->sendMail(null,
                            $participant->getParticipantEmail(),
                            $this->get('translator')->trans("email_reset_password", array(), "email", $parameters['locale']),
                            'CyclogramFrontendBundle:Email:reset_password_email.html.twig',
                            null,
                            $embedded,
                            true,
                            $parameters);
                    if ($request->isXmlHttpRequest())
                        return new Response(json_encode(array('error' => false)));
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
        $participant->setParticipantEmailCode($mailCode);
        $em->persist($participant);
        $em->flush($participant);
        $roles = array("ROLE_USER", "ROLE_PARTICIPANT");
        
        $token = new UsernamePasswordToken($participant, null, 'main', $roles);
        $this->get('security.context')->setToken($token);
    }
    
    /**
     * Send email to confirm participant has indicated a real email address
     * @param Participant $participant
     */
    private function confirmParticipantEmail(Participant $participant, $studyCode = null)
    {
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
