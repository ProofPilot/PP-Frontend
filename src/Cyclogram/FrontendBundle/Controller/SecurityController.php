<?php

namespace Cyclogram\FrontendBundle\Controller;

use Symfony\Component\HttpFoundation\Session\Session;

use Cyclogram\CyclogramCommon;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Routing\Router;
use Cyclogram\FrontendBundle\Form\MobilePhoneForm;


class SecurityController extends Controller
{
    /**
     * @Route("/forgot_pass/{studyId}", name="_forgot_pass")
     * @Template()
     */
    public function forgotPassAction($studyId=null)
    {
        if ($this->get('security.context')->isGranted("ROLE_USER")){
            return $this->redirect($this->generateURL("_main"));
        }
        $request = $this->getRequest();
        
        $form = $this->createFormBuilder()
        ->add('participantUsername', 'text', array('label'=>'username'))
        ->getForm();

        $em = $this->getDoctrine()->getManager();
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
        $nPic = rand ( 1, 4 );
        
        if( $request->getMethod() == "POST" ){
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            if( $form->isValid() ) {
                
                $values = $request->request->get('form');
                $username = $values['participantUsername'];
                $participant = $em->getRepository("CyclogramProofPilotBundle:Participant")->findOneByParticipantUsername($username);
                
                if (!empty($participant)) {
                    $parameters['id'] = $participant->getParticipantId();
                    $parameters['studyId'] = $studyId;
                    $embedded['logo_top'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newsletter_logo.png");
                    $embedded['logo_footer'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newletter_logo_footer.png");
                    $embedded['login_button'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newsletter_small_login.jpg");
                    $cc = $this->get('cyclogram.common');
                    $cc->sendMail($participant->getParticipantEmail(),
                                             'Reset Your Password',
                                              'CyclogramFrontendBundle:Email:reset_password_email.html.twig', 
                                              null,
                                              $embedded,
                                              true,
                                              $parameters);

                    return $this->render('CyclogramFrontendBundle:Security:reset_password_confirmation.html.twig', array("studyId"=>$studyId, "studyLogo"=>$studyLogo, "nPic"=>$nPic));
                } else {
                    return $this->render('CyclogramFrontendBundle:Security:forgot_your_password.html.twig' , array("form" => $form->createView(), 
                            "error" => $this->get('translator')->trans("doesnt_match_records", array(), "login"), "studyId"=>$studyId, "studyLogo"=>$studyLogo, "nPic"=>$nPic));
                }
            }
        }
        return $this->render('CyclogramFrontendBundle:Security:forgot_your_password.html.twig' , array("form" => $form->createView(), "studyId"=>$studyId, "studyLogo"=>$studyLogo, "nPic"=>$nPic));
    }
    
    /**
     * @Route("/create_pass/{id}/{studyId}" , name="_create_new_pass")
     * @Template()
     */
    public function createPassAction($id, $studyId=null)
    {
        $request = $this->getRequest();
        $session = $this->getRequest()->getSession();
        
        $collectionConstraint = new Collection(array(
                'fields' => array(
                        'participantPassword' => new Length(array('min' => 8))
                )
        ));
        $form = $this->createFormBuilder(null, array('constraints' => $collectionConstraint))
        ->add('participantPassword', 'repeated',                   
                        array('type' => 'password', 
                            'invalid_message' => 'The password fields must match.',
                      ))     
        ->getForm();

        $em = $this->getDoctrine()->getManager();
        $study = null;
        $studyLogo = "";
        $nPic = "";
        if ($studyId != null) {
            if($studyId==1){
                $nPic = rand ( 1, 4 );
            }
            $study = $em->getRepository('CyclogramProofPilotBundle:Study')->find($studyId);
            $studyContent = $em->getRepository('CyclogramProofPilotBundle:StudyContent')->findOneBy(array('studyId'=>$studyId));
            $studyLogo = $studyContent->getStudyLogo();
            $studyLogo = "http://admin.dev1.proofpilot.net/2cd1c6ecec2c6d908b3ed66d4ea7b902/".$studyId."/".$studyLogo;
        } else {
            $study = null;
        }

        if( $request->getMethod() == "POST" ){
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            if( $form->isValid() ) {
                $participant = $em->getRepository("CyclogramProofPilotBundle:Participant")->find($id);
                $values = $request->request->get('form');
                if (!empty($participant)) {
                    $participantSMSCode = CyclogramCommon::getAutoGeneratedCode(4);
                    $participant->setParticipantMobileSmsCode($participantSMSCode);                 
                    $em->persist($participant);
                    $em->flush($participant);
                    
                    $sms = $this->get('sms');
                    $sentSms = $sms->sendSmsAction( array('message' => "Your SMS Verification code is $participantSMSCode", 'phoneNumber'=> $participant->getParticipantMobileNumber()) );
                    if($sentSms){

                        $session->set('password' ,$values['participantPassword']['first']);
                        return $this->redirect( $this->generateUrl('_confirm_pass_reset', array('id' => $id)));
                    }
                }
            } 
       }
        return $this->render('CyclogramFrontendBundle:Security:create_new_password.html.twig', array("form" => $form->createView(), 'id' => $id, "studyId"=>$studyId, "studyLogo"=>$studyLogo, "nPic"=>$nPic));
    }
    
    /**
     * @Route("/confirm_reset/{id}", name="_confirm_pass_reset")
     * @Template()
     */
    public function confirmResetAction($id)
    {
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
                $value = $request->request->get('form');
                $em = $this->getDoctrine()->getManager();
                $participant = $em->getRepository("CyclogramProofPilotBundle:Participant")->find($id);
                if (!empty($participant)){
                    $smscode = $participant->getParticipantMobileSmsCode();
                    if ($value['sms_code'] == $smscode) {
                        $session = $this->getRequest()->getSession();
                        $participant->setParticipantPassword($session->get('password'));
                        
                        $em->persist($participant);
                        $em->flush($participant);
                        $session->invalidate();
                        
                        return $this->render('CyclogramFrontendBundle:Security:password_changed.html.twig');
                    } else {
                        $session->invalidate();
                        $error = "Wrong SMS!";
                    }
                }
            }
        }
        
        return $this->render('CyclogramFrontendBundle:Security:confirm_reset.html.twig', array('error' => $error, 'form' => $form->createView(), 'id' => $id));
    }
    
    /**
     * @Route("/forgot_username/{studyId}", name="_forgot_username")
     * @Template()
     */
    public function forgotUserAction($studyId=null)
    {
        if ($this->get('security.context')->isGranted("ROLE_USER")){
            return $this->redirect($this->generateURL("_main"));
        }
        $request = $this->getRequest();
        
        $form = $this->createForm(new MobilePhoneForm($this->container));

        $em = $this->getDoctrine()->getManager();
        $study = null;
        $studyLogo = "";
        $nPic = "";
        if ($studyId != null) {
            $study = $em->getRepository('CyclogramProofPilotBundle:Study')->find($studyId);
            $studyContent = $em->getRepository('CyclogramProofPilotBundle:StudyContent')->findOneBy(array('studyId'=>$studyId));
            $studyLogo = $studyContent->getStudyLogo();
            //JP: Need to fi this
            $studyLogo = "http://admin.dev1.proofpilot.net/2cd1c6ecec2c6d908b3ed66d4ea7b902/".$studyId."/".$studyLogo;
            if( $studyId == 1 ){
                $nPic = rand ( 1, 4 );
            }
        } else {
            $study = null;
        }
        
        if( $request->getMethod() == "POST" ){
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            if( $form->isValid() ) {
                 $values = $form->getData();
                $userSms = $values['phone_small'].$values['phone_wide'];
                $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->findOneByParticipantMobileNumber($userSms);
                if ($participant) {
                    
                    $participantEmail = $participant->getParticipantEmail();
                    $participantUsername = $participant->getParticipantUsername();
                    
                    $sms = $this->get('sms');
                    $sentSms = $sms->sendSmsAction( array('message' => "Your username is $participantUsername , your email is $participantEmail", 'phoneNumber'=>$participant->getParticipantMobileNumber()) );
                    if($sentSms)
                        return $this->render('CyclogramFrontendBundle:Security:username_sent.html.twig', array("studyId"=>$studyId, "studyLogo"=>$studyLogo, "nPic"=>$nPic));
                } else {
                    return $this->render('CyclogramFrontendBundle:Security:forgot_username.html.twig',array('form' => $form->createView(),"error" => $this->get('translator')->trans("doesnt_match_records", array(), "login"), "studyId"=>$studyId, "studyLogo"=>$studyLogo, "nPic"=>$nPic));
                }
            }
        }
        return $this->render('CyclogramFrontendBundle:Security:forgot_username.html.twig',array('form' => $form->createView(), "studyId"=>$studyId, "studyLogo"=>$studyLogo, "nPic"=>$nPic));
    }
}
