<?php

namespace Cyclogram\SexProBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Cyclogram\SexProBundle\Entity\UserRoleLink;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User implements AdvancedUserInterface
{

    protected $roles;

    public function __construct(){
        #parent::__construct();
        //$this->roles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->roles = array();
    }

    /**
     * @var string
     *
     * @ORM\Column(name="facebookId", type="string", length=255)
     */
    protected $facebookId;
    
    
    public function serialize()
    {
        return serialize(array($this->facebookId, parent::serialize()));
    }
    
    public function unserialize($data)
    {
        list($this->facebookId, $parentData) = unserialize($data);
        parent::unserialize($parentData);
    }
    
    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    protected $firstname;
    
    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    protected $lastname;
    

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_email", type="string", length=45, nullable=false)
     */
    protected $userEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="user_password", type="string", length=245, nullable=false)
     */
    protected $userPassword;

    /**
     * @var boolean
     *
     * @ORM\Column(name="user_email_confirmed", type="boolean", nullable=false)
     */
    protected $userEmailConfirmed;

    /**
     * @var string
     *
     * @ORM\Column(name="user_mobile_number", type="string", length=45, nullable=false)
     */
    protected $userMobileNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="user_mobile_sms_code", type="string", length=4, nullable=false)
     */
    protected $userMobileSmsCode;

    /**
     * @var boolean
     *
     * @ORM\Column(name="user_mobile_sms_code_confirmed", type="boolean", nullable=false)
     */
    protected $userMobileSmsCodeConfirmed;

    /**
     * @var \Status
     *
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="status_id")
     * })
     */
    protected $status;

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set userEmail
     *
     * @param string $userEmail
     * @return User
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;
    
        return $this;
    }

    /**
     * Get userEmail
     *
     * @return string 
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * Set userPassword
     *
     * @param string $userPassword
     * @return User
     */
    public function setUserPassword($userPassword)
    {
        $this->userPassword = $userPassword;
    
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }
    
    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }
    
    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }
    
    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }
    
    /**
     * Get userPassword
     *
     * @return string 
     */
    public function getUserPassword()
    {
        return $this->userPassword;
    }

    /**
     * Set userEmailConfirmed
     *
     * @param boolean $userEmailConfirmed
     * @return User
     */
    public function setUserEmailConfirmed($userEmailConfirmed)
    {
        $this->userEmailConfirmed = $userEmailConfirmed;
    
        return $this;
    }

    /**
     * Get userEmailConfirmed
     *
     * @return boolean 
     */
    public function getUserEmailConfirmed()
    {
        return $this->userEmailConfirmed;
    }

    /**
     * Set userMobileNumber
     *
     * @param string $userMobileNumber
     * @return User
     */
    public function setUserMobileNumber($userMobileNumber)
    {
        $this->userMobileNumber = $userMobileNumber;
    
        return $this;
    }

    /**
     * Get userMobileNumber
     *
     * @return string 
     */
    public function getUserMobileNumber()
    {
        return $this->userMobileNumber;
    }

    /**
     * Set userMobileSmsCode
     *
     * @param string $userMobileSmsCode
     * @return User
     */
    public function setUserMobileSmsCode($userMobileSmsCode)
    {
        $this->userMobileSmsCode = $userMobileSmsCode;
    
        return $this;
    }

    /**
     * Get userMobileSmsCode
     *
     * @return string 
     */
    public function getUserMobileSmsCode()
    {
        return $this->userMobileSmsCode;
    }

    /**
     * Set userMobileSmsCodeConfirmed
     *
     * @param boolean $userMobileSmsCodeConfirmed
     * @return User
     */
    public function setUserMobileSmsCodeConfirmed($userMobileSmsCodeConfirmed)
    {
        $this->userMobileSmsCodeConfirmed = $userMobileSmsCodeConfirmed;
    
        return $this;
    }

    /**
     * Get userMobileSmsCodeConfirmed
     *
     * @return boolean 
     */
    public function getUserMobileSmsCodeConfirmed()
    {
        return $this->userMobileSmsCodeConfirmed;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return User
     */
    public function setStatus(\Cyclogram\SexProBundle\Entity\Status $status = null)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Status 
     */
    public function getStatus()
    {
        return $this->status;
    }


    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->userPassword;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        // TODO: Implement getUsername() method.
        return $this->getUserEmail();
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     *
     * @return void
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    /* @UserInterface */
    public function isEnabled()
    {
        return true;
    }

    /* @UserInterface */
    public function equals(UserInterface $user)
    {
        return ( $this->getUsername() === $user->getUsername() );
    }

    /* @Serializable */
    public function __sleep()
    {
        return array('userId');
    }
    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return Role[] The user roles
     */

    public function getRoles(){

        //( is_null($this->roles) ) ? $this->roles = new \Doctrine\Common\Collections\ArrayCollection() : $this->roles;
        ( is_null($this->roles) ) ? $this->roles = array() : $this->roles;

        //return array_merge( $this->roles->toArray(), array( new \Cyclogram\Bundle\ProofPilotBundle\Entity\UserRole( "ROLE_USER" ) ) );
        return array_merge( $this->roles, array( new \Cyclogram\SexProBundle\Entity\UserRole( "ROLE_USER" ) ) );
    }

    public function setRoles( array $roles=array() ){

        if(count($roles)>0){
            foreach($roles as $role){
                $this->roles[] = $role->getUserRoleUserRole()->getUserRoleName();
            }
        }
    }
    
    /**
     * @param string $facebookId
     * @return void
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;
//         $this->setUsername($facebookId);
        $this->salt = '';
    }
    
    /**
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }
    
    public function __toString() 
    {
    	return (string) $this->userId;
    }
    
    /**
     * @param Array
     */
    public function setFBData($fbdata)
    {
        if (isset($fbdata['id'])) {
            $this->setFacebookId($fbdata['id']);
        }
        if (isset($fbdata['first_name'])) {
            $this->setFirstname($fbdata['first_name']);
        }
        if (isset($fbdata['last_name'])) {
            $this->setLastname($fbdata['last_name']);
        }
        if (isset($fbdata['email'])) {
            $this->setUserEmail($fbdata['email']);
        }
    }
}