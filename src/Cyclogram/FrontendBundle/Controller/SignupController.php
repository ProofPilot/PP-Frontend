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

    /**
     * @Route("/signup/{studyCode}", name="_signup", defaults={"studyCode"= null})
     * @Template()
     */
    public function signupStartAction(Request $request, $studyCode=null)
    {

        $session = $request->getSession();
    
        $em = $this->getDoctrine()->getManager();

        if ($request->isXmlHttpRequest()) {
            $form = $this->createForm(new RegistrationForm($this->container));
            
            if(!empty($studyCode))
                $study = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
            
                $form->handleRequest($request);
                if ($form->isValid()) {
                    $registration = $form->getData();
                        //if participant is unfinished record, try to get it
//                         $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')
//                         ->getUnfinishedParticipant($registration->getParticipantUsername(), $registration->getParticipantEmail());
        
//                         if(!$participant){
//                             $participant = new Participant();
//                         }
                        $participant = new Participant();
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
                        $session->set("participantId", $participant->getParticipantId());
                        $roles = array("ROLE_USER", "ROLE_PARTICIPANT");
            
                        $token = new UsernamePasswordToken($participant, null, 'main', $roles);
                        $this->get('security.context')->setToken($token);
                        
                        return new Response(json_encode(array('error' => false)));
                } else {
                    $messages = array();
                    $validator = $this->container->get('validator');
                    $errors = $validator->validate($form);
                    foreach ($errors as $err) {
                        if(strpos($err->getPropertyPath(),'[')) {
                            if ($err->getMessage() == "Passwords do not match") {
                                $property = substr($err->getPropertyPath(),strpos($err->getPropertyPath(),'[')+1,strlen($err->getPropertyPath()));
                                $messages[]= array('property' => substr($property,0,strlen($property)-1),
                                                    'message' => $err->getMessage(),
                                                    'password' => true);
                            } else {
                                $property = substr($err->getPropertyPath(),strpos($err->getPropertyPath(),'[')+1,strlen($err->getPropertyPath()));
                                $property = substr($property,0,strpos($property,'.')-1);
                                if ($property == "participantPassword" ) {
                                    $messages[]= array('property' => $property,
                                            'message' => $err->getMessage(),
                                            'password' => true);
                                } else {
                                    $messages[]= array('property' => $property ,
                                            'message' => $err->getMessage(),
                                            'password' => false);
                                }
                            }
                        }
                        elseif(strpos($err->getPropertyPath(),'.')){
                            $messages[]= array('property' => substr($err->getPropertyPath(),strpos($err->getPropertyPath(),'.')+1,strlen($err->getPropertyPath())),
                                    'message' => $err->getMessage(),
                                    'password' => false);
                        }
                    }
                    return new Response(json_encode(array('error' => true, 'messages' => $messages)));
    
            }
        }
    }
    
    /**
     * @Route("/signupabout/{studyCode}", name="_signup_about", defaults={"studyCode"= null})
     * @Template()
     */
    public function signupAboutAction(Request $request, $studyCode=null) {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
//         $id = $session->get('participantId');
        $participant = $this->get('security.context')->getToken()->getUser();
        if (empty($participant)) {
            return $this->render("::error.html.twig", array(
                    "error"=>"Wrong participant id"));
        }
        if ($request->isXmlHttpRequest()) {
            $form = $this->createForm(new SignUpAboutForm($this->container));
            $form->handleRequest($request);
            if ($form->isValid()) {
                $data = $form->getData();
                $participant->setCountry($data['countrySelect']);
                $participant->setRace($data['raceSelect']);
                $participant->setSex($data['sexSelect']);
                $em->persist($participant);
                $em->flush();
                return new Response(json_encode(array('error' => false)));
            } else {
                $validator = $this->container->get('validator');
                $errors = $validator->validate($form);
                foreach ($errors as $err) {
                    $msg[]= $err->getMessage();
                }
                return new Response(json_encode(array('error' => true, 'message' => $msg)));
            }
        }
        
        
        
    }
    
    /**
     * @Route("/signupconsent/{id}/{studyCode}", name="_signup_consent", defaults={"studyCode"= null})
     * @Check(name="checkParticipant")
     * @Template()
     */
    public function signupConsentAction($id,$studyCode=null) {
        return $this->render('CyclogramStudyBundle:Signup:signup_consent.html.twig');
    }

}
