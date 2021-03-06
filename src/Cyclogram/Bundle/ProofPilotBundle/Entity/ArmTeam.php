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

/**
 * ArmTeam
 *
 * @ORM\Table(name="arm_team")
 * @ORM\Entity
 */
class ArmTeam
{
    /**
     * @var integer
     *
     * @ORM\Column(name="arm_team_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $armTeamId;

    /**
     * @var \Arm
     *
     * @ORM\ManyToOne(targetEntity="Arm")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="arm_id", referencedColumnName="arm_id")
     * })
     */
    private $arm;

    /**
     * @var \ArmRole
     *
     * @ORM\ManyToOne(targetEntity="ArmRole")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="arm_role_id", referencedColumnName="arm_role_id")
     * })
     */
    private $armRole;

    /**
     * @var \Individual
     *
     * @ORM\ManyToOne(targetEntity="Individual")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="individual_id", referencedColumnName="individual_id")
     * })
     */
    private $individual;

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
     * Get armTeamId
     *
     * @return integer 
     */
    public function getArmTeamId()
    {
        return $this->armTeamId;
    }

    /**
     * Set arm
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Arm $arm
     * @return ArmTeam
     */
    public function setArm(\Cyclogram\Bundle\ProofPilotBundle\Entity\Arm $arm = null)
    {
        $this->arm = $arm;
    
        return $this;
    }

    /**
     * Get arm
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Arm 
     */
    public function getArm()
    {
        return $this->arm;
    }

    /**
     * Set armRole
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\ArmRole $armRole
     * @return ArmTeam
     */
    public function setArmRole(\Cyclogram\Bundle\ProofPilotBundle\Entity\ArmRole $armRole = null)
    {
        $this->armRole = $armRole;
    
        return $this;
    }

    /**
     * Get armRole
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\ArmRole 
     */
    public function getArmRole()
    {
        return $this->armRole;
    }

    /**
     * Set individual
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Individual $individual
     * @return ArmTeam
     */
    public function setIndividual(\Cyclogram\Bundle\ProofPilotBundle\Entity\Individual $individual = null)
    {
        $this->individual = $individual;
    
        return $this;
    }

    /**
     * Get individual
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Individual 
     */
    public function getIndividual()
    {
        return $this->individual;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return ArmTeam
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