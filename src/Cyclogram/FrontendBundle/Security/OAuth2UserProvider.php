<?php
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
        $resourceOwnerName = $response->getResourceOwner()->getName();
        
        $data = $response->getResponse();
        $email = $response->getEmail();
        
        //find user in database using email
        $participant = $this->userManager->getRepository("CyclogramProofPilotBundle:Participant")->findOneBy(array('participantEmail' => $email));
        
        //if participant does not existr and it was registration
        if (empty($participant)) {
            $participant = new Participant();
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

            switch($resourceOwnerName) {
                case "facebook":
                    $participant->setParticipantFirstname($data["first_name"]);
                    $participant->setParticipantLastname($data["last_name"]);
                    $participant->setParticipantEmail($data["email"]);
                    $participant->setParticipantUsername($data["username"]);
                    $participant->setFacebookId($data["id"]);
                    break;
                case "google":
                    $participant->setParticipantFirstname($data["given_name"]);
                    $participant->setParticipantLastname($data["family_name"]);
                    $participant->setParticipantEmail($data["email"]);
                    $participant->setGoogleId($data["id"]);
            }

            $this->userManager->persist($participant);
            $this->userManager->flush();
            
            $e = new IncompleteUserException("You have to continue registration");
            $e->setParticipantId($participant->getParticipantId());
            throw $e;
        } else {
                //Participant with such email already exists in database
                
                //if no mobile phone, do all registration again
                if(($participant->getParticipantMobileSmsCodeConfirmed() == false)) {
                    $e = new IncompleteUserException("You have to continue registration");
                    $e->setParticipantId($participant->getParticipantId());
                    throw $e;
                }
                
                switch($resourceOwnerName) {
                    case "facebook":
                        $participant->setRoles(array("ROLE_FACEBOOK_USER"));
                        break;
                    case "google":
                        $participant->setRoles(array("ROLE_GOOGLE_USER"));
                        break;
                }
                //if participant present, handle in another way
                $date = new \DateTime();
                $participant->setParticipantLastTouchDatetime($date);
                $this->userManager->persist($participant);
                $this->userManager->flush();
                return $participant;
        }
        


    }


}