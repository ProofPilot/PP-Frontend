<?php
namespace Cyclogram\FrontendBundle\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;
use Symfony\Component\DependencyInjection\Container;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;


class OAuth2Provider implements OAuthAwareUserProviderInterface,
        UserProviderInterface
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
        $resourceOwnerName = $response->getResourceOwner()->getName();
        
        if($resourceOwnerName == "facebook") {
            $data = $response->getResponse();
            $facebookId = $data["id"];
            return $this->loadFacebookUser($data);
        }

        //instead of using OAuthAwareUserProviderInterface method we use UserProviderInterface method
         return $this->loadUserByUsername($response->getNickname());
    }
    
    public function loadFacebookUser($data)
    {
        $participant = $this->userManager->getRepository("CyclogramProofPilotBundle:Participant")->findOneBy(array('facebookId' => $data["id"]));
        
        $referer = array();
        $request = $this->container->get('request');
        $url = $request->headers->get('referer');
        $referer = parse_url($url);
        
        if (!empty($participant)){
            $participant->setRoles(array('FACEBOOK_REGISTERED'));
            
            if (isset($data['id'])) {
                $participant->setFacebookId($data['id']);
            }
            if (isset($data['first_name'])) {
                $participant->setParticipantFirstname($data['first_name']);
            }
            if (isset($data['last_name'])) {
                $participant->setParticipantLastname($data['last_name']);
            }
            if (isset($data['email'])) {
                $participant->setParticipantEmail($data['email']);
            }
            if (isset($data['username'])) {
                $participant->setParticipantUsername($data['username']);
            }
            $this->userManager->persist($participant);
            $this->userManager->flush();
            return $participant;
        }
        
        if (empty($participant) && $referer['path'] == $this->container->get('router')->generate('_registration')) {
            //if we did not find a user by Facebbok id, we assume he does not exist or is not registered as Facebbok user;
        
            $participant =$this->userManager->getRepository("CyclogramProofPilotBundle:Participant")->findOneBy(array('participantEmail' => $data["email"]));
            if(!$participant)
                $participant = new Participant();
        
            $participant->setRoles(array('FACEBOOK_REGISTRATION_PROCESS'));
        
            $question = $this->userManager->getRepository('CyclogramProofPilotBundle:RecoveryQuestion')->find(1);
            $participant->setRecoveryQuestion($question);
            $participant->setRecoveryPasswordCode('Default');
            $participant->setParticipantEmailConfirmed(false);
            if(!$participant->getParticipantMobileNumber())
                $participant->setParticipantMobileNumber('');
            if(!$participant->getParticipantPassword())
                $participant->setParticipantPassword('');
        
            $participant->setParticipantMobileSmsCodeConfirmed(false);
            $participant->setParticipantIncentiveBalance(false);
            $date = new \DateTime();
            $participant->setParticipantLastTouchDatetime($date);
            $participant->setParticipantZipcode('');
            $role = $this->userManager->getRepository('CyclogramProofPilotBundle:ParticipantRole')->find(1);
            $participant->setParticipantRole($role);
            $status = $this->userManager->getRepository('CyclogramProofPilotBundle:Status')->find(1);
            $participant->setStatus($status);
            if (isset($data['id'])) {
                $participant->setFacebookId($data['id']);
            }
            if (isset($data['first_name'])) {
                $participant->setParticipantFirstname($data['first_name']);
            }
            if (isset($data['last_name'])) {
                $participant->setParticipantLastname($data['last_name']);
            }
            if (isset($data['email'])) {
                $participant->setParticipantEmail($data['email']);
            }
            if (isset($data['username'])) {
                $participant->setParticipantUsername($data['username']);
            }
        
            $this->userManager->persist($participant);
            $this->userManager->flush();
        
            return $participant;
        }
        
        if (empty($participant) && $referer['path'] == $this->container->get('router')->generate('_login')) {
            $participant = new Participant();
            $participant->setRoles(array('FACEBOOK_NOT_REGISTERED'));
            return $participant;
        }
        
    }
    
    
    
    
    public function loadUserByUsername($fbId)
    {
        $participant = $this->userManager->getRepository("CyclogramProofPilotBundle:Participant")->findOneBy(array('facebookId' => $fbId));
        
        $referer = array();
        $request = $this->container->get('request');
        $url = $request->headers->get('referer');
        $referer = parse_url($url);

//         try {
//             $fbdata = $this->facebook->api('/me');
//         } catch (FacebookApiException $e) {
//             $fbdata = null;
//             throw new UsernameNotFoundException('Facebook API not working');//TOFO
//         }

//         if(empty($fbdata))
//             throw new UsernameNotFoundException('Facebook API not working');//TOFO
        
        if (!empty($participant)){
            $participant->setRoles(array('FACEBOOK_REGISTERED'));
        
            $participant->setFBData($fbdata);
        
            $this->userManager->persist($participant);
            $this->userManager->flush();
            
            return $participant;
        }
        

        if (empty($participant) && $referer['path'] == $this->container->get('router')->generate('_registration')) {
            //if we did not find a user by Facebbok id, we assume he does not exist or is not registered as Facebbok user;
            
            $participant = $this->findUserByEmail($fbdata["email"]);
            if(!$participant)
                $participant = new Participant();

            $participant->setRoles(array('FACEBOOK_REGISTRATION_PROCESS'));

            $question = $this->userManager->getRepository('CyclogramProofPilotBundle:RecoveryQuestion')->find(1);
            $participant->setRecoveryQuestion($question);
            $participant->setRecoveryPasswordCode('Default');
            $participant->setParticipantEmailConfirmed(false);
            if(!$participant->getParticipantMobileNumber())
                $participant->setParticipantMobileNumber('');
            if(!$participant->getParticipantPassword())
                $participant->setParticipantPassword('');
            
            $participant->setParticipantMobileSmsCodeConfirmed(false);
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
            
        if (empty($participant) && $referer['path'] == $this->container->get('router')->generate('_login')) {
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
    
    public function refreshUser(UserInterface $user)
    {
        if (!$this->supportsClass(get_class($user))) {
            throw new UnsupportedUserException(sprintf('Unsupported user class "%s"', get_class($user)));
        }

        return $this->loadUserByUsername($user->getUsername());

    }
    public function supportsClass($class)
    {
        return $class === 'Cyclogram\\Bundle\\ProofPilotBundle\\Entity\\Participant';
    }

}
