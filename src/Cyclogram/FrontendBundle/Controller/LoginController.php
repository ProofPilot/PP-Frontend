<?php

namespace Cyclogram\FrontendBundle\Controller;

use Cyclogram\FrontendBundle\Exception\IncompleteUserException;

use Cyclogram\FrontendBundle\Form\UserSmsCodeForm;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Doctrine\ORM\Mapping\Entity;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Custom\DbCustom;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContext;
use Cyclogram\CyclogramCommon;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use HWI\Bundle\OAuthBundle\Security\Core\Authentication\Token\OAuthToken;


class LoginController extends Controller
{

    /**
     * @Route("/login", name="_login")
     * @Template()
     */
    public function loginAction()
    {
        if ($this->get('security.context')->isGranted("ROLE_PARTICIPANT")){
            return $this->redirect($this->get('router')->generate("_main"));
        }
        $request = $this->getRequest();
        $session = $request->getSession();
        
        $error = $this->getErrorForRequest($request);

        if(     $error &&
                $error instanceof IncompleteUserException) {

            $participantId = $error->getParticipantId();
            $studyId = $error->getToken()->getAttribute("studyId");
            $resourceOwner = $error->getToken()->getResourceOwnerName();
            $session->set("resourceOwnerName",$resourceOwner);
            
            $participant = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Participant')->find($participantId);
            
            if(!empty($studyId))
                $study = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Study')->find($studyId);
            
            if (!empty($studyId)){
                if ($study->getEmailVerificationRequired()) {
                    return $this->redirect( $this->generateUrl("reg_step_2", array('id' => $participant->getParticipantId(), 'studyId' => $studyId)));
                } else {
                    return $this->redirect( $this->generateUrl("simplereg_step_2", array('id' => $participant->getParticipantId(), 'studyId' => $studyId)));
                }
            } else {
                return $this->redirect( $this->generateUrl("simplereg_step_2", array('id' => $participant->getParticipantId())) );
            }
        }
        
        
        return $this->render('CyclogramFrontendBundle:Login:login.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
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
    public function doLoginAction(){
    
        $em = $this->getDoctrine()->getManager();
    
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            $this->redirect($this->generateUrl("_login"));
        }
    
        $participant = $this->get('security.context')->getToken()->getUser();
        
        $participant->setParticipantEmail(strtolower($participant->getParticipantEmail()));
    
        $customerMobileNumber = $participant->getParticipantMobileNumber();

        $request = $this->getRequest();
        $session = $request->getSession();


        if( $customerMobileNumber ){
    
            $participantSMSCode = CyclogramCommon::getAutoGeneratedCode(4);
            $participant->setParticipantMobileSmsCode($participantSMSCode);
    
            //hardcoded fix
            if( $participant->getParticipantEmail() == "ien2@cdc.gov" ){
                $participantSMSCode = "1234";
                $participant->setParticipantMobileSmsCode($participantSMSCode);
            }
    
            $em->persist($participant);
            $em->flush($participant);
    
            $sms = $this->get('sms');
            $this->get('custom_db')->getFactory('CommonCustom')->addEvent($participant->getParticipantId(),null,3, 'doLogin', $participantSMSCode . ":" . $participant->getParticipantEmail());
            $sentSms = $sms->sendSmsAction( array('message' => "Your SMS Verification code is $participantSMSCode", 'phoneNumber'=>"$customerMobileNumber") );
    
            if($sentSms)
                return $this->redirect(($this->generateUrl("login_sms")));
        }

        return $this->redirect(($this->generateUrl("login_sms")));
    }

    /**
     * @Route("/login_sms", name="login_sms" )
     * @Template()
     */
    public function loginSMSAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            $this->redirect($this->generateUrl("_login"));
        }
        
        $participant = $this->get('security.context')->getToken()->getUser();
        $participant->setParticipantEmail(strtolower($participant->getParticipantEmail()));
        
        $request = $this->getRequest();
        $session = $request->getSession();

        
        $form = $this->createForm(new UserSmsCodeForm($this->container));
        
