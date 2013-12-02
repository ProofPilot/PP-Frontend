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

use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;

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
use Cyclogram\FrontendBundle\Form\MobilePhoneForm;


class LoginController extends Controller
{

    /**
     * @Route("/login", name="_login")
     * @Template()
     */
    public function loginAction(Request $request)
    {
        $session = $request->getSession();
        
        $error = $this->getErrorForRequest($request);
        
        if($error) {
            if ($request->isXmlHttpRequest()) 
                return new Response(json_encode(array('error' => true)));
            else
                return $this->render('CyclogramFrontendBundle:Authentification:signup.html.twig', array(
                        // last username entered by the user
                        'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                        'error'         => $error,
                ));
        } else {
            return $this->render('CyclogramFrontendBundle:Authentification:signup.html.twig', array(
                    // last username entered by the user
                    'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            ));
        }
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
                    $parameters['email'] = $participant->getParticipantEmail();
                    $parameters['locale'] = $participant->getLocale() ? $participant->getLocale() : $request->getLocale();
                    $parameters['host'] = $this->container->getParameter('site_url');
                    
                    $cc = $this->get('cyclogram.common');
                    
                    $embedded = array();
                    $embedded = $cc->getEmbeddedImages();
                    
                    $cc->sendMail($participant->getParticipantEmail(),
                            $this->get('translator')->trans("email_reset_password", array(), "email", $parameters['locale']),
                            'CyclogramFrontendBundle:Email:reset_password_email.html.twig',
                            null,
                            $embedded,
                            true,
                            $parameters);
    
                    return $this->render('CyclogramFrontendBundle:Login:reset_password_confirmation.html.twig');
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
                        "form" => $form->createView()
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
                    $locale = $participant->getLocale() ? $participant->getLocale() : $request->getLocale();
    
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
                        'id' => $id
                ));
    }
    
    /**
     * @Route("/confirm_reset}/{id}", name="_confirm_pass_reset")
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
                        $factory = $this->get('security.encoder_factory');
                        $encoder = $factory->getEncoder($participant);
                        
                        $participant->setParticipantPassword($encoder->encodePassword($session->get('password'), $participant->getSalt()));
    
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
    
        return $this->render('CyclogramFrontendBundle:Login:confirm_reset.html.twig', 
                array(
                        'error' => $error, 
                        'form' => $form->createView(), 
                        'id' => $id
                        ));
    }
    
 
    private function isTemporalSmsCode($code) {
    
    	$em = $this->getDoctrine()->getManager();
    	$temporaryCodes = $em->getRepository('CyclogramProofPilotBundle:TemporaryAccessCode')->findAll();
    
    	foreach ($temporaryCodes as $key => $value){
    		if($code == $value->getSmsCode()) {
    			return true;
    		}
    	}
    	 
    	return false;
    }
}
