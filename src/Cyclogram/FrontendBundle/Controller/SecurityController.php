<?php

namespace Cyclogram\FrontendBundle\Controller;

use Cyclogram\FrontendBundle\Form\UserSmsCodeForm;

use Symfony\Component\HttpFoundation\Session\Session;

use Cyclogram\CyclogramCommon;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Routing\Router;
use Cyclogram\FrontendBundle\Form\MobilePhoneForm;


class SecurityController extends Controller
{
    /**
     * @Route("/forgot_pass/{studyId}", name="_forgot_pass")
     * @Template()
     */
    public function forgotPassAction($studyId=null)
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
                    $parameters['studyId'] = $studyId;
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

                    return $this->render('CyclogramFrontendBundle:Security:reset_password_confirmation.html.twig', array());
                } else {
                    return $this->render('CyclogramFrontendBundle:Security:forgot_your_password.html.twig', 
                            array(
                                    "form" => $form->createView(), 
                                    "error" => $this->get('translator')->trans("doesnt_match_records", array(), "login")
                                     ));
                }
            }
        }
        return $this->render('CyclogramFrontendBundle:Security:forgot_your_password.html.twig', 
                array(
                        "form" => $form->createView(), 
                        ));
    }
    
    /**
     * @Route("/create_pass/{id}/{studyId}" , name="_create_new_pass")
     * @Template()
     */
    public function createPassAction($id, $studyId=null)
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
        return $this->render('CyclogramFrontendBundle:Security:create_new_password.html.twig', 
                array(
                        "form" => $form->createView(), 
                        'id' => $id, 
                        ));
    }
    
    /**
     * @Route("/confirm_reset/{id}/{studyId}", name="_confirm_pass_reset")
     * @Template()
     */
    public function confirmResetAction($id, $studyId =null)
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
                        
                        return $this->render('CyclogramFrontendBundle:Security:password_changed.html.twig', array("studyId"=>$studyId));
                    } else {
                        $session->invalidate();
                        $error = "Wrong SMS!";
                    }
                }
            }
        }
        
        return $this->render('CyclogramFrontendBundle:Security:confirm_reset.html.twig', array('error' => $error, 'form' => $form->createView(), 'id' => $id, "studyId"=>$studyId));
    }
    
    /**
     * @Route("/forgot_username/{studyId}", name="_forgot_username")
     * @Template()
     */
    public function forgotUserAction($studyId=null)
    {
        if ($this->get('security.context')->isGranted("ROLE_USER")){
            return $this->redirect($this->generateURL("_main"));
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
                        return $this->render('CyclogramFrontendBundle:Security:username_sent.html.twig', 
                                array());
                } else {
                    return $this->render('CyclogramFrontendBundle:Security:forgot_username.html.twig',
                            array(
                                    'form' => $form->createView(),
                                    "error" => $this->get('translator')->trans("doesnt_match_records", array(), "login")
                                    ));
                }
            }
        }
        return $this->render('CyclogramFrontendBundle:Security:forgot_username.html.twig',
                array(
                        'form' => $form->createView()
                        ));
    }
}
