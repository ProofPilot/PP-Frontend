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

use Cyclogram\FrontendBundle\Aop\Check;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantStudyReminderLink;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantContactTimeLink;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantStudyReminder;

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
use Common\DefaultParticipantStudy;



class RegistrationController extends Controller
{
    public function checkEligibility()
    {
        if ($this->get('security.context')->isGranted("ROLE_PARTICIPANT")){
            return $this->redirect($this->get('router')->generate("_main"));
        }
        
        $request = $this->getRequest();
        $studyCode = $request->get('studyCode');
       
        if(!$studyCode)
            return;
        $session = $this->getRequest()->getSession();
        if ($session->has('SurveyInfo')){
            $bag = $session->get('SurveyInfo');
            $surveyId = $bag->get('surveyId');
            $saveId = $bag->get('saveId');
            if($studyCode != $bag->get('studyCode'))
                return $this->render("::error.html.twig", array(
                        "error" => "Eligibility results do not match StudyCode"));
            
            $surveyResult = $this->get('custom_db')->getFactory('ElegibilityCustom')->getSurveyResponseData($saveId, $surveyId);
            $sl = $this->get('study_logic');
            
            $isEligible = $sl->checkEligibility($studyCode, $surveyResult);
            if(!$isEligible)
                return $this->render("::error.html.twig", array(
                        "error" => "You cannot register without passing eligibility test[2]"));
        } else {
            return $this->render("::error.html.twig", array(
                    "error" => "You cannot register without passing eligibility test[3]"));
        }
    }
    
    public function checkParticipant()
    {
        $session = $this->getRequest()->getSession();
        $id = $this->getRequest()->get('id');
        $studyCode = $this->getRequest()->get('studyCode');
        if(!$id)
            return $this->redirect($this->generateUrl('_register', array('studyCode'=>$studyCode)));
        $sessionId = $session->get("participantId");
        if($id != $sessionId)
            return $this->redirect($this->generateUrl('_register', array('studyCode'=>$studyCode)));
    }

    /**
     * @Route("/register/{studyCode}", name="_register", defaults={"studyCode"= null})
     * @Check(name="checkEligibility")
     * @Template()
     */
    public function registerStartAction($studyCode=null)
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager();
        $participant = new Participant();
      
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
                    
                    $participnat_level = $em->getRepository('CyclogramProofPilotBundle:ParticipantLevel')->findOneByParticipantLevelName('Lead');
                    $participant->setLevel($participnat_level);
                    $participant->setParticipantEmail($registration->getParticipantEmail()); 
                    $participant->setParticipantAppreciationEmail($registration->getParticipantEmail());
                    $factory = $this->get('security.encoder_factory');
                    $encoder = $factory->getEncoder($participant);

                    $participant->setParticipantPassword($encoder->encodePassword($registration->getParticipantPassword(), $participant->getSalt()));
                    $participant->setParticipantUsername($registration->getParticipantUsername());
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

                    $em->persist($participant);
                    $em->flush();
                    $session->set("participantId", $participant->getParticipantId());
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
     * @Route("/register/mobile/{id}/{studyCode}", name="_register_mobile", defaults={"studyCode"=null})
     * @Check(name="checkEligibility,checkParticipant")
     * @Template()
     */
    public function registerMobileAction($id, $studyCode=null)
    {
        $em = $this->getDoctrine()->getManager();
    
        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->find($id);
        if (empty($participant)) {
            return $this->render("::error.html.twig", array(
                    "error"=>"Wrong participant id"));
        }
    
        $request = $this->getRequest();
        $session = $request->getSession();
        if ($session->has('aditional_phone'))
            $aditionalNumber = $session->get('aditional_phone');
    
        $form = $this->createForm(new MobilePhoneForm($this->container), null, array(
                'validation_groups' => array('registration')
        ));
        if (!isset($aditionalNumber)) {
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
                $country = $em->getRepository('CyclogramProofPilotBundle:Country')->findOneByCountryCode($countryCode);
                if (isset($country)){
                    $form->get('phone_small')->setData($country->getDailingCode());
                }
            }
        } else {
            if ($participant->getVoicephone()){
                $phone = CyclogramCommon::parsePhoneNumber($participant->getVoicephone());
            }
            
            if(!empty($phone)) {
                $form->get('voice_phone_small')->setData($phone['country_code']);
                $form->get('voice_phone_wide')->setData($phone['phone']);
            }
            
            $clientIp = $request->getClientIp();
            if ($clientIp == '127.0.0.1') {
                $form->get('voice_phone_small')->setData(380);
            }
            $geoip = $this->get('maxmind.geoip')->lookup($clientIp);
            if ($geoip != false) {
                $countryCode = $geoip->getCountryCode();
                $country = $em->getRepository('CyclogramProofPilotBundle:Country')->findOneByCountryCode($countryCode);
                if (isset($country)){
                    $form->get('voice_phone_small')->setData($country->getDailingCode());
                }
            }
        }
    
