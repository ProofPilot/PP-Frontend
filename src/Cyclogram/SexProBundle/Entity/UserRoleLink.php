<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserRoleLink
 *
 * @ORM\Table(name="user_role_link")
 * @ORM\Entity
 */
class UserRoleLink
{

    public function __construct($user=null){
        $this->userId = $user;
    }

    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_role_link_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userRoleLinkId;

    /**
     * @var \UserRole
     *
     * @ORM\ManyToOne(targetEntity="UserRole")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_role_user_role_id", referencedColumnName="user_role_id")
     * })
     */
    private $userRoleUserRole;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_user_id", referencedColumnName="user_id")
     * })
     */
    private $userUser;



    /**
     * Get userRoleLinkId
     *
     * @return integer 
     */
    public function getUserRoleLinkId()
    {
        return $this->userRoleLinkId;
    }

    /**
     * Set userRoleUserRole
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\UserRole $userRoleUserRole
     * @return UserRoleLink
     */
    public function setUserRoleUserRole(\Cyclogram\Bundle\ProofPilotBundle\Entity\UserRole $userRoleUserRole = null)
    {
        $this->userRoleUserRole = $userRoleUserRole;
    
        return $this;
    }

    /**
     * Get userRoleUserRole
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\UserRole 
     */
    public function getUserRoleUserRole()
    {
        return $this->userRoleUserRole;
    }

    /**
     * Set userUser
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\User $userUser
     * @return UserRoleLink
     */
    public function setUserUser(\Cyclogram\Bundle\ProofPilotBundle\Entity\User $userUser = null)
    {
        $this->userUser = $userUser;
    
        return $this;
    }

    /**
     * Get userUser
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\User 
     */
    public function getUserUser()
    {
        return $this->userUser;
    }
}