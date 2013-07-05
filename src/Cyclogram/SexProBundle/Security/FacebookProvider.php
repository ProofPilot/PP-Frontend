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
use Cyclogram\Bundle\ProofPilotBundle\Entity\User;
use Cyclogram\Bundle\ProofPilotBundle\Entity\UserRoleLink;
use Cyclogram\Bundle\ProofPilotBundle\Entity\UserRole;

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

    public function findUserByFbId($fbId)
    {
        return $this->userManager->getRepository("CyclogramProofPilotBundle:User")->findOneBy(array('facebookId' => $fbId));
    }

    public function loadUserByUsername($username)
    {
        $user = $this->findUserByFbId($username);
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
        
        if (!empty($user)){
            $user->setRoleDirect('FACEBOOK_REGISTERED');
        
            $user->setFBData($fbdata);
        
            $this->userManager->persist($user);
            $this->userManager->flush();
        }

        if (empty($user) && $referer['path'] == '/register') {
            $user = new User();
            $user->setUserPassword('');
            $user->setRoleDirect('FACEBOOK_REGISTRATION_PROCESS');
            $user->setUserEmailConfirmed(true);
            $user->setUserMobileNumber('');
            $user->setUserMobileSmsCode('');
            $user->setUserMobileSmsCodeConfirmed(false);
            $status = $this->userManager->getRepository('CyclogramProofPilotBundle:Status')->find(1);
            $user->setStatus($status);
            $userRoleLink = new UserRoleLink();
            $userRole = $this->userManager->getRepository('CyclogramProofPilotBundle:UserRole')->findOneByUserRoleName('ROLE_REPRESENTATIVE');
            $userRoleLink->setUserRoleUserRole($userRole);
            $userRoleLink->setUserUser($user);
            $this->userManager->persist($userRoleLink);
            $user->setRoles(array($userRoleLink));
            $user->setFBData($fbdata);
                
            $this->userManager->persist($user);
            $this->userManager->flush();
            return $user;
        }
            
        if (empty($user) && $referer['path'] == '/login') {
            $user = new User();
            $user->setRoleDirect('FACEBOOK_NOT_REGISTERED');
            return $user;
        }

        if (count($this->validator->validate($user, 'Facebook'))) {
            // TODO: the user was found obviously, but doesnt match our expectations, do something smart
            throw new UsernameNotFoundException('The facebook user could not be stored');
        }

        if (empty($user)) {
            throw new UsernameNotFoundException('The user is not authenticated on facebook');
        }

        return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$this->supportsClass(get_class($user)) || !$user->getFacebookId()) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getFacebookId());
    }
}