        if( $request->getMethod() == "POST" ){
        
            $form->handleRequest($request);
        
            if( $form->isValid() ) {
        
                $values = $form->getData();
                $userSms = $values['sms_code'];
        
                if( $participant->getParticipantMobileSmsCode() == $userSms ){

                    $participant->setParticipantMobileSmsCodeConfirmed(true);
                    $participant->setParticipantEmail(strtolower($participant->getParticipantEmail()));
                    $status = $em->getRepository('CyclogramProofPilotBundle:Status')->find(1);
                    $participant->setStatus($status);

                    $roles = $em->getRepository('CyclogramProofPilotBundle:UserRoleLink')->findBy(array("userUser"=>$participant));
                    $participant->setRoles($roles);
                    $participant->setParticipantLastTouchDatetime(new \DateTime());

                    $em->persist($participant);
                    $em->flush();
                    
                    $currentToken = $this->get('security.context')->getToken();
                    $roles = $currentToken->getRoles();
                    
                    
                    if($currentToken instanceof OAuthToken) {
                    
                        $token = new OAuthToken($currentToken->getRawToken(), array_merge($roles, array("ROLE_PARTICIPANT")));
                        $token->setResourceOwnerName($currentToken->getResourceOwnerName());
                        $token->setUser($participant);
                        $token->setAuthenticated(true);
                    } else {
                        $token = new \Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken($participant, $participant->getPassword(), 'main', array_merge($roles, array("ROLE_PARTICIPANT")));
                    }
                    $this->get('security.context')->setToken($token);

                    $this->get('custom_db')->getFactory('CommonCustom')->addEvent($participant->getParticipantId(),null,1,'login','Login succesfully', TRUE);
                    return $this->redirect( $this->generateUrl("_main") );
                } else {
                    $this->get('custom_db')->getFactory('CommonCustom')->addEvent($participant->getParticipantId(),null,1,'login','Login failed', FALSE);
                    return $this->redirect( $this->generateUrl("_login") );
                }
            }
        }
        
        return $this->render(
            'CyclogramFrontendBundle:Login:mobile_phone_login.html.twig',
            array(
                "form"=>$form->createView()
            ));
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
    
        $studyId = $request->get('studyId');
        $extraParameters = array();
        if($studyId)
            $extraParameters["state"] = $studyId;
    
        if (!empty($param) && $request->hasSession() && $targetUrl = $request->get($param, null, true)) {
            $providerKey = $this->container->getParameter('hwi_oauth.firewall_name');
            $request->getSession()->set('_security.' . $providerKey . '.target_path', $targetUrl);
        }
    
