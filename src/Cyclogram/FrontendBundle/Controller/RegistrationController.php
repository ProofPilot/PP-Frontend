<?php

namespace Cyclogram\FrontendBundle\Controller;

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
class RegistrationController extends Controller
{

    /**
     * @Route("/register", name="_registration")
     * @Template()
     */
    public function registerAction()
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
                    
                    $token = new UsernamePasswordToken($user, null, 'main', array('ROLE_USER'));
                    $this->get('security.context')->setToken($token);
                    
                    return $this->redirect( $this->generateUrl("reg_step_2") );
                
                } catch (Exception $ex) {
                    $em->close();
                   throw new  Exception('HAHAHA');
                }
            }

           }
        return $this->render('CyclogramFrontendBundle:Registration:register.html.twig', array ('form' => $form->createView()));
        
        }

    
    /**
     * @Route("/reg_step2", name="reg_step_2")
     * @Template()
     */
    public function phoneAction()
    {
        $em = $this->getDoctrine()->getManager();
        $participant = $this->get('security.context')->getToken()->getUser();
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
                $userSms = $values['phone_small'].$values['phone_wide'];
                $participant->setParticipantMobileNumber($userSms);
                $em->persist($participant);
                $em->flush();
                
//                 return $this->redirect( $this->generateUrl("reg_step_3") );
                return $this->render('CyclogramFrontendBundle:Registration:mobile_phone_2.html.twig', array('phone' => $participant->getParticipantMobileNumber()));
            }
        }
        return $this->render('CyclogramFrontendBundle:Registration:mobile_phone_1.html.twig', array("form" => $form->createView()));
    }
    
    /**
     * @Route("/reg_step3", name="reg_step_3")
     * @Template()
     */
    public function checkPhoneAction()
    {
        $em = $this->getDoctrine()->getManager();
        $participant = $this->get('security.context')->getToken()->getUser();
        $customerMobileNumber = $participant->getParticipantMobileNumber();
        
        if( $customerMobileNumber ){
        
            $participantSMSCode = CyclogramCommon::getAutoGeneratedCode(4);
            $participant->setParticipantMobileSmsCode($participantSMSCode);
        
            $em->persist($participant);
            $em->flush($participant);
        
            $sms = $this->get('sms');
            $sentSms = $sms->sendSmsAction( array('message' => "Your SMS Verification code is $participantSMSCode", 'phoneNumber'=>"$customerMobileNumber") );
            if($sentSms)
                $participant->setParticipantMobileSmsCodeConfirmed(true);
                return $this->redirect(($this->generateUrl("reg_step_4")));
        }
        
        return $this->render('CyclogramFrontendBundle:Registration:mobile_phone_2.html.twig', array('phone' => $customerMobileNumber ));
    }
    
    /**
     * @Route("/reg_step4/", name="reg_step_4")
     * @Template()
     */
    public function enterSMSAction()
    {
        $participant = $this->get('security.context')->getToken()->getUser();
        $mobileNumber = $participant->getParticipantMobileSmsCode();
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
                if ($value['sms_code'] == $mobileNumber) {
                    
                    $embedded['logo_top'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newsletter_logo.png");
                    $embedded['logo_footer'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newletter_logo_footer.png");
                    $cc = $this->get('cyclogram.common');
                    $parameters['code'] = substr(md5( md5( $participant->getParticipantEmail() . md5(microtime()))), 0, 4);
                    $parameters['email'] = $participant->getParticipantEmail();
                    
                    $em = $this->getDoctrine()->getManager();
                    
                    $participant->setParticipantEmailCode($parameters['code']);
                    $em->persist($participant);
                    $em->flush($participant);
                    
                    $cc->sendMail($participant->getParticipantEmail(),
                            'Please Verify your e-mail address',
                            'CyclogramFrontendBundle:Registration:confirm_email.html.twig',
                            null,
                            $embedded,
                            true,
                            $parameters);

                     return $this->redirect( $this->generateUrl("_main") );
                } else {
                    $error = "Wrong SMS!";
                }
            }
        }
        return $this->render('CyclogramFrontendBundle:Registration:mobile_phone_3.html.twig', array('error' => $error, 'form' => $form->createView()));
    }
    
    /**
     * @Route("/email_verify/{email}/{code}", name="email_verify")
     * @Template()
     */
    public function confirmEmailAction($email, $code)
    {
        $em = $this->getDoctrine()->getManager();
        $code = substr($code, 0, 4);
        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->findOneBy(array('participantEmailCode' =>$code, 'participantEmail' => $email));
        if ($participant) {
            $participant->setParticipantEmailConfirmed(true);
            $em->persist($participant);
            $em->flush($participant);
        }
        return $this->redirect( $this->generateUrl("_main") );
    }
    
    /**
     * @Route("/register_popup/")
     * @Template()
     */
    public function registerPopupAction()
    {
        return $this->render('CyclogramFrontendBundle:Registration:register_with_popup.html.twig');
    }

    /**
     * @Route("/username_sent/")
     * @Template()
     */
    public function userNameSentAction()
    {
        return $this->render('CyclogramFrontendBundle:Registration:username_sent.html.twig');
    }
}
