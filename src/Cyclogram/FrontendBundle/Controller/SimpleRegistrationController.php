<?php

namespace Cyclogram\FrontendBundle\Controller;

use Cyclogram\FrontendBundle\Form\UserSmsCodeForm;

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


class  SimpleRegistrationController extends Controller{
    
    /**
     * @Route("/simplereg_step2/{id}/{studyId}", name="simplereg_step_2", defaults={"studyId"=null})
     * @Template()
     */
    public function simpleRegStep2Action($id, $studyId)
    {
        $em = $this->getDoctrine()->getManager();
        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->find($id);
        if (empty($participant)) {
            return $this->redirect( $this->generateUrl("_registration"));
        }
        $request = $this->getRequest();
        $session = $request->getSession();

        if ($studyId == null) {
            $studyId = $session->get('studyId');
        } else {
            $session->set('studyId', $studyId);
        }
    
        $form = $this->createForm(new MobilePhoneForm($this->container), null, array(
                'validation_groups' => array('registration')
                ));
        if ($participant->getParticipantMobileNumber()){
            $phone = CyclogramCommon::parsePhoneNumber($participant->getParticipantMobileNumber());
        }
        if(!empty($phone)) {
            $form->get('phone_small')->setData($phone['country_code']);
            $form->get('phone_wide')->setData($phone['phone']);
        }
        $clientIp = $request->getClientIp();
        if ($clientIp == '127.0.0.1') {
            $form->get('phone_small')->setData(380);
        }
        $geoip = $this->get('maxmind.geoip')->lookup($clientIp);
        if ($geoip != false) {
            $countryCode = $geoip->getCountryCode();
            if ($countryCode == 'US' && empty($phone)) {
                $form->get('phone_small')->setData(1);
            }
        }
        $study = null;
        $studyLogo = "";
        if ($studyId != null) {
            $study = $em->getRepository('CyclogramProofPilotBundle:Study')->find($studyId);
            $studyContent = $em->getRepository('CyclogramProofPilotBundle:StudyContent')->findOneBy(array('studyId'=>$studyId));
            $studyLogo = $studyContent->getStudyLogo();
            $studyLogo = "http://admin.dev1.proofpilot.net/2cd1c6ecec2c6d908b3ed66d4ea7b902/".$studyId."/".$studyLogo;
        } else {
            $study = null;
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
                return $this->render('CyclogramFrontendBundle:SimpleRegistration:mobile_phone_verification.html.twig', array('phone' => $participant->getParticipantMobileNumber(), 'id' => $participant->getParticipantId(), 'studyId' => $studyId, 'studyLogo'=>$studyLogo));
            }
        }
        return $this->render('CyclogramFrontendBundle:SimpleRegistration:mobile_phone.html.twig', array("form" => $form->createView(), 'id' => $id, 'studyId' => $studyId, 'studyLogo'=>$studyLogo));
    }

    /**
     * @Route("/simplereg_step3/{id}/{studyId}", name="simplereg_step_3", defaults={"studyId"=null})
     * @Template()
     */
    public function simpleRegStep3Action($id, $studyId)
    {
        $em = $this->getDoctrine()->getManager();
        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->find($id);
        if (empty($participant)) {
            return $this->redirect( $this->generateUrl("_registration"));
        }
    
        if ($participant->getParticipantMobileSmsCodeConfirmed() == true) {
            return $this->redirect( $this->generateUrl("_login"));
        }
    
        $customerMobileNumber = $participant->getParticipantMobileNumber();
        $request = $this->getRequest();
        $session = $request->getSession();

        if ($studyId == null) {
            $studyId = $session->get('studyId');
        } else {
            $session->set('studyId', $studyId);
        }

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
                return $this->redirect(($this->generateUrl("simplereg_step_4", array('id'=> $participant->getParticipantId(), 'studyId' => $studyId))));
        }
    
        return $this->render('CyclogramFrontendBundle:SimpleRegistration:mobile_phone_verification.html.twig', array('phone' => $customerMobileNumber, 'studyId' => $studyId ));
    }
    
    /**
     * @Route("/simplereg_step4/{id}/{studyId}", name="simplereg_step_4", defaults={"studyId"=null})
     * @Template()
     */
    public function simpleRegStep5Action($id, $studyId)
    {
        $em = $this->getDoctrine()->getManager();
        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->find($id);
        if (empty($participant)) {
            return $this->redirect( $this->generateUrl("_registration"));
        }
    
        $userSMS = $participant->getParticipantMobileSmsCode();
        $request = $this->getRequest();
        $session = $request->getSession();

        if ($studyId == null) {
            $studyId = $session->get('studyId');
        } else {
            $session->set('studyId', $studyId);
        }
    

        $error = "";
        $form = $this->createForm(new UserSmsCodeForm($this->container));

        $study = null;
        $studyLogo = "";
        if ($studyId != null) {
            $study = $em->getRepository('CyclogramProofPilotBundle:Study')->find($studyId);
            $studyContent = $em->getRepository('CyclogramProofPilotBundle:StudyContent')->findOneBy(array('studyId'=>$studyId));
            $studyLogo = $studyContent->getStudyLogo();
            $studyLogo = "http://admin.dev1.proofpilot.net/2cd1c6ecec2c6d908b3ed66d4ea7b902/".$studyId."/".$studyLogo;
        } else {
            $study = null;
        }

        if( $request->getMethod() == "POST" ){
    
            $form->handleRequest($request);
    
            if( $form->isValid() ) {
                $value = $form->getData();
                if ($value['sms_code'] == $userSMS) {
                    $embedded['logo_top'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newsletter_logo.png");
                    $embedded['logo_footer'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newletter_logo_footer.png");
                    $embedded['login_button'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newsletter_small_login.jpg");
                    $cc = $this->get('cyclogram.common');
                    $parameters['code'] = substr(md5( md5( $participant->getParticipantEmail() . md5(microtime()))), 0, 4);
                    $parameters['email'] = $participant->getParticipantEmail();
                    $parameters['confirmed'] = 1;
                    $parameters['studyId'] = $studyId;
                    $parameters['simple'] = true;
                    
                    $em = $this->getDoctrine()->getManager();
                    
                    $participant->setParticipantEmailCode($parameters['code']);
                    $participant->setParticipantMobileSmsCodeConfirmed(true);
                    $em->persist($participant);
                    $em->flush($participant);
                    
                    $cc->sendMail($participant->getParticipantEmail(),
                            'Please Verify your e-mail address',
                             'CyclogramFrontendBundle:Email:email_confirmation.html.twig',
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
        return $this->render('CyclogramFrontendBundle:SimpleRegistration:mobile_phone_sms.html.twig', array('error' => $error, 'form' => $form->createView(), 'id' => $participant->getParticipantId(), 'studyId' => $studyId, 'studyLogo'=>$studyLogo));
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