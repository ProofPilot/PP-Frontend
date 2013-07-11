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
                    $user->setParticipantEmailConfirmed(true);
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
        
        
        $collectionConstraint = new Collection(array(
                'fields' => array(
                        'phone_small' => new Length(array('min' => 1, 'max' => 3, 'minMessage'=>"Country code must be at least 1 digit", "maxMessage"=>"Country code must be max 3 digits")),
                        'phone_wide' =>  new Length(array('min' => 9, 'max' => 10, 'minMessage'=>"Phone number must be at least 9 digits", "maxMessage"=>"Phone number must be max 10 digits"))
                )
        ));
        
        $builder = $this->createFormBuilder(null, array('constraints' => $collectionConstraint))
        ->add('phone_small', 'text', array('attr'=>array('maxlength'=>3), 'data'=>1))
        ->add('phone_wide' , 'text', array('attr'=>array('maxlength'=>10)));
        
        if($request->query->has("country_code"))
            $builder->get('phone_small')->setData($request->query->get("country_code"));
        
        if($request->query->has("phone"))
            $builder->get('phone_wide')->setData($request->query->get("phone"));
        
        
        $form = $builder->getForm();
        
        if( $request->getMethod() == "POST" ){
        
            $form->handleRequest($request);
        
            if( $form->isValid() ) {
        
                $values = $request->request->get('form');
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
        
        return $this->render('CyclogramFrontendBundle:Registration:mobile_phone_2.html.twig', array('phone' => $phoneNumber));
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
                     return $this->redirect( $this->generateUrl("_main") );
                } else {
                    $error = "Wrong SMS!";
                }
            }
        }
        return $this->render('CyclogramFrontendBundle:Registration:mobile_phone_3.html.twig', array('error' => $error, 'form' => $form->createView()));
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
