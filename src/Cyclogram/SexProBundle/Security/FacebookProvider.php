<?php

namespace Cyclogram\SexProBundle\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use \BaseFacebook;
use \FacebookApiException;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;

class FacebookProvider implements UserProviderInterface
{
    /**
     * @var \Facebook
     */
    protected $facebook;
    protected $userManager;
    protected $validator;
    protected $container;

    public function __construct(BaseFacebook $facebook, $userManager, $validator, Container $container)
    {
        $this->facebook = $facebook;
        $this->userManager = $userManager;
        $this->validator = $validator;
        $this->container = $container;
    }

    public function supportsClass($class)
    {
//         return $this->userManager->supportsClass($class);
    }

    private function findUserByFbId($fbId)
    {
        return $this->userManager->getRepository("CyclogramProofPilotBundle:Participant")->findOneBy(array('facebookId' => $fbId));
    }
    
    private function findUserByEmail($email)
    {
        return $this->userManager->getRepository("CyclogramProofPilotBundle:Participant")->findOneBy(array('participantEmail' => $email));
    }

    public function loadUserByUsername($fbId)
    {
        $participant = $this->findUserByFbId($fbId);
        $referer = array();
        $request = $this->container->get('request');
        $url = $request->headers->get('referer');
        $referer = parse_url($url);

        try {
            $fbdata = $this->facebook->api('/me');
        } catch (FacebookApiException $e) {
            $fbdata = null;
            throw new UsernameNotFoundException('Facebook API not working');//TOFO
        }

        if(empty($fbdata))
            throw new UsernameNotFoundException('Facebook API not working');//TOFO
        
        if (!empty($participant)){
            $participant->setRoles(array('FACEBOOK_REGISTERED'));
        
            $participant->setFBData($fbdata);
        
            $this->userManager->persist($participant);
            $this->userManager->flush();
            
            return $participant;
        }

        if (empty($participant) && $referer['path'] == '/register') {
            //if we did not find a user by Facebbok id, we assume he does not exist or is not registered as Facebbok user;
            
            $participant = $this->findUserByEmail($fbdata["email"]);
            if(!$participant)
                $participant = new Participant();

            $participant->setRoles(array('FACEBOOK_REGISTRATION_PROCESS'));

            $question = $this->userManager->getRepository('CyclogramProofPilotBundle:RecoveryQuestion')->find(1);
            $participant->setRecoveryQuestion($question);
            $participant->setRecoveryPasswordCode('Default');
            $participant->setParticipantEmailConfirmed(true);
            if(!$participant->getParticipantMobileNumber())
                $participant->setParticipantMobileNumber('');
            if(!$participant->getParticipantPassword())
                $participant->setParticipantPassword('');
            
            $participant->setParticipantMobileSmsCodeConfirmed(true);
            $participant->setParticipantIncentiveBalance(false);
            $date = new \DateTime();
            $participant->setParticipantLastTouchDatetime($date);
            $participant->setParticipantZipcode('');
            $country = $this->userManager->getRepository('CyclogramProofPilotBundle:Country')->find(1);
            $participant->setCountry($country);
            $state = $this->userManager->getRepository('CyclogramProofPilotBundle:State')->find(35);
            $participant->setState($state);
            $city = $this->userManager->getRepository('CyclogramProofPilotBundle:City')->find(25420);
            $participant->setCity($city);
            $sex = $this->userManager->getRepository('CyclogramProofPilotBundle:Sex')->find(1);
            $participant->setSex($sex);
            $race = $this->userManager->getRepository('CyclogramProofPilotBundle:Race')->find(1);
            $participant->setRace($race);
            $role = $this->userManager->getRepository('CyclogramProofPilotBundle:ParticipantRole')->find(1);
            $participant->setParticipantRole($role);
            $status = $this->userManager->getRepository('CyclogramProofPilotBundle:Status')->find(1);
            $participant->setStatus($status);
            $participant->setFBData($fbdata);
            
            $this->userManager->persist($participant);
            $this->userManager->flush();
            
            return $participant;
        }
            
        if (empty($participant) && $referer['path'] == '/login') {
            $participant = new Participant();
            $participant->setRoles(array('FACEBOOK_NOT_REGISTERED'));
            return $participant;
        }

        if (count($this->validator->validate($participant, 'Facebook'))) {
            // TODO: the user was found obviously, but doesnt match our expectations, do something smart
            throw new UsernameNotFoundException('The facebook user could not be stored');
        }

        if (empty($participant)) {
            throw new UsernameNotFoundException('The user is not authenticated on facebook');
        }

        return $participant;
    }

    public function refreshUser(UserInterface $participant)
    {
        if (!$this->supportsClass(get_class($participant)) || !$participant->getFacebookId()) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($participant)));
        }

        return $this->loadUserByUsername($participant->getFacebookId());
    }
}
