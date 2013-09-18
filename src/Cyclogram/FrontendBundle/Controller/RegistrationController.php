<?php

/*
 * This is part of the ProofPilot package.
*
* (c)2012-2013 Cyclogram, Inc, West Hollywood, CA <crew@proofpilot.com>
* ALL RIGHTS RESERVED
*
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

use Symfony\Component\Security\Core\Exception\AuthenticationException;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantSurveyLink;

use Cyclogram\FrontendBundle\Form\UserSmsCodeForm;

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
use Cyclogram\FrontendBundle\Form\RegistrationForm;
use Cyclogram\FrontendBundle\Form\MailingAddressForm;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;


class RegistrationController extends Controller
{

    /**
     * @Route("/register/{studyCode}", name="_register", defaults={"studyCode"= null})
     * @Template()
     */
    public function registerStartAction($studyCode=null)
    {
        //TODO: move the check to action
        if ($this->get('security.context')->isGranted("ROLE_PARTICIPANT")){
            return $this->redirect($this->get('router')->generate("_main"));
        }
        $this->checkStudyEligibility($studyCode);
        
        $request = $this->getRequest();
        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new RegistrationForm($this->container));
        
        if(!empty($studyCode))
            $study = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $registration = $form->getData();
                try{
                    //if participant is unfinished record, try to get it
                    $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')
                            ->getUnfinishedParticipant($registration->getParticipantUsername(), $registration->getParticipantEmail());

                    if(!$participant){
                        $participant = new Participant();
                    }
                    
                    $participant->setParticipantEmail($registration->getParticipantEmail()); 
                    $participant->setParticipantPassword($registration->getParticipantPassword());
                    $participant->setParticipantUsername($registration->getParticipantUsername());
                    $question = $em->getRepository('CyclogramProofPilotBundle:RecoveryQuestion')->find(1);
                    $participant->setRecoveryQuestion($question);
                    $participant->setRecoveryPasswordCode('Default');
                    $participant->setParticipantEmailConfirmed(false);
                    $participant->setParticipantMobileNumber('');
                    $participant->setParticipantMobileSmsCodeConfirmed(false);
                    $participant->setParticipantIncentiveBalance(false);
                    $participant->setLocale($request->getLocale());
                    $date = new \DateTime();
                    $participant->setParticipantLastTouchDatetime($date);
                    $participant->setParticipantZipcode('');
                    $role = $em->getRepository('CyclogramProofPilotBundle:ParticipantRole')->find(1);
                    $participant->setParticipantRole($role);
                    $status = $em->getRepository('CyclogramProofPilotBundle:Status')->find(1);
                    $participant->setStatus($status);

                    $em->persist($participant);
                    $em->flush();
                    if (!empty($studyCode)){
                        return $this->redirect( $this->generateUrl("_register_mobile", array('id' => $participant->getParticipantId(), 'studyCode' => $studyCode)));
                    } else {
                        return $this->redirect( $this->generateUrl("_register_mobile", array('id' => $participant->getParticipantId())) );
                    }
                    
                } catch (Exception $ex) {
                    $em->close();
                }
            }

           }
          
           if ( !empty($study) && $study->getEmailVerificationRequired() == true) {
               $session->set('5step', true);
               $totalSteps = 5;
           } else {
               $totalSteps = 4;
           }
           
            return $this->render('CyclogramFrontendBundle:Registration:start.html.twig', 
                    array (
                            'form' => $form->createView(), 
                            'totalSteps' => $totalSteps));
        
        }

    /**
     * @Route("/register/mobile/{id}/{studyCode}/{aditionalNumber}", name="_register_mobile", defaults={"studyCode"=null, "aditionalNumber" = null})
     * @Template()
     */
    public function registerMobileAction($id, $studyCode=null, $aditionalNumber)
    {
        $em = $this->getDoctrine()->getManager();
    
        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->find($id);
        if (empty($participant)) {
            throw new \Exception("Wrong participant id");
        }
        $this->checkStudyEligibility($studyCode);
    
        $request = $this->getRequest();
        $session = $request->getSession();
    
        $form = $this->createForm(new MobilePhoneForm($this->container), null, array(
                'validation_groups' => array('registration')
        ));
        if (is_null($aditionalNumber)) {
            if ($participant->getParticipantMobileNumber()){
                $phone = CyclogramCommon::parsePhoneNumber($participant->getParticipantMobileNumber());
            }
        
            if(!empty($phone)) {
                $form->get('phone_small')->setData($phone['country_code']);
                $form->get('phone_wide')->setData($phone['phone']);
            }
        }
        $clientIp = $request->getClientIp();
        if ($clientIp == '127.0.0.1') {
            $form->get('phone_small')->setData(380);
        }
        $geoip = $this->get('maxmind.geoip')->lookup($clientIp);
        if ($geoip != false) {
            $countryCode = $geoip->getCountryCode();
            $country = $em->getRepository('CyclogramProofPilotBundle:Country')->findOneByCountryCode($countryCode);
            if (isset($country)){
                $form->get('phone_small')->setData($country->getDailingCode());
            }
        }
    
        if( $request->getMethod() == "POST" ){
    
            $form->handleRequest($request);
    
            if( $form->isValid() ) {
    
                $values = $form->getData();
                $userPhone = $values['phone_small'].$values['phone_wide'];
                if (is_null($aditionalNumber))
                    $participant->setParticipantMobileNumber($userPhone);
                else
                    $participant->setVoicePhone($userPhone);
                $em->persist($participant);
                $em->flush();
                if (!is_null($aditionalNumber)){
                    if($session->has("5step", false)) {
                        //on 5step we redirect
                        return $this->redirect($this->generateUrl("_register_mailaddress",
                                array(
                                        'id'=> $id,
                                        'studyCode' => $studyCode
                                )));
                    } else {
                        $resourceOwnerName = $session->get("resourceOwnerName");
                        $roles = array("ROLE_USER");
                        if($resourceOwnerName == "facebook") {
                            $roles = array_merge($roles, array("ROLE_FACEBOOK_USER", "ROLE_PARTICIPANT"));
                        } else if($resourceOwnerName == "google") {
                            $roles = array_merge($roles, array("ROLE_GOOGLE_USER", "ROLE_PARTICIPANT"));
                        } else {
                            $roles = array_merge($roles, array("ROLE_PARTICIPANT"));
                        }
                        $session->remove("resourceOwnerName");
                        
                        $token = new UsernamePasswordToken($participant, null, 'main', $roles);
                        $this->get('security.context')->setToken($token);
                        return $this->redirect( $this->generateUrl("_main") );
                    }
                } 
                if (!empty($values['aditional_phone']))
                    $session->set('aditional_phone', $values['aditional_phone']);
                return $this->render('CyclogramFrontendBundle:Registration:mobile_phone_verify.html.twig',
                        array(
                                'phone' => $participant->getParticipantMobileNumber(),
                                'id' => $participant->getParticipantId(),
                                'steps' => $session->get("5step", false) ? 5 : 4,
                                'current' => 3
                        ));
            }
        }
        return $this->render('CyclogramFrontendBundle:Registration:mobile_phone.html.twig',
                array(
                        "form" => $form->createView(),
                        'id' => $id,
                        'steps' => $session->get("5step", false) ? 5 : 4,
                        'current' => 2,
                        'aditional_phone' => $aditionalNumber ? $aditionalNumber : false
                ));
    }
    
    /**
     * @Route("/register/sms/{id}/{studyCode}", name="_register_sms", defaults={"studyCode"=null})
     * @Template()
     */
    public function registerSendSMSAction($id, $studyCode)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $this->checkStudyEligibility($studyCode);
        
        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->find($id);
    
        if (empty($participant)) {
            return $this->redirect( $this->generateUrl("_register"));
        }
    
        if ($participant->getParticipantMobileSmsCodeConfirmed() == true) {
            return $this->redirect( $this->generateUrl("_login"));
        }
    
        $customerMobileNumber = $participant->getParticipantMobileNumber();
    
    
    
        if( $customerMobileNumber ){
    
            $participantSMSCode = CyclogramCommon::getAutoGeneratedCode(4);
            $participant->setParticipantMobileSmsCode($participantSMSCode);
            $em->persist($participant);
            $em->flush($participant);
    
            $sms = $this->get('sms');
            $message = $this->get('translator')->trans('sms_verification_message', array(), 'register');
            $sentSms = $sms->sendSmsAction( array('message' => $message . ' ' . $participantSMSCode, 'phoneNumber'=>"$customerMobileNumber") );
            if($sentSms)
                return $this->redirect(($this->generateUrl("_register_verify_sms",
                        array(
                                'id'=> $participant->getParticipantId(),
                                'studyCode' => $studyCode
                        ))
                ));
        }
    
        return $this->render('CyclogramFrontendBundle:Registration:mobile_phone_verify.html.twig',
                array(
                        'phone' => $customerMobileNumber));
    }
    
    /**
     * @Route("/register/verify_sms/{id}/{studyCode}", name="_register_verify_sms", defaults={"studyCode"=null})
     * @Template()
     */
    public function registerVerifySMSAction($id, $studyCode)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();

        $this->checkStudyEligibility($studyCode);
        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->find($id);
    
        if (empty($participant)) {
            return $this->redirect( $this->generateUrl("_register"));
        }
    
        $userSMS = $participant->getParticipantMobileSmsCode();
    
    
        $error = "";
        $form = $this->createForm(new UserSmsCodeForm($this->container));

        if( $request->getMethod() == "POST" ){
    
            $form->handleRequest($request);
    
            if( $form->isValid() ) {
                $value = $form->getData();
                $errorCount = 0;
                if(!$session->has('errorCount')){
                    $session->set('errorCount', $errorCount);
                }
                if ($value['sms_code'] == $userSMS) {
                    
                    //Make Participant SMS code confirmed
                    $participant->setParticipantMobileSmsCodeConfirmed(true);
                    $em->persist($participant);
                    $em->flush($participant);
    
                    $steps5 = $session->get("5step", false);
                    if ($session->has('aditional_phone')) 
                        return $this->redirect($this->generateUrl("_register_mobile",
                                array(
                                        'id'=> $id,
                                        'studyCode' => $studyCode,
                                        'aditionalNumber' => $session->get('aditional_phone')
                                )));

                    if($steps5) {
                        //on 5step we redirect
                        return $this->redirect($this->generateUrl("_register_mailaddress",
                                array(
                                        'id'=> $id,
                                        'studyCode' => $studyCode
                                )));
                    }
    
                    $this->confirmParticipantEmail($participant, $studyCode);
    
                    return $this->registerAndRedirect($participant, $studyCode);
                } else {
                    $errorCount = $session->get('errorCount');
                    $errorCount++;
                    $session->set('errorCount',$errorCount);
                    if ($session->get('errorCount') >2) {
                        $session->remove('errorCount');
                        $this->checkStudyEligibility($studyCode, true);
                        $studyContent = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:StudyContent')->getStudyContentByCode($studyCode, $request->getLocale());
                        return $this->redirect($this->generateUrl('_page', array(
                                'studyUrl' => $studyContent->getStudyUrl(),
                                'eligible' => false
                        )));
                    }
                    $error = "Wrong SMS!";
                }
            }
        }
        return $this->render('CyclogramFrontendBundle:Registration:mobile_phone_sms.html.twig',
                array(
                        'error' => $error,
                        'form' => $form->createView(),
                        'id' => $participant->getParticipantId(),
                        'steps' => $session->get("5step", false) ? 5 : 4,
                        'current' => 4
                ));
    }
    
    
    /**
     * @Route("/register/mailaddress/{id}/{studyCode}", name="_register_mailaddress", defaults={"studyCode"=null})
     * @Template()
     */
    public function registerMailAddressAction($id, $studyCode)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $request->getSession();
        $this->checkStudyEligibility($studyCode);
        

        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->find($id);
        
        if (empty($participant)) {
            return $this->redirect( $this->generateUrl("_register"));
        }
        $collectionConstraint = new Collection(array(
                'participantFirstname'     =>  new NotBlank(),
                'participantLastname'        => new NotBlank(),
                'participantAddress1'      => new NotBlank(),
                'participantZipcode' => new NotBlank(),
                'city'     => new NotBlank(),
                'state'    => new NotBlank()
        ));
        $form = $this->createForm(new MailingAddressForm($this->container), array('constraints' => $collectionConstraint));
        
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            if ($form->isValid()) {
                $form = $form->getData();
                $participant->setParticipantFirstname($form['participantFirstname']);
                $participant->setParticipantLastname($form['participantLastname']);
                $participant->setParticipantAddress1($form['participantAddress1']);
                $participant->setParticipantAddress2($form['participantAddress2']);
                $participant->setParticipantZipcode($form['participantZipcode']);
                if (!empty($form['cityId'])) {
                    $city = $em->getRepository('CyclogramProofPilotBundle:City')->find($form['cityId']);
                    $participant->setCity($city);
                } else {
                    $participant->setCityName($form['city']);
                }
                if (!empty($form['stateId'])) {
                    $state = $em->getRepository('CyclogramProofPilotBundle:State')->find($form['stateId']);
                    $participant->setState($state);
                } else { 
                    $participant->setParticipantState($form['state']);
                }
                $country = $em->getRepository('CyclogramProofPilotBundle:Country')->find(1);
                $participant->setCountry($country);
                if ($form['sign'] == 'notSign')
                    $participant->setParticipantDeliverySign(false);
                else
                    $participant->setParticipantDeliverySign(true);
                
                $em->persist($participant);
                $em->persist($participant);
                $em->flush($participant);
                
                $this->confirmParticipantEmail($participant, $studyCode);
                
                return $this->registerAndRedirect($participant, $studyCode);
            }
        }
        return $this->render('CyclogramFrontendBundle:Registration:mailing_address.html.twig', 
                array (
                        'id' => $participant->getParticipantId(), 
                        'form' => $form->createView(), 
                        'studyCode' => $studyCode,
                        'steps' => 5,
                        'current' => 5
                        ));
    }
    
    /**
     * @Route("/register/study/{studyCode}", name="_register_in_study")
     * @Template()
     */
    public function registerInStudyAction($studyCode)
    {
        $this->checkStudyEligibility($studyCode);
        $logic = $this->get('study_logic');
        
        if($this->get('security.context')->isGranted("ROLE_PARTICIPANT")) {
            $participant = $this->get('security.context')->getToken()->getUser();
            
            $session = $this->getRequest()->getSession();
            if ($session->has('SurveyInfo')){
                $bag = $session->get('SurveyInfo');
                $surveyId = $bag->get('surveyId');
                $saveId = $bag->get('saveId');
            
                $logic->studyRegistration($participant, $studyCode, $surveyId, $saveId);
                return $this->redirect($this->generateUrl('_main'));
            }
        } 
        
        return $this->redirect($this->generateUrl('_register', array('studyCode'=>$studyCode)));

    }
    
    /**
     * Send email to confirm participant has indicated a real email address
     * @param Participant $participant
     */
    private function confirmParticipantEmail(Participant $participant, $studyCode)
    {
//         return true;
        $em = $this->getDoctrine()->getManager();
    
        $embedded['logo_top'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newsletter_logo.png");
        $embedded['logo_footer'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newletter_logo_footer.png");
        $embedded['login_button'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newsletter_small_login.jpg");
        $embedded['white_top'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newsletter_white_top.png");
        $embedded['white_bottom'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newsletter_white_bottom.png");
        $cc = $this->get('cyclogram.common');
    
        $parameters['code'] = substr(md5( md5( $participant->getParticipantEmail() . md5(microtime()))), 0, 4);
        $participant->setParticipantEmailCode($parameters['code']);
        $em->persist($participant);
        $em->flush($participant);
    
        $parameters['email'] = $participant->getParticipantEmail();
    
        if($studyCode)
            $parameters['studyCode'] = $studyCode;
    
        $parameters['locale'] = $participant->getLocale() ? $participant->getLocale() : $request->getLocale();
        $parameters['host'] = $this->container->getParameter('site_url');
    
        $cc->sendMail($participant->getParticipantEmail(),
                $this->get('translator')->trans("email_title_verify", array(), "email", $parameters['locale']),
                'CyclogramFrontendBundle:Email:email_confirmation.html.twig',
                null,
                $embedded,
                true,
                $parameters);
    }
    
    /**
     * Automatically log in participant and redirect to dashboard
     * @param Participant $participant
     */
    private function registerAndRedirect(Participant $participant, $studyCode)
    {
    
        $session = $this->getRequest()->getSession();
        
        //if studyCode passed also register participant in study
        if($studyCode) {
            $ls = $this->get('study_logic');

            if ($session->has('SurveyInfo')){
                $bag = $session->get('SurveyInfo');
                $surveyId = $bag->get('surveyId');
                $saveId = $bag->get('saveId');

                $ls->studyRegistration($participant, $studyCode, $surveyId, $saveId);
            }
        }

        $resourceOwnerName = $session->get("resourceOwnerName");
    
        echo "ResourceOwner :" . $resourceOwnerName;
    
        $roles = array("ROLE_USER");
        if($resourceOwnerName == "facebook") {
            $roles = array_merge($roles, array("ROLE_FACEBOOK_USER", "ROLE_PARTICIPANT"));
        } else if($resourceOwnerName == "google") {
            $roles = array_merge($roles, array("ROLE_GOOGLE_USER", "ROLE_PARTICIPANT"));
        } else {
            $roles = array_merge($roles, array("ROLE_PARTICIPANT"));
        }
        $session->remove("resourceOwnerName");
    
        $token = new UsernamePasswordToken($participant, null, 'main', $roles);
        $this->get('security.context')->setToken($token);
    
        return $this->redirect( $this->generateUrl("_main") );
    }
    
    
    /**
     * Check study eligibility
     * @param unknown_type $studyCode
     * @throws \Exception
     */
    private function checkStudyEligibility($studyCode, $error = false)
    {
        if(!$studyCode)
            return;
        if ($error) {
            return;
        }
        $session = $this->getRequest()->getSession();
        if ($session->has('SurveyInfo')){
            $bag = $session->get('SurveyInfo');
            $surveyId = $bag->get('surveyId');
            $saveId = $bag->get('saveId');
            if($studyCode != $bag->get('studyCode'))
                throw new \Exception("You have not passed eligibility test");
            
            $surveyResult = $this->get('custom_db')->getFactory('ElegibilityCustom')->getSurveyResponseData($saveId, $surveyId);
            $sl = $this->get('study_logic');
            
            $isEligible = $sl->checkEligibility($studyCode, $surveyResult);
            if(!$isEligible)
                throw new \Exception("You have not passed eligibility test");
        } else {
            throw new \Exception("You have not passed eligibility test");
        }
    }

    /**
     * @Route("/register/email/{id}/{studyCode}", name="_register_email", defaults={"studyCode"=null})
     * @Template()
     */
    public function registerSendEmailAction($id, $studyCode)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $this->checkStudyEligibility($studyCode);
    
        $participant = $em->getRepository("CyclogramProofPilotBundle:Participant")->find($id);
        if ($participant->getParticipantEmailConfirmed() == true) {
            return $this->redirect( $this->generateUrl("_login"));
        }
    
        $participant->setLanguage($request->getLocale());
    
        $this->confirmParticipantEmail($participant, $studyCode);
        $em->persist($participant);
        $em->flush($participant);
    
        return $this->render('CyclogramFrontendBundle:Registration:email_confirm.html.twig');
    }
    
    /**
     * @Route("/register/email_verify/{email}/{code}/{studyCode}", name="email_verify", defaults={"studyCode"=null})
     * @Template()
     */
    public function confirmEmailAction($email, $code, $studyCode)
    {
        $request = $this->getRequest();
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
    
        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->findOneBy(array('participantEmailCode' =>$code, 'participantEmail' => $email));
    
        if ($participant) {
            $participant->setParticipantEmailConfirmed(true);
            $em->persist($participant);
            $em->flush($participant);
    
            if(!empty($studyCode)) {
                $study = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Study')->find($studyCode);
                if($study && $study->getEmailVerificationRequired() ) {
                    $session->set('6step', true);
                    return $this->redirect( $this->generateUrl("_register_mobile", array(
                            'id' => $participant->getParticipantId(),
                            'studyCode' => $studyCode
                    )));
                }
            }
    
            $session->set('confirmed', "Congratilations!!! Your e-mail is confirmed!");
            return $this->redirect( $this->generateUrl("_main") );
    
        } else {
            $error = $this->get('translator')->trans('mail_confirmation_fail', array(), 'register');
            return $this->render('CyclogramFrontendBundle:Registration:mail_confirm.html.twig', array('error' => $error));
        }
         
    }
}
