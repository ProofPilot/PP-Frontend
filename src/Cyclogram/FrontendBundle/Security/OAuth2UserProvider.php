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
namespace Cyclogram\FrontendBundle\Security;
use Cyclogram\FrontendBundle\Exception\IncompleteUserException;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;
use Symfony\Component\DependencyInjection\Container;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;
use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantContactTimeLink;
use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantStudyReminderLink;


class OAuth2UserProvider implements OAuthAwareUserProviderInterface
{

    protected $userManager;
    protected $validator;
    protected $container;
    
    public function __construct($userManager, $validator, Container $container)
    {
        $this->userManager = $userManager;
        $this->validator = $validator;
        $this->container = $container;
    }
    
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $session = $this->container->get('session');
        $resourceOwnerName = $response->getResourceOwner()->getName();
        
        $data = $response->getResponse();
        $email = $response->getEmail();
        
        //find user in database using email
        $participant = $this->userManager->getRepository("CyclogramProofPilotBundle:Participant")->findOneBy(array('participantEmail' => $email));
        $request = $this->container->get('request');
        //if participant does not existr and it was registration
        if (empty($participant)) {
            $studyCode = $request->query->get('state');
            if (!empty($studyCode)) {
                $study = $this->userManager->getRepository("CyclogramProofPilotBundle:Study")->findOneByStudyCode($studyCode);
                $studyStatus = $this->userManager->getRepository('CyclogramProofPilotBundle:Status')->find($study->getStatus());

                if($studyStatus->getStatusName() == 'Pre-Launch') {
                    $participant = new Participant();
                    $participant->setParticipantEmail($email);
                    $participant->setParticipantPassword(' ');
                    $question = $this->userManager->getRepository('CyclogramProofPilotBundle:RecoveryQuestion')->find(1);
                    $participant->setRecoveryQuestion($question);
                    $participant->setRecoveryPasswordCode('Default');
                    $participnat_level = $this->userManager->getRepository('CyclogramProofPilotBundle:ParticipantLevel')->findOneByParticipantLevelName('Lead');
                    $participant->setLevel($participnat_level);
                    $mailCode = substr(md5( md5( $participant->getParticipantEmail() . md5(microtime()))), 0, 4);
                    $participant->setParticipantEmailCode($mailCode);
                    $participant->setParticipantEmailConfirmed(false);
                    $participant->setParticipantMobileSmsCodeConfirmed(false);
                    $participant->setParticipantIncentiveBalance(0);
                    $timezone = $this->userManager->getRepository('CyclogramProofPilotBundle:ParticipantTimeZone')->find(1);
                    $participant->setParticipantTimezone($timezone);
                    $participant->setParticipantLastTouchDatetime(new \DateTime(null, new \DateTimeZone($participant->getParticipantTimezone()->getParticipantTimezoneName())));
                    $participant->setParticipantZipcode(' ');
                    $role = $this->userManager->getRepository('CyclogramProofPilotBundle:ParticipantRole')->find(1);
                    $participant->setParticipantRole($role);
                    $participant->setStatus(Participant::STATUS_ACTIVE);
                    $participant->setLocale($request->getLocale());
                    $language = $this->userManager->getRepository('CyclogramProofPilotBundle:Language')->findOneByLocale($request->getLocale());
                    $participant->setParticipantLanguage($language);
                    switch($resourceOwnerName) {
                        case "facebook":
                            $participant->setRoles(array("ROLE_FACEBOOK_USER","ROLE_PARTICIPANT" ));
                            break;
                        case "google":
                            $participant->setRoles(array("ROLE_GOOGLE_USER","ROLE_PARTICIPANT"));
                            break;
                    }
                    $participant->setParticipantBasicInformation(false);
                    $this->userManager->persist( $participant);
                    $this->userManager->flush();
                    $session->set('preLaunch', $this->container->get('translator')->trans("we_will_notify_prelaunch", array(), "study"));
                    return $participant;
                }
            }
            $participant = new Participant();
            $participnat_level = $this->userManager->getRepository('CyclogramProofPilotBundle:ParticipantLevel')->findOneByParticipantLevelName('Lead');
            $participant->setLevel($participnat_level);
            $request = $this->container->get('request');
            $question = $this->userManager->getRepository('CyclogramProofPilotBundle:RecoveryQuestion')->find(1);
            $participant->setRecoveryQuestion($question);
            $participant->setParticipantAppreciationEmail($email);
            $participant->setRecoveryPasswordCode('Default');
            $participant->setParticipantEmailConfirmed(false);
            if(!$participant->getParticipantPassword())
                $participant->setParticipantPassword('');
            $participant->setParticipantBasicInformation(false);
            $participant->setParticipantMobileSmsCodeConfirmed(false);
            $participant->setParticipantIncentiveBalance(false);
            $date = new \DateTime();
            $participant->setParticipantLastTouchDatetime($date);
            $participant->setParticipantRegistrationTime($date);
            $mailCode = substr(md5( md5( $participant->getParticipantEmail() . md5(microtime()))), 0, 4);
            $participant->setParticipantEmailCode($mailCode);
            $participant->setParticipantZipcode('');
            $participant->setLocale($request->getLocale());
            $language = $this->userManager->getRepository('CyclogramProofPilotBundle:Language')->findOneByLocale($request->getLocale());
            $participant->setParticipantLanguage($language);
            $timezone = $this->userManager->getRepository('CyclogramProofPilotBundle:ParticipantTimeZone')->find(1);
            $participant->setParticipantTimezone($timezone);
            $role = $this->userManager->getRepository('CyclogramProofPilotBundle:ParticipantRole')->find(1);
            $participant->setParticipantRole($role);
            $participant->setStatus(Participant::STATUS_ACTIVE);

            switch($resourceOwnerName) {
                case "facebook":
                    $participant->setParticipantFirstname($data["first_name"]);
                    $participant->setParticipantLastname($data["last_name"]);
                    $participant->setParticipantEmail($data["email"]);
                    $participant->setParticipantAppreciationEmail($data["email"]);
                    if (isset($data['gender'])) {
                        $sex = $this->userManager->getRepository('CyclogramProofPilotBundle:Sex')->findOneBySexName(ucfirst($data['gender']));
                        $participant->setSex($sex);
                    }
                    $participant->setFacebookId($data["id"]);
                    break;
                case "google":
                    $participant->setParticipantFirstname($data["given_name"]);
                    $participant->setParticipantLastname($data["family_name"]);
                    $participant->setParticipantEmail($data["email"]);
                    $participant->setParticipantAppreciationEmail($data["email"]);
                    if (isset($data['gender'])) {
                        $sex = $this->userManager->getRepository('CyclogramProofPilotBundle:Sex')->findOneBySexName(ucfirst($data['gender']));
                        $participant->setSex($sex);
                    }
                    $participant->setGoogleId($data["id"]);
            }
            switch($resourceOwnerName) {
                case "facebook":
                    $participant->setRoles(array("ROLE_FACEBOOK_USER","ROLE_PARTICIPANT" ));
                    break;
                case "google":
                    $participant->setRoles(array("ROLE_GOOGLE_USER","ROLE_PARTICIPANT"));
                    break;
            }
            if ($participant->getParticipantEmailConfirmed() == false){
                $session->set('confirmation', false);
            }
            
            $this->userManager->persist($participant);
            $this->userManager->flush($participant);
            
            //default contact time to SAT morning
            	$em = $this->userManager;
		        $contactTime = $em->getRepository('CyclogramProofPilotBundle:ParticipantContactTime')
		        										->findOneByparticipantContactTimesName("time_morning");
		        $em->getRepository('CyclogramProofPilotBundle:ParticipantContactTimeLink')
		        						->updateParticipantContactTimeLink($participant, $contactTime, '6', true, true);
		        $psr = $em->getRepository('CyclogramProofPilotBundle:ParticipantStudyReminder')
		        						->findOneByparticipantStudyReminderName("reminder_study_task");
		        $psrl = new ParticipantStudyReminderLink();
		        $psrl->setParticipantStudyReminder($psr);
		        $psrl->setParticipant($participant);
		        $psrl->setByEmail(true);
		        $em->persist($psrl);
		        $em->flush($psrl);
	        //END
            
            return $participant;
        } else {
            switch($resourceOwnerName) {
                case "facebook":
                    $participant->setRoles(array("ROLE_FACEBOOK_USER","ROLE_PARTICIPANT" ));
                    break;
                case "google":
                   $participant->setRoles(array("ROLE_GOOGLE_USER","ROLE_PARTICIPANT"));
                    break;
            }
            //if participant present, handle in another way
            $date = new \DateTime();
            $participant->setParticipantLastTouchDatetime($date);
            $this->userManager->persist($participant);
            $this->userManager->flush();
            $studyCode = $request->query->get('state');
            if (!empty($studyCode)) {
                $study = $this->userManager->getRepository("CyclogramProofPilotBundle:Study")->findOneByStudyCode($studyCode);
                $studyStatus = $this->userManager->getRepository('CyclogramProofPilotBundle:Status')->find($study->getStatus());
                if($studyStatus->getStatusName() == 'Pre-Launch') {
                    $session->set('preLaunch', $this->container->get('translator')->trans("login_to_prelaunch", array(), "study"));
                } else {
                    $logic = $this->container->get('study_logic');
                    
                    if ($session->has('SurveyInfo')){
                        $bag = $session->get('SurveyInfo');
                        $surveyId = $bag->get('surveyId');
                        $saveId = $bag->get('saveId');
                        if($studyCode != $bag->get('studyCode'))
                            $logic->studyRegistration($participant, $studyCode, $surveyId, $saveId);
                    }
                }
            }
            return $participant;
        }
    }
}
