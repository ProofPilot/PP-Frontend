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
     * @Route("/register/{studyId}", name="_register", defaults={"studyId"= null})
     * @Template()
     */
    public function registerStartAction($studyId=null)
    {
        //TODO: move the check to action
        if ($this->get('security.context')->isGranted("ROLE_PARTICIPANT")){
            return $this->redirect($this->get('router')->generate("_main"));
        }
        $this->checkStudyEligibility($studyId);
        
        $request = $this->getRequest();
        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new RegistrationForm($this->container));
        
        if(!empty($studyId))
            $study = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Study')->find($studyId);

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
                    $date = new \DateTime();
                    $participant->setParticipantLastTouchDatetime($date);
                    $participant->setParticipantZipcode('');
                    $role = $em->getRepository('CyclogramProofPilotBundle:ParticipantRole')->find(1);
                    $participant->setParticipantRole($role);
                    $status = $em->getRepository('CyclogramProofPilotBundle:Status')->find(1);
                    $participant->setStatus($status);

                    $em->persist($participant);
                    $em->flush();

                    if (!empty($studyId)){
                        if ($study->getEmailVerificationRequired()) {
                            return $this->redirect( $this->generateUrl("_register_email", array('id' => $participant->getParticipantId(), 'studyId' => $studyId)));
                        } else {
                            return $this->redirect( $this->generateUrl("_register_mobile", array('id' => $participant->getParticipantId(), 'studyId' => $studyId)));
                        }
                    } else {
                        return $this->redirect( $this->generateUrl("_register_mobile", array('id' => $participant->getParticipantId())) );
                    }
                    

                } catch (Exception $ex) {
                    $em->close();
                }
            }

           }
          
           if ( !empty($study) && $study->getEmailVerificationRequired() == true) {
               $totalSteps = 6;
           } else {
               $totalSteps = 4;
           }
           
            return $this->render('CyclogramFrontendBundle:Registration:start.html.twig', 
                    array (
                            'form' => $form->createView(), 
                            'totalSteps' => $totalSteps));
        
        }

    /**
     * @Route("/register/email/{id}/{studyId}", name="_register_email", defaults={"studyId"=null})
     * @Template()
    */
    public function registerSendEmailAction($id, $studyId)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $this->checkStudyEligibility($studyId);
        
        $participant = $em->getRepository("CyclogramProofPilotBundle:Participant")->find($id);
        if ($participant->getParticipantEmailConfirmed() == true) {
           return $this->redirect( $this->generateUrl("_login"));
        }
        
        $participant->setLanguage($request->getLocale());
        
        $this->confirmParticipantEmail($participant, $studyId);
        $em->persist($participant);
        $em->flush($participant);

        return $this->render('CyclogramFrontendBundle:Registration:email_confirm.html.twig');
    }
    
    /**
     * @Route("/register/mobile/{id}/{studyId}", name="_register_mobile", defaults={"studyId"=null})
     * @Template()
     */
    public function registerMobileAction($id, $studyId=null)
    {
        $em = $this->getDoctrine()->getManager();
    
        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->find($id);
        if (empty($participant)) {
            throw new \Exception("Wrong participant id");
        }
        $this->checkStudyEligibility($studyId);
    
        $request = $this->getRequest();
        $session = $request->getSession();
    
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
                $participant->setParticipantMobileNumber($userPhone);
                $em->persist($participant);
                $em->flush();
    
                return $this->render('CyclogramFrontendBundle:Registration:mobile_phone_verify.html.twig',
                        array(
                                'phone' => $participant->getParticipantMobileNumber(),
                                'id' => $participant->getParticipantId(),
                                'steps' => $session->get("6step", false) ? 6 : 4,
                                'current' => $session->get("6step", false) ? 4 : 3
                        ));
            }
        }
        return $this->render('CyclogramFrontendBundle:Registration:mobile_phone.html.twig',
                array(
                        "form" => $form->createView(),
                        'id' => $id,
                        'steps' => $session->get("6step", false) ? 6 : 4,
                        'current' => $session->get("6step", false) ? 3 : 2
                ));
    }
    
    /**
     * @Route("/register/sms/{id}/{studyId}", name="_register_sms", defaults={"studyId"=null})
     * @Template()
     */
    public function registerSendSMSAction($id, $studyId)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $this->checkStudyEligibility($studyId);
        
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
                                'studyId' => $studyId
                        ))
                ));
        }
    
        return $this->render('CyclogramFrontendBundle:Registration:mobile_phone_verify.html.twig',
                array(
                        'phone' => $customerMobileNumber));
    }
    
    /**
     * @Route("/register/verify_sms/{id}/{studyId}", name="_register_verify_sms", defaults={"studyId"=null})
     * @Template()
     */
    public function registerVerifySMSAction($id, $studyId)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $this->checkStudyEligibility($studyId);
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
                if ($value['sms_code'] == $userSMS) {
    
                    //Make Participant SMS code confirmed
                    $participant->setParticipantMobileSmsCodeConfirmed(true);
                    $participant->setLanguage($request->getLocale());
                    $em->persist($participant);
                    $em->flush($participant);
    
                    $steps6 = $session->get("6step", false);
    
                    if($steps6) {
                        //on 6step we redirect
                        return $this->redirect($this->generateUrl("_register_mailaddress",
                                array(
                                        'id'=> $id,
                                        'studyId' => $studyId
                                )));
                    }
    
                    $this->confirmParticipantEmail($participant, $studyId);
    
                    return $this->registerAndRedirect($participant, $studyId);
                } else {
                    $error = "Wrong SMS!";
                }
            }
        }
        return $this->render('CyclogramFrontendBundle:Registration:mobile_phone_sms.html.twig',
                array(
                        'error' => $error,
                        'form' => $form->createView(),
                        'id' => $participant->getParticipantId(),
                        'steps' => $session->get("6step", false) ? 6 : 4,
                        'current' => $session->get("6step", false) ? 5 : 4
                ));
    }
    
    
    /**
     * @Route("/register/mailaddress/{id}/{studyId}", name="_register_mailaddress", defaults={"studyId"=null})
     * @Template()
     */
    public function registerMailAddressAction($id, $studyId)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $request->getSession();
        $this->checkStudyEligibility($studyId);
        

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
                $participant->setLanguage($request->getLocale());
                $city = $em->getRepository('CyclogramProofPilotBundle:City')->find($form['cityId']);
                $participant->setCity($city);
                if (strtolower(trim($city->getCityName())) != (strtolower(trim($form['city']))))
                    $participant->setCityName($form['city']);
                $state = $em->getRepository('CyclogramProofPilotBundle:State')->find($form['stateId']);
                $participant->setState($state);
                
                $em->persist($participant);
                $em->persist($participant);
                $em->flush($participant);
                
                return $this->registerAndRedirect($participant, $studyId);
            }
        }
        return $this->render('CyclogramFrontendBundle:Registration:mailing_address.html.twig', 
                array (
                        'id' => $participant->getParticipantId(), 
                        'form' => $form->createView(), 
                        'studyId' => $studyId,
                        'steps' => 6,
                        'current' => 6
                        ));
    }
    
    /**
     * @Route("/register/study/{studyId}", name="_register_in_study")
     * @Template()
     */
    public function registerInStudyAction($studyId)
    {
        $this->checkStudyEligibility($studyId);
        $logic = $this->get('study_logic');
        
        if($this->get('security.context')->isGranted("ROLE_PARTICIPANT")) {
            $participant = $this->get('security.context')->getToken()->getUser();
            
            $session = $this->getRequest()->getSession();
            if ($session->has('SurveyInfo')){
                $bag = $session->get('SurveyInfo');
                $surveyId = $bag->get('surveyId');
                $saveId = $bag->get('saveId');
            
                $logic->studyRegistration($participant, $studyId, $surveyId, $saveId);
                return $this->redirect($this->generateUrl('_main'));
            }
        } 
        
        return $this->redirect($this->generateUrl('_register_start', array('studyId'=>$studyId)));

    }
    
    /**
     * @Route("/register/email_verify/{email}/{code}/{studyId}", name="email_verify", defaults={"studyId"=null})
     * @Template()
     */
    public function confirmEmailAction($email, $code, $studyId)
    {
        $request = $this->getRequest();
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
    
        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->findOneBy(array('participantEmailCode' =>$code, 'participantEmail' => $email));
    
        if ($participant) {
            $participant->setParticipantEmailConfirmed(true);
            $em->persist($participant);
            $em->flush($participant);
    
            if(!empty($studyId)) {
                $study = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Study')->find($studyId);
                if($study && $study->getEmailVerificationRequired() ) {
                    $session->set('6step', true);
                    return $this->redirect( $this->generateUrl("_register_mobile", array(
                            'id' => $participant->getParticipantId(),
                            'studyId' => $studyId
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
    
    /**
     * Send email to confirm participant has indicated a real email address
     * @param Participant $participant
     */
    private function confirmParticipantEmail(Participant $participant, $studyId)
    {
        $em = $this->getDoctrine()->getManager();
    
        $embedded['logo_top'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newsletter_logo.png");
        $embedded['logo_footer'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newletter_logo_footer.png");
        $embedded['login_button'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newsletter_small_login.jpg");
        $cc = $this->get('cyclogram.common');
    
        $parameters['code'] = substr(md5( md5( $participant->getParticipantEmail() . md5(microtime()))), 0, 4);
        $participant->setParticipantEmailCode($parameters['code']);
        $em->persist($participant);
        $em->flush($participant);
    
        $parameters['email'] = $participant->getParticipantEmail();
    
        if($studyId)
            $parameters['studyId'] = $studyId;
    
        //        $parameters['confirmed'] = 1;
        //        $parameters['simple'] = true;  //TODO :wassap?
    
        $parameters['locale'] = $participant->getLanguage() ? $participant->getLanguage() : $request->getLocale();
    
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
    private function registerAndRedirect(Participant $participant, $studyId)
    {
    
        $session = $this->getRequest()->getSession();
        
        //if studyId passed also register participant in study
        if($studyId) {
            $ls = $this->get('study_logic');

            if ($session->has('SurveyInfo')){
                $bag = $session->get('SurveyInfo');
                $surveyId = $bag->get('surveyId');
                $saveId = $bag->get('saveId');

                $ls->studyRegistration($participant, $studyId, $surveyId, $saveId);
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
     * @param unknown_type $studyId
     * @throws \Exception
     */
    private function checkStudyEligibility($studyId)
    {
        if(!$studyId)
            return;
        
        $session = $this->getRequest()->getSession();
        if ($session->has('SurveyInfo')){
            $bag = $session->get('SurveyInfo');
            $surveyId = $bag->get('surveyId');
            $saveId = $bag->get('saveId');
            if($studyId != $bag->get('studyId'))
                throw new \Exception("You have not passed eligibility test");
            
            $surveyResult = $this->get('custom_db')->getFactory('ElegibilityCustom')->getSurveyResponseData($saveId, $surveyId);
            $sl = $this->get('study_logic');
            
            $isEligible = $sl->checkEligibility($studyId, $surveyResult);
            if(!$isEligible)
                throw new \Exception("You have not passed eligibility test");
        } else {
            throw new \Exception("You have not passed eligibility test");
        }
    }

}
