<?php

namespace Cyclogram\SexProBundle\Security;

use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use \BaseFacebook;
use \FacebookApiException;
use Cyclogram\SexProBundle\Entity\User;
use Cyclogram\SexProBundle\Entity\UserRoleLink;
use Cyclogram\SexProBundle\Entity\UserRole;

class FacebookProvider implements UserProviderInterface
{
    /**
     * @var \Facebook
     */
    protected $facebook;
    protected $userManager;
    protected $validator;

    public function __construct(BaseFacebook $facebook, $userManager, $validator)
    {
        $this->facebook = $facebook;
        $this->userManager = $userManager;
        $this->validator = $validator;
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

        try {
            $fbdata = $this->facebook->api('/me');
        } catch (FacebookApiException $e) {
            $fbdata = null;
        }

        if (!empty($fbdata)) {
            if (empty($user)) {
                $user = new User();
                $user->setUserPassword('');
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
            }

            // TODO use http://developers.facebook.com/docs/api/realtime
            $user->setFBData($fbdata);

            if (count($this->validator->validate($user, 'Facebook'))) {
                // TODO: the user was found obviously, but doesnt match our expectations, do something smart
                throw new UsernameNotFoundException('The facebook user could not be stored');
            }
            $this->userManager->persist($user);
            $this->userManager->flush();
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
