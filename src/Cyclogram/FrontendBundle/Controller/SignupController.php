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

use Cyclogram\FrontendBundle\Form\SignUpAboutForm;

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
use Symfony\Component\Security\Core\SecurityContext;

class SignupController extends Controller
{
    
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
     * @Route("/signup/{studyCode}", name="_signup", defaults={"studyCode"= null})
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
                        return $this->redirect( $this->generateUrl("_signup_about", array('id' => $participant->getParticipantId(), 'studyCode' => $studyCode)));
                    } else {
                        return $this->redirect( $this->generateUrl("_signup_about", array('id' => $participant->getParticipantId())) );
                    }
    
                } catch (Exception $ex) {
                    $em->close();
                }
            } else {
                $validator = $this->container->get('validator');
                $errors = $validator->validate($form);
                foreach ($errors as $err) {
                    $msg[]= $err->getMessage();
                }

            return $this->redirect( $this->generateUrl("_page", array('studyUrl' => $studyCode, 'error_messages' => $msg)));
        }
    
        }

        return $this->render('CyclogramFrontendBundle:Signup:signup.html.twig',
                array (
                        'form' => $form->createView(),
                        'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                        ));
    
    }
    
    /**
     * @Route("/signupabout/{id}/{studyCode}", name="_signup_about", defaults={"studyCode"= null})
     * @Check(name="checkParticipant")
     * @Template()
     */
    public function signupAboutAction($id,$studyCode=null) {
        $parameters = array();
        
        $em = $this->getDoctrine()->getManager();
        
        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->find($id);
        if (empty($participant)) {
            return $this->render("::error.html.twig", array(
                    "error"=>"Wrong participant id"));
        }
        
        $form = $this->createForm(new SignUpAboutForm($this->container));
        
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $data = $form->getData();
                $participant->setCountry($data['countrySelect']);
                $participant->setRace($data['raceSelect']);
                $participant->setSex($data['sexSelect']);
                $em->persist($participant);
                $em->flush();
                return $this->redirect( $this->generateUrl("_signup_consent", array('id' => $participant->getParticipantId(), 'studyCode' => $studyCode)));
//                 $sex = $em->getRepository('CyclogramProofPilotBundle:Sex')->findOneBySexName($data['sexSelect']);
//                 $race = $em->getRepository('CyclogramProofPilotBundle:Race')->findOneByRaceName($data['raceSelect']);
//                 $country = $em->getRepository('CyclogramProofPilotBundle:Country')->findOneByCountryName($data['countrySelect']);
            }
        }
        
        return $this->render('CyclogramFrontendBundle:Signup:signup_about.html.twig'
                , array('form' => $form->createView(),'id' => $id)
                );
        
        
    }
    
    /**
     * @Route("/signupconsent/{id}/{studyCode}", name="_signup_consent", defaults={"studyCode"= null})
     * @Check(name="checkParticipant")
     * @Template()
     */
    public function signupConsentAction($id,$studyCode=null) {
    
    }

}