        if( $request->getMethod() == "POST" ){
    
            $form->handleRequest($request);
    
            if( $form->isValid() ) {
    
                $values = $form->getData();
                if (!isset($aditionalNumber)) {
                    $userPhone = $values['phone_small'].$values['phone_wide'];
                    $session->set('participantMobileNumber', $userPhone);
                } else {
                    $userPhone = $values['voice_phone_small'].$values['voice_phone_wide'];
                    $participant->setVoicePhone($userPhone);
                    $session->remove('aditional_phone');
                }
                $em->persist($participant);
                $em->flush();
                if (isset($aditionalNumber)){
                    if($session->has("5step", false)) {
                        //on 5step we redirect
                        return $this->redirect($this->generateUrl("_register_mailaddress",
                                array(
                                        'id'=> $id,
                                        'studyCode' => $studyCode
                                )));
                    } else {
                        $this->confirmParticipantEmail($participant, $studyCode);
                        return $this->registerAndRedirect($participant, $studyCode);
                    }
                } 
                if (!empty($values['aditional_phone']))
                    $session->set('aditional_phone', $values['aditional_phone']);
                return $this->render('CyclogramFrontendBundle:Registration:mobile_phone_verify.html.twig',
                        array(
                                'phone' => $session->get('participantMobileNumber'),
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
                        'aditional_phone' => isset($aditionalNumber) ? $aditionalNumber : false
                ));
    }
    
    /**
     * @Route("/register/sms/{id}/{studyCode}", name="_register_sms", defaults={"studyCode"=null})
     * @Check(name="checkEligibility,checkParticipant")
     * @Template()
     */
    public function registerSendSMSAction($id, $studyCode)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        
        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->find($id);
    
        if (empty($participant)) {
            return $this->redirect( $this->generateUrl("_register"));
        }
        if ($session->has('participantMobileNumber')) {
            $customerMobileNumber = $session->get('participantMobileNumber');
        } else {
            return $this->redirect($this->generateUrl("_register_mobile",
                    array(
                            'id'=> $id,
                            'studyCode' => $studyCode
                    )));
        }
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
     * @Check(name="checkEligibility,checkParticipant")
     * @Template()
     */
    public function registerVerifySMSAction($id, $studyCode)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();

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
                if (($value['sms_code'] == $userSMS) || ($this->isTemporalSmsCode($value['sms_code']))) {
                    
                    //Make Participant SMS code confirmed
                    $timezone = $em->getRepository('CyclogramProofPilotBundle:ParticipantTimeZone')->findOneByParticipantTimezoneName($form['timeZone']->getData());
                    if (empty($timezone))
                        $timezone = $em->getRepository('CyclogramProofPilotBundle:ParticipantTimeZone')->find(1);
                    $participant->setParticipantMobileSmsCodeConfirmed(true);
                    $participant->setParticipantMobileNumber($session->get('participantMobileNumber'));
//                     $participnat_level = $em->getRepository('CyclogramProofPilotBundle:ParticipantLevel')->findOneByParticipantLevelName('Customer');
//                     $participant->setLevel($participnat_level);
                    $mailCode = $participant->getParticipantEmailCode();
                    if(empty($mailCode)){
                        $mailCode = substr(md5( md5( $participant->getParticipantEmail() . md5(microtime()))), 0, 4);
                        $participant->setParticipantEmailCode($mailCode);
                    }
                    $em->persist($participant);
                    $em->flush($participant);
                    $session->remove('participantMobileNumber');
                    
                    $steps5 = $session->get("5step", false);
                    if ($session->has('aditional_phone')) {
                        
                            return $this->redirect($this->generateUrl("_register_mobile",
                                    array(
                                            'id'=> $id,
                                            'studyCode' => $studyCode
                                    )));
                    }
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
                        $studyContent = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:StudyContent')->getStudyContentByCode($studyCode, $request->getLocale());
                        return $this->redirect($this->generateUrl('_page', array(
                                'studyUrl' => $studyContent->getStudyUrl(),
                                'eligible' => false
                        )));
                    }
                    
                    switch($request->getLocale()) {
                    	case 'pt':  
                        	$error = "C�digo de acesso recebido por SMS incorreto";
							break;
						default:
							$error = "Wrong SMS!";
							break;
					}
                    
                }
            }
        }
        return $this->render('CyclogramFrontendBundle:Registration:mobile_phone_sms.html.twig',
                array(
                        'error' => $error,
                        'form' => $form->createView(),
                        'id' => $participant->getParticipantId(),
                        'steps' => $session->get("5step", false) ? 5 : 4,
                        'current' => 4,
                        'studyCode' => $studyCode
                ));
    }
    
    
    /**
     * @Route("/register/mailaddress/{id}/{studyCode}", name="_register_mailaddress", defaults={"studyCode"=null})
     * @Check(name="checkEligibility,checkParticipant")
     * @Template()
     */
    public function registerMailAddressAction($id, $studyCode)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $request->getSession();
        

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
        $logic = $this->get('study_logic');
        
        if($this->get('security.context')->isGranted("ROLE_PARTICIPANT")) {
            $participant = $this->get('security.context')->getToken()->getUser();
            
            $session = $this->getRequest()->getSession();
            if ($session->has('SurveyInfo')){
                $bag = $session->get('SurveyInfo');
                $surveyId = $bag->get('surveyId');
                $saveId = $bag->get('saveId');
                if($studyCode != $bag->get('studyCode'))
                    return $this->render("::error.html.twig", array(
                            "error" => "Eligibility results do not match StudyCode"));
                
                $surveyResult = $this->get('custom_db')->getFactory('ElegibilityCustom')->getSurveyResponseData($saveId, $surveyId);
                
                $isEligible = $logic->checkEligibility($studyCode, $surveyResult);
                if(!$isEligible)
                    return $this->render("::error.html.twig", array(
                            "error" => "You cannot register without passing eligibility test[2]"));
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
        if ($studyCode != 'sexpro') {
            if($participant->getParticipantEmailConfirmed() == false) {
            
                $cc = $this->get('cyclogram.common');
                
                $embedded = array();
                $embedded = $cc->getEmbeddedImages();
                
                $parameters['code'] = $participant->getParticipantEmailCode();
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
        }
    }
    
    /**
     * Automatically log in participant and redirect to dashboard
     * @param Participant $participant
     */
    private function registerAndRedirect(Participant $participant, $studyCode)
    {
    
        $session = $this->getRequest()->getSession();
        
        $em = $this->getDoctrine()->getManager();
        $participnat_level = $em->getRepository('CyclogramProofPilotBundle:ParticipantLevel')->findOneByParticipantLevelName('Customer');
        $participant->setLevel($participnat_level);
        $em->persist($participant);
        $em->flush($participant);
        $defaultParticipantStudy = new DefaultParticipantStudy($this->container);
        $defaultParticipantStudy->participantDefaultStudyRegistration($participant);
        
        //if studyCode passed also register participant in study
        if($studyCode) {
            $ls = $this->get('study_logic');

            if ($session->has('SurveyInfo') && $session->has('referralSite') && $session->has('referralCampaign')){
                $bag = $session->get('SurveyInfo');
                $surveyId = $bag->get('surveyId');
                $saveId = $bag->get('saveId');

                $surveyResult = $this->get('custom_db')->getFactory('ParticipantCustom')->addParticipantIdToSurvey($participant->getParticipantId(), $surveyId, $saveId);
                
                $ls->studyRegistration($participant, $studyCode, $surveyId, $saveId);
            } else {
                $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
                $studyContent = $em->getRepository('CyclogramProofPilotBundle:StudyContent')->findOneByStudy($study);
                $session->set("message", $this->get('translator')->trans('study_register_error', array(), 'register'));
                $em->remove($participant);
                $em->flush();
                return $this->redirect($this->generateUrl("_page", array("studyUrl" => $studyContent->getStudyUrl())));
            }
        }

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
        $this->addDefaultContactPreferences($participant);
        $token = new UsernamePasswordToken($participant, null, 'main', $roles);
        $this->get('security.context')->setToken($token);
        
        return $this->redirect( $this->generateUrl("_main") );
    }


    /**
     * @Route("/register/email/{id}/{studyCode}", name="_register_email", defaults={"studyCode"=null})
     * @Check(name="checkEligibility")
     * @Template()
     */
    public function registerSendEmailAction($id, $studyCode)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
    
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
            return $this->redirect( $this->generateUrl("_main", array(
                    'studyCode' => $studyCode
                    )) );
    
        } else {
            $error = $this->get('translator')->trans('mail_confirmation_fail', array(), 'register');
            return $this->render('CyclogramFrontendBundle:Registration:email_confirm.html.twig', array('error' => $error));
        }
         
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
    
    private function addDefaultContactPreferences($participant) {
        $em = $this->getDoctrine()->getManager();
        
        $reminder = $em->getRepository('CyclogramProofPilotBundle:ParticipantStudyReminder')->find(1);
        $reminderLink = $em->getRepository('CyclogramProofPilotBundle:ParticipantStudyReminderLink')->findOneBy(array('participant' => $participant, 'participantStudyReminder' => $reminder));
        if (empty($reminderLink)){
            $reminderLink = new ParticipantStudyReminderLink();
            $reminderLink->setParticipant($participant);
            $reminderLink->setParticipantStudyReminder($reminder);
            $reminderLink->setBySMS(true);
            $reminderLink->setByEmail(true);
            $em->persist($reminderLink);
            $em->flush();
        } 
        $contactTime = $em->getRepository('CyclogramProofPilotBundle:ParticipantContactTime')->find(1);
        for ($i=0; $i<7; $i++){
            $em->getRepository('CyclogramProofPilotBundle:ParticipantContactTimeLink')
                        ->updateParticipantContactTimeLink($participant, $contactTime, $i, true, true);
        }
        
    }
}
