<?php

namespace Cyclogram\FrontendBundle\Controller;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantStudyReminderLink;

use Symfony\Component\HttpFoundation\Response;

use Cyclogram\FrontendBundle\Form\MailingAddressForm;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cyclogram\FrontendBundle\Form\GeneralSettingForm;
use Cyclogram\CyclogramCommon;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * @Route("/main")
 */
class GeneralSettingsController  extends Controller
{

    /**
     * @Route("/general_settings", name="_settings")
     * @Secure(roles="ROLE_PARTICIPANT")
     * @Template()
     */
    public function generalSettingsAction()
    {
        $participant = $this->get('security.context')->getToken()->getUser();
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $surveyscount = $em->getRepository('CyclogramProofPilotBundle:Participant')->getActiveParticipantInterventionsCount($participant);
        
        $parameters["lastaccess"] = new \DateTime();
        $parameters["expandedFormClass"] = '';
         
        if($participant->getFacebookId())
            $parameters["user"]["avatar"] = "http://graph.facebook.com/" . $participant->getParticipantUsername() . "/picture?width=80&height=82";

        $form = $this->createForm(new GeneralSettingForm($this->container));

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $data = $form->getData();

                if($form->get('userNameConfirm')->isClicked()) {
                    $participant->setParticipantUsername($data['newUserName']);
                    $em->persist($participant);
                    $em->flush();
                    $parameters['message'] = "Your username has been changed";
                } elseif ($form->get('passwordSendSMS')->isClicked()) {
                    $participantSMSCode = CyclogramCommon::getAutoGeneratedCode(4);
                    $participant->setParticipantMobileSmsCode($participantSMSCode);
                    $sms = $this->get('sms');
                    $sentSms = $sms->sendSmsAction( array('message' => "Your password reset code is $participantSMSCode", 'phoneNumber'=>$participant->getParticipantMobileNumber()) );
                    if($sentSms) {
                        $session = $request->getSession();
                        $session->set('newPassword', $data['newPassword']);
                        $em->persist($participant);
                        $em->flush($participant);
                        $parameters['message'] = "Confirmation SMS has been sent to you";
                    }
                    $parameters["expandedFormClass"] = 'password';
                } elseif ($form->get('passwordConfirm')->isClicked()) {
                    $session = $request->getSession();
                    if ($session->has('newPassword')) {
                        $participant->setParticipantPassword($session->get('newPassword'));
                        $em->persist($participant);
                        $em->flush($participant);
                        $session->invalidate();
                        $parameters['message'] = "Your password has been changed";
                    }
                } elseif ($form->get('emailConfirm')->isClicked()) {
                    $participant->setParticipantEmail($data['newEmail']);
                    $em->persist($participant);
                    $em->flush($participant);
                    $parameters['message'] = "Your email has been changed";
                } elseif ($form->get('phoneSendSMS')->isClicked()) {
                    $participantSMSCode = CyclogramCommon::getAutoGeneratedCode(4);
                    $participant->setParticipantMobileSmsCode($participantSMSCode);
                    
                    $sms = $this->get('sms');
                    $sentSms = $sms->sendSmsAction( array('message' => "Your mobile phone change code is $participantSMSCode", 'phoneNumber'=> $data['newPhoneNumber']) );
                    if($sentSms) {
                        $session = $request->getSession();
                        $session->set('newPhoneNumber', $data['newPhoneNumber']);
                        $em->persist($participant);
                        $em->flush($participant);
                        $parameters['message'] = "Confirmation SMS has been sent to you";
                    }
                    $parameters["expandedFormClass"] = 'mobile';
                } elseif ($form->get('phoneConfirm')->isClicked()) {
                    $session = $request->getSession();
                    if ($session->has('newPhoneNumber')) {
                        $participant->setParticipantMobileNumber($session->get('newPhoneNumber'));
                        $em->persist($participant);
                        $em->flush($participant);
                        $session->invalidate();
                        $parameters['message'] = "Your mobile numder has been changed";
                    }
                } 
            } 
            else {
               if($form->get('userNameConfirm')->isClicked()) {
                   $parameters["expandedFormClass"] = 'username';
                } elseif ($form->get('passwordSendSMS')->isClicked()) {
                    $parameters["expandedFormClass"] = 'password';
                } elseif ($form->get('passwordConfirm')->isClicked()) {
                    $parameters["expandedFormClass"] = 'password';
                } elseif ($form->get('emailConfirm')->isClicked()) {
                    $parameters["expandedFormClass"] = 'email';
                } elseif ($form->get('phoneSendSMS')->isClicked()) {
                    $parameters["expandedFormClass"] = 'mobile';
                } elseif ($form->get('phoneConfirm')->isClicked()) {
                    $parameters["expandedFormClass"] = 'mobile';
                } 
            }
        }
        
        $parameters["participant"] = $participant;
        
        $parameters["user"]["name"] = $participant->getParticipantFirstname() . ' ' . $participant->getParticipantLastname();
        $parameters["user"]["username"] = $participant->getParticipantUsername();
        $parameters["user"]["last_access"] = $participant->getParticipantLastTouchDatetime();
        
        $parameters['form'] = $form->createView();
            
        return $this->render('CyclogramFrontendBundle:GeneralSettings:general_settings.html.twig', $parameters);
    }
    
    /**
     * @Route("/shipping_infornation/{update}", name="_shipping", defaults={"update"=null})
     * @Secure(roles="ROLE_PARTICIPANT")
     * @Template()
     */
    public function generalShippingAction($update)
    {
        $participant = $this->get('security.context')->getToken()->getUser();
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $surveyscount = $em->getRepository('CyclogramProofPilotBundle:Participant')->getActiveParticipantInterventionsCount($participant);
    
        $parameters["lastaccess"] = new \DateTime();
        if ($update)
            $parameters["update_data"] = $update;
        $parameters["expandedFormClass"] = '';
        $parameters["participant"] = $participant;
        
        $parameters["user"]["name"] = $participant->getParticipantFirstname() . ' ' . $participant->getParticipantLastname();
        $parameters["user"]["username"] = $participant->getParticipantUsername();
        $parameters["user"]["last_access"] = $participant->getParticipantLastTouchDatetime();
        if($participant->getFacebookId())
            $parameters["user"]["avatar"] = "http://graph.facebook.com/" . $participant->getParticipantUsername() . "/picture?width=80&height=82";
    
        $collectionConstraint = new Collection(array(
                'participantFirstname'     =>  new NotBlank(),
                'participantLastname'        => new NotBlank(),
                'participantAddress1'      => new NotBlank(),
                'participantZipcode' => new NotBlank(),
                'city'     => new NotBlank(),
                'state'    => new NotBlank()
        ));
        $form = $this->createForm(new MailingAddressForm($this->container), array('constraints' => $collectionConstraint));
    
        if ($participant->getParticipantFirstname()){
            $form->get('participantFirstname')->setData($participant->getParticipantFirstname());
        }
        if ($participant->getParticipantLastname()){
            $form->get('participantLastname')->setData($participant->getParticipantLastname());
        }
        if ($participant->getParticipantAddress1()){
            $form->get('participantAddress1')->setData($participant->getParticipantAddress1());
        }
        if ($participant->getParticipantAddress2()){
            $form->get('participantAddress2')->setData($participant->getParticipantAddress2());
        }
        if ($participant->getParticipantZipcode()){
            $form->get('participantZipcode')->setData($participant->getParticipantZipcode());
        }
        if ($participant->getCity()){
            $city = $participant->getCity();
            $form->get('city')->setData($city->getCityName());
            $form->get('cityId')->setData($city->getCityId());
        }
        if ($participant->getState()){
            $state = $participant->getState();
            $form->get('state')->setData($state->getStateCode());
            $form->get('stateId')->setData($state->getstateId());
        }
        $sign = $participant->getParticipantDeliverySign();
        if (isset($sign)){
            if ($sign == true) {
                $form['sign']->setData('sign');
            }else{
                $form['sign']->setData('notSign');
            }
        }
    
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
    
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
                 return $this->redirect($this->generateUrl("_shipping",
                                array('update' => true)));
 
            }
        }
        
        $parameters['form'] = $form->createView();
    
        return $this->render('CyclogramFrontendBundle:GeneralSettings:shipping_information.html.twig', $parameters);
    }

}
