<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArmRole
 *
 * @ORM\Table(name="arm_role")
 * @ORM\Entity
 */
class ArmRole
{
    /**
     * @var integer
     *
     * @ORM\Column(name="arm_role_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $armRoleId;

    /**
     * @var string
     *
     * @ORM\Column(name="arm_role_name", type="string", length=45, nullable=false)
     */
    private $armRoleName;

    /**
     * @var \Status
     *
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="status_id")
     * })
     */
    private $status;



    /**
     * Get armRoleId
     *
     * @return integer 
     */
    public function getArmRoleId()
    {
        return $this->armRoleId;
    }

    /**
     * Set armRoleName
     *
     * @param string $armRoleName
     * @return ArmRole
     */
    public function setArmRoleName($armRoleName)
    {
        $this->armRoleName = $armRoleName;
    
        return $this;
    }

    /**
     * Get armRoleName
     *
     * @return string 
     */
    public function getArmRoleName()
    {
        return $this->armRoleName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return ArmRole
     */
    public function setStatus(\Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status = null)
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
}