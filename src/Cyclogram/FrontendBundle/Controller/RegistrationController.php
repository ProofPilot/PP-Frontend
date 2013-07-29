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
     * @Route("/register/{studyId}/{svid}/{sid}", name="_registration", defaults={"studyId"= null})
     * @Template()
     */
    public function step1Action($studyId=null, $svid=0, $sid=0)
    {
        if ($this->get('security.context')->isGranted("ROLE_USER")){
            return $this->redirect($this->generateURL("_main"));
        }
        $request = $this->getRequest();
        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager();
        $study = null;
        $studyLogo = "";
        if ($studyId != null) {
            $study = $em->getRepository('CyclogramProofPilotBundle:Study')->find($studyId);
            $study = $em->getRepository('CyclogramProofPilotBundle:Study')->find($studyId);
            $studyContent = $em->getRepository('CyclogramProofPilotBundle:StudyContent')->findOneBy(array('studyId'=>$studyId));
            $studyLogo = $studyContent->getStudyLogo();
            $studyLogo = "http://admin.dev1.proofpilot.net/2cd1c6ecec2c6d908b3ed66d4ea7b902/".$studyId."/".$studyLogo;
        } else {
            $study = null;
        }

        $form = $this->createForm(new RegistrationForm($this->container));
        $nPic = rand ( 1, 4 );
        
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
                    $country = $em->getRepository('CyclogramProofPilotBundle:Country')->find(1);
                    $participant->setCountry($country);
                    $state =  $em->getRepository('CyclogramProofPilotBundle:State')->find(35);
                    $participant->setState($state);
                    $city = $em->getRepository('CyclogramProofPilotBundle:City')->find(25420);
                    $participant->setCity($city);
                    $sex = $em->getRepository('CyclogramProofPilotBundle:Sex')->find(1);
                    $participant->setSex($sex);
                    $race = $em->getRepository('CyclogramProofPilotBundle:Race')->find(1);
                    $participant->setRace($race);
                    $role = $em->getRepository('CyclogramProofPilotBundle:ParticipantRole')->find(1);
                    $participant->setParticipantRole($role);
                    $status = $em->getRepository('CyclogramProofPilotBundle:Status')->find(1);
                    $participant->setStatus($status);

                    $em->persist($participant);
                    $em->flush();

                    if($studyId == 1){

                        //insert participant_campaign_link
                        $campaignRepo = $this->getDoctrine()
                            ->getRepository('CyclogramProofPilotBundle:Campaign');
                        $campaign = $campaignRepo->find(1);

                        $participantLevelRepo = $this->getDoctrine()
                            ->getRepository('CyclogramProofPilotBundle:ParticipantLevel');
                        $participantLevel = $participantLevelRepo->findOneBy( array("participantLevelName"=>"Customer") );

                        //Campaign
                        $ParticipantCampaignLinkCountData =  $this->getDoctrine()
                            ->getRepository('CyclogramProofPilotBundle:ParticipantCampaignLink')->findBy( array("participantCampaignLinkParticipantEmail"=>$participant->getParticipantEmail()) );

                        $ParticipantCampaignLinkCount = ( is_array($ParticipantCampaignLinkCountData) ) ? count($ParticipantCampaignLinkCountData) : 0;

                        $participantCampaignLinkId = CyclogramCommon::generateParticipantCampaignLinkID(
                            $participantLevel->getParticipantLevelId(),
                            $participant->getParticipantId(),
                            $campaign->getCampaignId(),
                            $ParticipantCampaignLinkCount
                        );

                        $uniqId = uniqid();

                        //ParticipantCampaignLink
                        $campaignLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantCampaignLink();
                        $campaignLink->setParticipant( $participant );
                        $campaignLink->setCampaign( $campaign );
                        $campaignLink->setParticipantLevel( $participantLevel );
                        $campaignLink->setParticipantSurveyLinkUniqid( $uniqId );
                        $campaignLink->setParticipantCampaignLinkId( $participantCampaignLinkId );
                        $campaignLink->setParticipantCampaignLinkParticipantEmail( $participant->getParticipantEmail() );
                        $campaignLink->setParticipantCampaignLinkIpAddress( $_SERVER['REMOTE_ADDR'] );
                        $campaignLink->setParticipantCampaignLinkDatetime( new \DateTime("now") );

                        $em->persist( $campaignLink );
                        $em->flush();

                        $participantSurveyLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantSurveyLink();
                        $participantSurveyLink->setParticipant($participant);
                        $participantSurveyLink->setSaveId($svid);
                        $participantSurveyLink->setSidId($sid);
                        $participantSurveyLink->setParticipantSurveyLinkUniqid( $uniqId );
                        $participantSurveyLink->setParticipantSurveyLinkElegibility(1);

                        $em->persist( $participantSurveyLink );
                        $em->flush();

                        //Add participants to Default Arm at the moment.
                        $armData = $em->getRepository('CyclogramProofPilotBundle:Arm')->find( 5 );
                        $armData = ( ! is_null( $armData )  ) ? $armData : false;

                        $armStatus = $em->getRepository('CyclogramProofPilotBundle:Status')->find( 1 );
                        $armStatus = ( ! is_null( $armStatus ) ) ? $armStatus : false;

                        $ArmParticipantLink = null;
                        if( $armData ){
                            $ArmParticipantLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink();
                            $ArmParticipantLink->setArm($armData);
                            $ArmParticipantLink->setParticipant($participant);
                            $ArmParticipantLink->setStatus($armStatus);
                            $ArmParticipantLink->setParticipantArmLinkDatetime( new \DateTime("now") );
                        }
                        $em->persist($ArmParticipantLink);

                        $em->flush();
                    }

                    if (!empty($study)){
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
                   throw new  Exception('HAHAHA');
                }
            }

           }
          
           if ( !empty($study) && $study->getEmailVerificationRequired() == true) {
               $totalSteps = 6;
           } else {
               $totalSteps = 4;
           }
        return $this->render('CyclogramFrontendBundle:Registration:step1_register.html.twig', array ('form' => $form->createView(), 'studyId' => $studyId, 'totalSteps' => $totalSteps, 'nPic' => $nPic,'studyLogo'=>$studyLogo, 'sid'=>$sid, "svid"=>$svid));
        
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

        $nPic = rand ( 1, 4 );
        
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
        return $this->render('CyclogramFrontendBundle:Registration:step2_mail_confirm.html.twig', array('nPic' => $nPic, 'studyId' => $studyId));
    }
    
    /**
     * @Route("/reg_step3/{id}/{studyId}", name="reg_step_3", defaults={"studyId"=null})
     * @Template()
     */
    public function step3Action($id, $studyId)
    {
        $em = $this->getDoctrine()->getManager();
        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->find($id);
        if (empty($participant)) {
            return $this->redirect( $this->generateUrl("_registration"));
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
                return $this->render('CyclogramFrontendBundle:Registration:step4_mobile_phone_2.html.twig', array('phone' => $participant->getParticipantMobileNumber(), 'id' => $participant->getParticipantId(), 'studyId' => $studyId));
            }
        }
        return $this->render('CyclogramFrontendBundle:Registration:step3_mobile_phone_1.html.twig', array("form" => $form->createView(), 'id' => $id , 'studyId' => $studyId));
    }
    
    /**
     * @Route("/reg_step4/{id}/{studyId}", name="reg_step_4", defaults={"studyId"=null})
     * @Template()
     */
    public function step4Action($id, $studyId)
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
                return $this->redirect(($this->generateUrl("reg_step_5", array('id'=> $participant->getParticipantId(), 'studyId' => $studyId))));
        }
        
        return $this->render('CyclogramFrontendBundle:Registration:step4_mobile_phone_2.html.twig', array('phone' => $customerMobileNumber, 'studyId' => $studyId ));
    }
    
    /**
     * @Route("/reg_step5/{id}/{studyId}", name="reg_step_5", defaults={"studyId"=null})
     * @Template()
     */
    public function step5Action($id, $studyId)
    {
        $em = $this->getDoctrine()->getManager();
        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->find($id);
        if (empty($participant)) {
            return $this->redirect( $this->generateUrl("_registration"));
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
                     return $this->redirect( $this->generateUrl("reg_step_6", array('id' => $participant->getParticipantId(), 'studyId' => $studyId)) );
                } else {
                    $error = "Wrong SMS!";
                }
            }
        }
        return $this->render('CyclogramFrontendBundle:Registration:step5_mobile_phone_3.html.twig', array('error' => $error, 'form' => $form->createView(), 'id' => $participant->getParticipantId(), 'studyId' => $studyId));
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
                $state = $em->getRepository('CyclogramProofPilotBundle:State')->find($form['stateId']);
                $participant->setState($state);
                
                $em->persist($participant);
                $em->flush($participant);
                
                $token = new UsernamePasswordToken($participant, null, 'main', array('ROLE_USER'));
                $this->get('security.context')->setToken($token);
                
                return $this->redirect( $this->generateUrl("_main") );
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
//         $session = $this->getRequest()->getSession();
//         if ($confirmed)
//             $session->set('confirmed', "Congratilations!!! Your e-mail is confirmed!");
        $em = $this->getDoctrine()->getManager();
        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->findOneBy(array('participantEmailCode' =>$code, 'participantEmail' => $email));
        if ($participant) {
            $participant->setParticipantEmailConfirmed(true);
            $em->persist($participant);
            $em->flush($participant);
            
            return $this->redirect( $this->generateUrl("reg_step_3", array('id' => $participant->getParticipantId())) );
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
