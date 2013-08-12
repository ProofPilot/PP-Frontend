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
     * @Route("/register/{studyId}", name="_registration", defaults={"studyId"= null})
     * @Template()
     */
    public function step1Action($studyId=null)
    {
        if ($this->get('security.context')->isGranted("ROLE_USER")){
            return $this->redirect($this->generateURL("_main"));
        }
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
                            return $this->redirect( $this->generateUrl("reg_step_2", array('id' => $participant->getParticipantId(), 'studyId' => $studyId)));
                        } else {
                            return $this->redirect( $this->generateUrl("simplereg_step_2", array('id' => $participant->getParticipantId(), 'studyId' => $studyId)));
                        }
                    } else {
                        return $this->redirect( $this->generateUrl("simplereg_step_2", array('id' => $participant->getParticipantId())) );
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
           
            return $this->render('CyclogramFrontendBundle:Registration:step1_register.html.twig', 
                    array (
                            'form' => $form->createView(), 
                            'totalSteps' => $totalSteps));
        
        }

    /**
     * @Route("/reg_step2/{id}/{studyId}", name="reg_step_2", defaults={"studyId"=null})
     * @Template()
    */
    public function step2Action($id, $studyId)
    {
        $em = $this->getDoctrine()->getManager();
        $participant = $em->getRepository("CyclogramProofPilotBundle:Participant")->find($id);
        if ($participant->getParticipantEmailConfirmed() == true) {
           return $this->redirect( $this->generateUrl("_login"));
        }
        
        $cc = $this->get('cyclogram.common');
        
        $embedded['logo_top'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newsletter_logo.png");
        $embedded['logo_footer'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newletter_logo_footer.png");
        $embedded['login_button'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newsletter_small_login.jpg");
        $parameters['code'] = substr(md5( md5( $participant->getParticipantEmail() . md5(microtime()))), 0, 4);
        $parameters['email'] = $participant->getParticipantEmail();
        $parameters['confirmed'] = 1;
        $parameters['studyId'] = $studyId;
        
        $em = $this->getDoctrine()->getManager();

        $request = $this->getRequest();

        
        $participant->setParticipantEmailCode($parameters['code']);
        $em->persist($participant);
        $em->flush($participant);
        
        $cc->sendMail($participant->getParticipantEmail(),
                'Please Verify your e-mail address',
                'CyclogramFrontendBundle:Email:email_confirmation.html.twig',
                null,
                $embedded,
                true,
                $parameters);
        return $this->render('CyclogramFrontendBundle:Registration:step2_mail_confirm.html.twig');
    }
    
    /**
     * @Route("/reg_step3/{id}/{studyId}", name="reg_step_3", defaults={"studyId"=null})
     * @Template()
     */
    public function step3Action($id, $studyId)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $request->getSession();

        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->find($id);
        if (empty($participant)) {
            return $this->redirect( $this->generateUrl("_registration"));
        }
        $request = $this->getRequest();
        
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
                
                return $this->render('CyclogramFrontendBundle:Registration:step4_mobile_phone_2.html.twig', array(
                        'phone' => $participant->getParticipantMobileNumber(), 
                        'id' => $participant->getParticipantId()
                        ));
            }
        }
        return $this->render('CyclogramFrontendBundle:Registration:step3_mobile_phone_1.html.twig', array(
                "form" => $form->createView(), 
                'id' => $id ));
    }
    
    /**
     * @Route("/reg_step4/{id}/{studyId}", name="reg_step_4", defaults={"studyId"=null})
     * @Template()
     */
    public function step4Action($id, $studyId)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();

        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->find($id);
        if (empty($participant)) {
            return $this->redirect( $this->generateUrl("_registration"));
        }
        
        if ($participant->getParticipantMobileSmsCodeConfirmed() == true) {
            return $this->redirect( $this->generateUrl("_login"));
        }
        
        $customerMobileNumber = $participant->getParticipantMobileNumber();
        $request = $this->getRequest();
        
        if( $customerMobileNumber ){
        
            $participantSMSCode = CyclogramCommon::getAutoGeneratedCode(4);
            $participant->setParticipantMobileSmsCode($participantSMSCode);
            $em->persist($participant);
            $em->flush($participant);
        
            $sms = $this->get('sms');
            $sentSms = $sms->sendSmsAction( array('message' => "Your SMS Verification code is $participantSMSCode", 'phoneNumber'=>"$customerMobileNumber") );
            if($sentSms)
                return $this->redirect(($this->generateUrl("reg_step_5", array(
                        'id'=> $participant->getParticipantId(), 
                        'studyId' => $studyId))));
        }
        
        return $this->render('CyclogramFrontendBundle:Registration:step4_mobile_phone_2.html.twig', array(
                'phone' => $customerMobileNumber));
    }
    
    /**
     * @Route("/reg_step5/{id}/{studyId}", name="reg_step_5", defaults={"studyId"=null})
     * @Template()
     */
    public function step5Action($id, $studyId)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();

        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->find($id);
        if (empty($participant)) {
            return $this->redirect( $this->generateUrl("_registration"));
        }
        
        $userSMS = $participant->getParticipantMobileSmsCode();
        $request = $this->getRequest();
        
        $error = "";
        $form = $this->createForm(new UserSmsCodeForm($this->container));

        
        if( $request->getMethod() == "POST" ){
        
            $form->handleRequest($request);
        
            if( $form->isValid() ) {
                $value = $form->getData();
                if ($value['sms_code'] == $userSMS) {
                    $participant->setParticipantMobileSmsCodeConfirmed(true);
                    $em->persist($participant);
                    $em->flush($participant);
                     return $this->redirect( $this->generateUrl("reg_step_6", array(
                             'id' => $participant->getParticipantId(), 
                             'studyId' => $studyId)) );
                } else {
                    $error = "Wrong SMS!";
                }
            }
        }
        return $this->render('CyclogramFrontendBundle:Registration:step5_mobile_phone_3.html.twig', array(
                'error' => $error, 
                'form' => $form->createView(), 
                'id' => $participant->getParticipantId()));
    }
    
    
    /**
     * @Route("/reg_step6/{id}/{studyId}", name="reg_step_6", defaults={"studyId"=null})
     * @Template()
     */
    public function step6Action($id, $studyId)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();

        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->find($id);
        
        if (empty($participant)) {
            return $this->redirect( $this->generateUrl("_registration"));
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
                $city = $em->getRepository('CyclogramProofPilotBundle:City')->find($form['cityId']);
                $participant->setCity($city);
                if (strtolower(trim($city->getCityName())) != (strtolower(trim($form['city']))))
                    $participant->setCityName($form['city']);
                $state = $em->getRepository('CyclogramProofPilotBundle:State')->find($form['stateId']);
                $participant->setState($state);
                
                $em->persist($participant);
                $em->flush($participant);
                
                $ls = $this->get('fpp_ls');
                

                $session = $this->getRequest()->getSession();
                if ($session->has('SurveyInfo')){
                    $bag = $session->get('SurveyInfo');
                    $surveyId = $bag->get('surveyId');
                    $saveId = $bag->get('saveId');
                    
                    if($studyId)
                        $ls->studyRegistration($participant, $studyId, $surveyId, $saveId);
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
                
                $token = new UsernamePasswordToken($participant, null, 'main', $roles);
                $this->get('security.context')->setToken($token);
                
                return $this->redirect( $this->generateUrl("_main", array(
                        'studyId'=>$studyId
                        )) );
            }
        }
        return $this->render('CyclogramFrontendBundle:Registration:step6_mailing_address.html.twig', array ('id' => $participant->getParticipantId(), 'form' => $form->createView(), 'studyId' => $studyId));
    }
    
    /**
     * @Route("/email_verify/{email}/{code}/{confirmed}/{studyId}", name="email_verify", defaults={"studyId"=null})
     * @Template()
     */
    public function confirmEmailAction($email, $code, $confirmed, $studyId)
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->findOneBy(array('participantEmailCode' =>$code, 'participantEmail' => $email));
        if ($participant) {
            $participant->setParticipantEmailConfirmed(true);
            $em->persist($participant);
            $em->flush($participant);
            
            return $this->redirect( $this->generateUrl("reg_step_3", array(
                    'id' => $participant->getParticipantId(),
                    'studyId' => $studyId
                    )));
        } else {
            $error = $this->get('translator')->trans('mail_confirmation_fail', array(), 'register');
            return $this->render('CyclogramFrontendBundle:Registration:step2_mail_confirm.html.twig', array('error' => $error));
        }
       
    }
    
    
    /**
     * @Route("/get_city_state_ajax/{zipcode}", name="_get_city_state_by_zip", options={"expose"=true})
     */
    public function getCityAndStateByZipCode($zipcode)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $results = $em->createQuery("
                SELECT c.cityId, c.cityName, s.stateId, s.stateName
                FROM CyclogramProofPilotBundle:City c
                INNER JOIN c.state s
                WHERE c.cityZipcode = :zipcode
                ")
                ->setParameter('zipcode', $zipcode)
                ->getResult();
        
//         foreach($results as $result ) {
//             $json[] = array (
//                     'cityId' => $result["cityId"],
//                     'cityName' => $result["cityName"],
//                     'stateId' => $result["stateId"],
//                     'stateName' => $result["stateName"]
//                     );
//         }
        return new Response(json_encode($results));
        
    }
    
    
    /**
     * @Route("/search_city_ajax", name="searchCityWithAjax", options={"expose"=true})
     */
    public function searchCityWithAjaxAction(Request $request)
    {
        if ($term = trim($request->get('query')))
        {
            $termUpper = strtoupper($term);
            $em = $this->getDoctrine()->getEntityManager();
    
            $repository = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:City');
    
            $qb = $repository->createQueryBuilder('c');
            $query = $qb
            ->select('c.cityName, c.cityId')
            ->where("UPPER(c.cityName) like '%$termUpper%'")
            ->getQuery();
    
            $cities = $query->getResult();
            
            foreach($cities as $city) {
                $suggestions[] = array(
                        'value' => $city["cityName"],
                        'data' =>  $city["cityId"]
                        ); 
            }
            
            $json = array(
                    'query' => $term,
                    'suggestions' => $suggestions
                    );
    
            return new Response(json_encode($json), 200);
        }
    
        return new Response('', 200);
    }
    
    /**
     * @Route("/search_state_ajax", name="searchStateWithAjax", options={"expose"=true})
     */
    public function searchStateWithAjaxAction(Request $request)
    {
        if ($term = trim($request->get('query')))
        {
            $termUpper = strtoupper($term);
            $em = $this->getDoctrine()->getEntityManager();
    
            $repository = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:State');
    
            $qb = $repository->createQueryBuilder('s');
            $query = $qb
            ->select('s.stateName, s.stateId')
            ->where("UPPER(s.stateName) like '%$termUpper%'")
            ->getQuery();
    
            $states = $query->getResult();
            
            foreach($states as $state) {
                $suggestions[] = array(
                        'value' => $state["stateName"],
                        'data' =>  $state["stateId"]
                        ); 
            }
            
            $json = array(
                    'query' => $term,
                    'suggestions' => $suggestions
                    );
            
            return new Response(json_encode($json), 200);
        }
    
        return new Response('', 200);
    }
}
