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

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Cyclogram\Bundle\ProofPilotBundle\Entity\UserRoleLink;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User
{

    protected $roles;

    public function __construct(){
        #parent::__construct();
        //$this->roles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->roles = array();
    }

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
     * @var boolean
     *
     * @ORM\Column(name="login_attempts", type="boolean", nullable=false)
     */
    protected $loginAttempts;

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
    public function setStatus(\Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status = null)
    {
        $this->status = $status;
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

    public function setLoginAttempts($loginAttempts) {
    	$this->loginAttempts = $loginAttempts;
    }
    
    public function getLoginAttempts() {
    	return $this->loginAttempts;
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

    /* @Serializable */
    public function serialize (){
        return NULL;
    }

    /* @Serializable */
    public function unserialize ( $serialized ) {
        return;
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
        return array_merge( $this->roles, array( new \Cyclogram\Bundle\ProofPilotBundle\Entity\UserRole( "ROLE_USER" ) ) );
    }

    public function setRoles( array $roles=array() ){

        if(count($roles)>0){
            foreach($roles as $role){
                $this->roles[] = $role->getUserRoleUserRole()->getUserRoleName();
            }
        }
    }
    
    public function __toString() 
    {
    	return (string) $this->userId;
    }
}