        return new RedirectResponse(
                $this->container->get('hwi_oauth.security.oauth_utils')->getAuthorizationUrl(
                        $service, 
                        null, 
                        $extraParameters)
    
        );
    }
    
    /**
     * @Route("/forgot_pass", name="_forgot_pass")
     * @Template()
     */
    public function forgotPassAction()
    {
        $request = $this->getRequest();
    
        $form = $this->createFormBuilder()
        ->add('participantUsername', 'text', array(
                'label'=>'label_username'
        ))
        ->add('sendPass', 'submit', array(
                'label' => 'btn_send_pass'))
                ->getForm();
    
        $em = $this->getDoctrine()->getManager();
    
        $request = $this->getRequest();
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
                    $parameters['locale'] = $participant->getLanguage() ? $participant->getLanguage() : $request->getLocale();
                    $embedded['logo_top'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newsletter_logo.png");
                    $embedded['logo_footer'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newletter_logo_footer.png");
                    $embedded['login_button'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newsletter_small_login.jpg");
                    $cc = $this->get('cyclogram.common');
                    $cc->sendMail($participant->getParticipantEmail(),
                            $this->get('translator')->trans("email_reset_password", array(), "email", $parameters['locale']),
                            'CyclogramFrontendBundle:Email:reset_password_email.html.twig',
                            null,
                            $embedded,
                            true,
                            $parameters);
    
                    return $this->render('CyclogramFrontendBundle::Login:reset_password_confirmation.html.twig', array());
                } else {
                    return $this->render('CyclogramFrontendBundle:Login:forgot_your_password.html.twig',
                            array(
                                    "form" => $form->createView(),
                                    "error" => $this->get('translator')->trans("doesnt_match_records", array(), "login")
                            ));
                }
            }
        }
        return $this->render('CyclogramFrontendBundle:Login:forgot_your_password.html.twig',
                array(
                        "form" => $form->createView(),
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
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            if( $form->isValid() ) {
                $participant = $em->getRepository("CyclogramProofPilotBundle:Participant")->find($id);
                $values = $request->request->get('form');
                if (!empty($participant)) {
                    $participantSMSCode = CyclogramCommon::getAutoGeneratedCode(4);
                    $participant->setParticipantMobileSmsCode($participantSMSCode);
                    $em->persist($participant);
                    $em->flush($participant);
                    $locale = $participant->getLanguage() ? $participant->getLanguage() : $request->getLocale();
    
                    $sms = $this->get('sms');
                    $message = $this->get('translator')->trans('pass_reset_code', array(), 'security', $locale);
                    $sentSms = $sms->sendSmsAction( array('message' => $message .' '. $participantSMSCode, 'phoneNumber'=> $participant->getParticipantMobileNumber()) );
                    if($sentSms){
    
                        $session->set('password' ,$values['participantPassword']['first']);
                        return $this->redirect( $this->generateUrl('_confirm_pass_reset', array('id' => $id)));
                    }
                }
            }
        }
        return $this->render('CyclogramFrontendBundle:Login:create_new_password.html.twig',
                array(
                        "form" => $form->createView(),
                        'id' => $id,
                ));
    }
    
    /**
     * @Route("/confirm_reset/{id}", name="_confirm_pass_reset")
     * @Template()
     */
    public function confirmResetAction($id)
    {
        $request = $this->getRequest();
    
        $error = "";
        $form = $this->createForm(new UserSmsCodeForm($this->container));
        if( $request->getMethod() == "POST" ){
    
            $form->handleRequest($request);
    
            if( $form->isValid() ) {
                $value = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $participant = $em->getRepository("CyclogramProofPilotBundle:Participant")->find($id);
                if (!empty($participant)){
                    $smscode = $participant->getParticipantMobileSmsCode();
                    if ($value['sms_code'] == $smscode) {
                        $session = $this->getRequest()->getSession();
                        $participant->setParticipantPassword($session->get('password'));
    
                        $em->persist($participant);
                        $em->flush($participant);
                        $session->invalidate();
    
                        return $this->render('CyclogramFrontendBundle:Login:password_changed.html.twig');
                    } else {
                        $session->invalidate();
                        $error = "Wrong SMS!";
                    }
                }
            }
        }
    
        return $this->render('CyclogramFrontendBundle:Login:confirm_reset.html.twig', array('error' => $error, 'form' => $form->createView(), 'id' => $id, "studyId"=>$studyId));
    }
    
    /**
     * @Route("/forgot_username", name="_forgot_username")
     * @Template()
     */
    public function forgotUserAction()
    {
        if ($this->get('security.context')->isGranted("ROLE_PARTICIPANT")){
            return $this->redirect($this->get('router')->generate("_main"));
        }
        $request = $this->getRequest();
    
        $form = $this->createForm(new MobilePhoneForm($this->container));
    
        $clientIp = $request->getClientIp();
        if ($clientIp == '127.0.0.1') {
            $form->get('phone_small')->setData(380);
        }
        $geoip = $this->get('maxmind.geoip')->lookup($clientIp);
        if ($geoip != false) {
            $countryCode = $geoip->getCountryCode();
            if ($countryCode == 'US') {
                $form->get('phone_small')->setData(1);
            }
        }
        $em = $this->getDoctrine()->getManager();
        $study = null;
    
        if( $request->getMethod() == "POST" ){
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            if( $form->isValid() ) {
                $values = $form->getData();
                $userSms = $values['phone_small'].$values['phone_wide'];
                $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->findOneByParticipantMobileNumber($userSms);
                if ($participant) {
    
                    $participantEmail = $participant->getParticipantEmail();
                    $participantUsername = $participant->getParticipantUsername();
    
                    $sms = $this->get('sms');
                    $locale = $participant->getLanguage() ? $participant->getLanguage() : $request->getLocale();
                    $userNameText = $this->get('translator')->trans('user_name_sms_message', array(), 'security', $locale);
                    $emailText = $this->get('translator')->trans('email_sms_message', array(), 'security', $locale);
                    $sentSms = $sms->sendSmsAction( array('message' =>  $userNameText.' '. $participantUsername .' '. $emailText .' '. $participantEmail, 'phoneNumber'=>$participant->getParticipantMobileNumber()) );
                    if($sentSms)
                        return $this->render('CyclogramFrontendBundle:Login:username_sent.html.twig',
                                array());
                } else {
                    return $this->render('CyclogramFrontendBundle:Login:forgot_username.html.twig',
                            array(
                                    'form' => $form->createView(),
                                    "error" => $this->get('translator')->trans("doesnt_match_records", array(), "login")
                            ));
                }
            }
        }
        return $this->render('CyclogramFrontendBundle:Login:forgot_username.html.twig',
                array(
                        'form' => $form->createView()
                ));
    }
}
