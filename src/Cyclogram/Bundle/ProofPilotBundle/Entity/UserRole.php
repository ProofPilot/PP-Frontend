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

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;

/**
 * Cyclogram\Bundle\ProofPilotBundle\Entity\UserRole
 *
 * @ORM\Table(name="user_role")
 * @ORM\Entity
 */
class UserRole implements RoleInterface
{
    /**
     * @var integer $userRoleId
     *
     * @ORM\Column(name="user_role_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $userRoleId;

    /**
     * @var string $userRoleName
     *
     * @ORM\Column(name="user_role_name", type="string", length=45, nullable=false)
     */
    public $userRoleName;

    /**
     * @var Status
     *
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="status_id")
     * })
     */
    protected $status;


    /**
     * Get userRoleId
     *
     * @return integer
     */
    public function getUserRoleId()
    {
        return $this->userRoleId;
    }

    /**
     * Set userRoleName
     *
     * @param string $userRoleName
     */
    public function setUserRoleName($userRoleName)
    {
        $this->userRoleName = $userRoleName;
    }

    /**
     * Get userRoleName
     *
     * @return string
     */
    public function getUserRoleName()
    {
        return $this->userRoleName;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="user_parent_role_id", type="integer", nullable=true)
     */
    protected $userParentRoleId;
    
    /**
     * Set status
     *
     * @param Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     */
    public function setStatus(\Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return Cyclogram\Bundle\ProofPilotBundle\Entity\Status
     */
    public function getStatus()
    {
        return $this->status;
    }


    /**
     * Populate the role field
     * @param string $role ROLE_FOO etc
     */
    public function __construct( $role = null )
    {
        $this->setUserRoleName($role);
    }

    /**
     * Return the role field.
     * @return string
     */
    public function getRole()
    {
        return $this->getUserRoleName();
    }

    /**
     * Return the role field.
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getUserRoleName();
    }


    public function getUserParentRoleId()
    {
        return $this->userParentRoleId;
    }

    public function setUserParentRoleId($userParentRoleId)
    {
        $this->userParentRoleId = $userParentRoleId;
    }
}