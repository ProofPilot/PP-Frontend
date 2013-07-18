<?php

namespace Cyclogram\FrontendBundle\Controller;

use Symfony\Component\HttpKernel\EventListener\ResponseListener;

use Symfony\Component\Config\Definition\Exception\DuplicateKeyException;

use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\HttpFoundation\Request;
use Cyclogram\CyclogramCommon;
use Symfony\Component\HttpFoundation\Response;
use Cyclogram\FrontendBundle\Form\MobilePhoneForm;
use Cyclogram\FrontendBundle\Form\RegistrationForm;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;

/**
 * @Route("/{_locale}")
 */
class  SimpleRegistrationController extends Controller{
    
    /**
     * @Route("/simpleregister", name="simple_registration")
     * @Template()
     */
    public function simpleRegStep1Action()
    {
        if ($this->get('security.context')->isGranted("ROLE_USER")){
            return $this->redirect($this->generateURL("_main"));
        }
        $request = $this->getRequest();
    
        $collectionConstraint = new Collection(array(
                'fields' => array(
                        'password' => new Length(array('min' => 8))
                )
        ));
    
        $form = $this->createForm(new RegistrationForm($this->container, array('constraints' => $collectionConstraint)));
    
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            if ($form->isValid()) {
                $registration = $form->getData();
                try{
                    $user = new Participant();
                    $user->setParticipantEmail($registration->getParticipantEmail());
                    $user->setParticipantPassword($registration->getParticipantPassword());
                    $user->setParticipantUsername($registration->getParticipantUsername());
                    $question = $em->getRepository('CyclogramProofPilotBundle:RecoveryQuestion')->find(1);
                    $user->setRecoveryQuestion($question);
                    $user->setRecoveryPasswordCode('Default');
                    $user->setParticipantEmailConfirmed(false);
                    $user->setParticipantMobileNumber('');
                    $user->setParticipantMobileSmsCodeConfirmed(false);
                    $user->setParticipantIncentiveBalance(false);
                    $date = new \DateTime();
                    $user->setParticipantLastTouchDatetime($date);
                    $user->setParticipantZipcode('');
                    $country = $em->getRepository('CyclogramProofPilotBundle:Country')->find(1);
                    $user->setCountry($country);
                    $state =  $em->getRepository('CyclogramProofPilotBundle:State')->find(35);
                    $user->setState($state);
                    $city = $em->getRepository('CyclogramProofPilotBundle:City')->find(25420);
                    $user->setCity($city);
                    $sex = $em->getRepository('CyclogramProofPilotBundle:Sex')->find(1);
                    $user->setSex($sex);
                    $race = $em->getRepository('CyclogramProofPilotBundle:Race')->find(1);
                    $user->setRace($race);
                    $role = $em->getRepository('CyclogramProofPilotBundle:ParticipantRole')->find(1);
                    $user->setParticipantRole($role);
                    $status = $em->getRepository('CyclogramProofPilotBundle:Status')->find(1);
                    $user->setStatus($status);
    
                    $em->persist($user);
                    $em->flush();
    
                    return $this->redirect( $this->generateUrl("simplereg_step_2", array('id' => $user->getParticipantId())) );
    
                } catch (Exception $ex) {
                    $em->close();
                    throw new  Exception('HAHAHA');
                }
            }
    
        }
        return $this->render('CyclogramFrontendBundle:SimpleRegistration:register.html.twig', array ('form' => $form->createView()));
    
    }
    
    /**
     * @Route("/simplereg_step2/{id}", name="simplereg_step_2")
     * @Template()
     */
    public function simpleRegStep2Action($id)
    {
        $em = $this->getDoctrine()->getManager();
        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->find($id);
        if (empty($participant)) {
            return $this->redirect( $this->generateUrl("simple_registration"));
        }
        $request = $this->getRequest();
    
        $form = $this->createForm(new MobilePhoneForm($this->container));
        if ($participant->getParticipantMobileNumber()){
            $phone = CyclogramCommon::parsePhoneNumber($participant->getParticipantMobileNumber());
        }
        if(!empty($phone)) {
            $form->get('phone_small')->setData($phone['country_code']);
            $form->get('phone_wide')->setData($phone['phone']);
        }
    
        if( $request->getMethod() == "POST" ){
    
            $form->handleRequest($request);
    
            if( $form->isValid() ) {
    
                $values = $form->getData();
                $userPhone = $values['phone_small'].$values['phone_wide'];
                $participant->setParticipantMobileNumber($userPhone);
                $em->persist($participant);
                $em->flush();
    
                //                 return $this->redirect( $this->generateUrl("reg_step_3") );
                return $this->render('CyclogramFrontendBundle:SimpleRegistration:mobile_phone_verification.html.twig', array('phone' => $participant->getParticipantMobileNumber(), 'id' => $participant->getParticipantId()));
            }
        }
        return $this->render('CyclogramFrontendBundle:SimpleRegistration:mobile_phone.html.twig', array("form" => $form->createView(), 'id' => $id));
    }

    /**
     * @Route("/simplereg_step3/{id}", name="simplereg_step_3")
     * @Template()
     */
    public function simpleRegStep3Action($id)
    {
        $em = $this->getDoctrine()->getManager();
        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->find($id);
        if (empty($participant)) {
            return $this->redirect( $this->generateUrl("simple_registration"));
        }
    
        if ($participant->getParticipantMobileSmsCodeConfirmed() == true) {
            return $this->redirect( $this->generateUrl("_login"));
        }
    
        $customerMobileNumber = $participant->getParticipantMobileNumber();
        $request = $this->getRequest();
    
        if( $customerMobileNumber ){
    
            $participantSMSCode = CyclogramCommon::getAutoGeneratedCode(4);
            $participant->setParticipantMobileSmsCode($participantSMSCode);
            //             $userLocale = $participant->getParticipantlanguage();
            //             if ($userLocale == 'en'){
            //                 $request->setLocale($locale);
            //             }
            $em->persist($participant);
            $em->flush($participant);
    
            $sms = $this->get('sms');
            $sentSms = $sms->sendSmsAction( array('message' => "Your SMS Verification code is $participantSMSCode", 'phoneNumber'=>"$customerMobileNumber") );
            if($sentSms)
                $participant->setParticipantMobileSmsCodeConfirmed(true);
            $em->persist($participant);
            $em->flush($participant);
            return $this->redirect(($this->generateUrl("simplereg_step_4", array('id'=> $participant->getParticipantId()))));
        }
    
        return $this->render('CyclogramFrontendBundle:SimpleRegistration:mobile_phone_verification.html.twig', array('phone' => $customerMobileNumber ));
    }
    
    /**
     * @Route("/simplereg_step4/{id}", name="simplereg_step_4")
     * @Template()
     */
    public function simpleRegStep5Action($id)
    {
        $em = $this->getDoctrine()->getManager();
        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->find($id);
        if (empty($participant)) {
            return $this->redirect( $this->generateUrl("simple_registration"));
        }
    
        $userSMS = $participant->getParticipantMobileSmsCode();
        $request = $this->getRequest();
    
        $collectionConstraint = new Collection(array(
                'fields' => array(
                        'sms_code' => new Length(array('min' => 4)),
                )
        ));
        $error = "";
        $form = $this->createFormBuilder(null, array('constraints' => $collectionConstraint))
        ->add('sms_code', 'text')
        ->getForm();
    
        if( $request->getMethod() == "POST" ){
    
            $form->handleRequest($request);
    
            if( $form->isValid() ) {
                $value = $request->request->get('form');;
                if ($value['sms_code'] == $userSMS) {
                    $embedded['logo_top'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newsletter_logo.png");
                    $embedded['logo_footer'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newletter_logo_footer.png");
                    $embedded['login_button'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newsletter_small_login.jpg");
                    $cc = $this->get('cyclogram.common');
                    $parameters['code'] = substr(md5( md5( $participant->getParticipantEmail() . md5(microtime()))), 0, 4);
                    $parameters['email'] = $participant->getParticipantEmail();
                    $parameters['confirmed'] = 1;
                    
                    $em = $this->getDoctrine()->getManager();
                    
                    $participant->setParticipantEmailCode($parameters['code']);
                    $em->persist($participant);
                    $em->flush($participant);
                    
                    $cc->sendMail($participant->getParticipantEmail(),
                            'Please Verify your e-mail address',
                            'CyclogramFrontendBundle:SimpleRegistration:confirm_email.html.twig',
                            null,
                            $embedded,
                            true,
                            $parameters);
                    
                    $token = new UsernamePasswordToken($participant, null, 'main', array('ROLE_USER'));
                    $this->get('security.context')->setToken($token);
                    
                    return $this->redirect( $this->generateUrl("_main") );
                } else {
                    $error = "Wrong SMS!";
                }
            }
        }
        return $this->render('CyclogramFrontendBundle:SimpleRegistration:mobile_phone_sms.html.twig', array('error' => $error, 'form' => $form->createView(), 'id' => $participant->getParticipantId()));
    }
    
    /**
     * @Route("/simpleemail_verify/{email}/{code}/{confirmed}", name="simpleemail_verify")
     * @Template()
     */
    public function confirmSimpleEmailAction($email, $code, $confirmed)
    {
        $request = $this->getRequest();
        $session = $this->getRequest()->getSession();
        if ($confirmed)
            $session->set('confirmed', "Congratilations!!! Your e-mail is confirmed!");
        $em = $this->getDoctrine()->getManager();
        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->findOneBy(array('participantEmailCode' =>$code, 'participantEmail' => $email));
        if ($participant) {
            $participant->setParticipantEmailConfirmed(true);
            $em->persist($participant);
            $em->flush($participant);
    
            return $this->redirect( $this->generateUrl("_main") );
        }
         
    }
}