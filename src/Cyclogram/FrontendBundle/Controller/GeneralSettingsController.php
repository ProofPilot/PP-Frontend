<?php

namespace Cyclogram\FrontendBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cyclogram\FrontendBundle\Form\GeneralSettingForm;
use Cyclogram\CyclogramCommon;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;

/**
 * @Route("/main")
 */
class GeneralSettingsController  extends Controller
{
    /**
     * @Route("/general_settings", name="_settings")
     * @Template()
     */
    public function generalSettingsAction()
    {
        $participant = $this->get('security.context')->getToken()->getUser();
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $surveyscount = $em->getRepository('CyclogramProofPilotBundle:Participant')->getParticipantInterventions($participant);
        
        $parameters["lastaccess"] = new \DateTime();
        $parameters["invalidFormClass"] = '';
         
        if(!$participant->getFacebookId())
            $parameters["user"]["avatar"] = "/images/tmp_avatar.jpg";
        else
            $parameters["user"]["avatar"] = "http://graph.facebook.com/" . $participant->getParticipantUsername() . "/picture?width=80&height=82";
        
        $parameters["user"]["name"] = $participant->getParticipantUserName();
        $parameters["user"]["last_access"] = $participant->getParticipantLastTouchDatetime();
        $parameters["user"]["phone"] = $participant->getParticipantMobileNumber();
        
        $form = $this->createForm(new GeneralSettingForm($this->container));
        
        if ($participant->getParticipantUserName()){
            $form->get('userName')->setData($participant->getParticipantUserName());
        }
        if ($participant->getParticipantEmail()){
            $form->get('email')->setData($participant->getParticipantEmail());
        }
        if ($participant->getParticipantEmail()){
            $form->get('phoneNumber')->setData($participant->getParticipantMobileNumber());
        }
        
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $data = $form->getData();
                if ($data['validationCheck'] == 'username') {
                    $participant->setParticipantUsername($data['newUserName']);
                    $em->persist($participant);
                    $em->flush();
                    $parameters['message'] = "Your username has been changed";
                }
                if ($data['validationCheck'] == 'password-sms') {
                    $participantSMSCode = CyclogramCommon::getAutoGeneratedCode(4);
                    $participant->setParticipantMobileSmsCode($participantSMSCode);
                    $sms = $this->get('sms');
                    $sentSms = $sms->sendSmsAction( array('message' => "Your SMS Verification code is $participantSMSCode", 'phoneNumber'=>$participant->getParticipantMobileNumber()) );
                    if($sentSms) {
                        $session = $request->getSession();
                        $session->set('newPassword', $data['newPassword']);
                        $em->persist($participant);
                        $em->flush($participant);
                    }
                }
                if ($data['validationCheck'] == 'password') {
                    $session = $request->getSession();
                    if ($session->has('newPassword')) {
                        $participant->setParticipantPassword($session->get('newPassword'));
                        $em->persist($participant);
                        $em->flush($participant);
                        $session->invalidate();
                        $parameters['message'] = "Your password has been changed";
                    }
                }
                if ($data['validationCheck'] == 'email') {
                    $participant->setParticipantEmail($data['newEmail']);
                    $em->persist($participant);
                    $em->flush($participant);
                    $parameters['message'] = "Your email has been changed";
                }
                if ($data['validationCheck'] == 'mobile-sms') {
                    $participantSMSCode = CyclogramCommon::getAutoGeneratedCode(4);
                    $participant->setParticipantMobileSmsCode($participantSMSCode);
                    $sms = $this->get('sms');
                    $sentSms = $sms->sendSmsAction( array('message' => "Your SMS Verification code is $participantSMSCode", 'phoneNumber'=> $data['newPhoneNumber']) );
                    if($sentSms) {
                        $session = $request->getSession();
                        $session->set('newPhoneNumber', $data['newPhoneNumber']);
                        $em->persist($participant);
                        $em->flush($participant);
                    }
                }
                if ($data['validationCheck'] == 'mobile') {
                    $session = $request->getSession();
                    if ($session->has('newPhoneNumber')) {
                        $participant->setParticipantMobileNumber($session->get('newPhoneNumber'));
                        $em->persist($participant);
                        $em->flush($participant);
                        $session->invalidate();
                        $parameters['message'] = "Your mobile numder has been changed";
                    }
                }
                $parameters['form'] = $form->createView();
                return $this->render('CyclogramFrontendBundle:GeneralSettings:general_settings.html.twig', $parameters);
            } 
            else {
                $data = $form->getData();
                $parameters["invalidFormClass"] = $data['validationCheck'];
            }
            return $this->render('CyclogramFrontendBundle:GeneralSettings:general_settings.html.twig', $parameters);
        }
        
        $parameters['form'] = $form->createView();
            
        return $this->render('CyclogramFrontendBundle:GeneralSettings:general_settings.html.twig', $parameters);
    }
    
    /**
     * @Route("/contact_prefs", name="_contact_prefs")
     * @Template()
     */
    public function contactPrefsAction()
    {
        $parameters = array();
        
        $parameters['preferences'] = array(
                array('title' => 'Study Task Reminder Preferences',
                      'subtitle' => 'The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters',
                      'col' => 'col_5',
                      'dontremind' => '',
                      'options' => array(
                        array('row' => 'Remind me to take surveys by'),
                        array('row' => 'Communicate with me about ORDERS by'),
                        array('row' => 'Remind me to participate in STUDY DIRECTORY by'),
                        array('row' => 'Remind me to take TREATMENTS by'),
                        array('row' => 'Remind me about APPOINTMENTS by'),
                        array('row' => 'Remind me to take MEASUREMENTS by'),
                        array('row' => 'Communicate with me about INCENTIVES by'),
                        array('personal' => '',
                              'row' => 'Communicate with me about personal issues'
                              ),
                        array('row' => 'Study News'),
                        array('row' => 'Other studies I might be eliglble for')
                      )
                ),
                array('title' => 'What day of the week suits you best?',
                      'subtitle' => 'The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters',
                      'col' => 'col_4',
                      'timezone' => '',
                      'options' => array(
                        array('row' => 'Early AM (6AM-8AM)'),
                        array('row' => 'Morning (8AM-Noon)'),
                        array('row' => 'Lunchtime (Noon-2PM)'),
                        array('row' => 'Afternoon (1PM-5PM)'),
                        array('row' => 'Early Evening (5PM-7PM)'),
                        array('row' => 'Evening (7PM-9PM)'),
                        array('row' => 'Night (9PM-Midnight)'),
                        array('row' => 'Late Night (midnight-6AM)')
                      )
                ),
                array('title' => 'Study Task Reminder Preferences',
                      'subtitle' => 'The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters',
                      'col' => 'col_4',
                      'options' => array(
                        array('row' => 'Sunday'),
                        array('row' => 'Monday'),
                        array('row' => 'Tuesday'),
                        array('row' => 'Wednesday'),
                        array('row' => 'Thursday'),
                        array('row' => 'Friday'),
                        array('row' => 'Saturday'),
                        array('row' => 'Sunday')
                      )
                )
        );
        
        $participant = $this->get('security.context')->getToken()->getUser();
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $surveyscount = $em->getRepository('CyclogramProofPilotBundle:Participant')->getParticipantInterventions($participant);
        
        $parameters["lastaccess"] = new \DateTime();
         
        if(!$participant->getFacebookId())
            $parameters["user"]["avatar"] = "/images/tmp_avatar.jpg";
        else
            $parameters["user"]["avatar"] = "http://graph.facebook.com/" . $participant->getParticipantUsername() . "/picture?width=80&height=82";
        
        $parameters["user"]["name"] = $participant->getParticipantFirstname() . ' ' . $participant->getParticipantLastname();
        $parameters["user"]["last_access"] = $participant->getParticipantLastTouchDatetime();
        
        return $this->render('CyclogramFrontendBundle:GeneralSettings:contact_prefs.html.twig', $parameters);
    }
}
