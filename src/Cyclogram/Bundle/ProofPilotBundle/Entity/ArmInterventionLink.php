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
 * ArmInterventionLink
 *
 * @ORM\Table(name="arm_intervention_link")
 * @ORM\Entity
 */
class ArmInterventionLink
{
    
    const STATUS_ACTIVE = 1;
    /**
     * @var integer
     *
     * @ORM\Column(name="arm_intervention_link", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $armInterventionLink;

    /**
     * @var \Arm
     *
     * @ORM\ManyToOne(targetEntity="Arm")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="arm_id", referencedColumnName="arm_id")
     * })
     */
    protected $arm;

    /**
     * @var \Intervention
     *
     * @ORM\ManyToOne(targetEntity="Intervention")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="intervention_id", referencedColumnName="intervention_id")
     * })
     */
    protected $intervention;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=false)
     */
    protected $status;



    /**
     * Get armInterventionLink
     *
     * @return integer 
     */
    public function getArmInterventionLink()
    {
        return $this->armInterventionLink;
    }

    /**
     * Set arm
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Arm $arm
     * @return ArmInterventionLink
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
     * Set intervention
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Intervention $intervention
     * @return ArmInterventionLink
     */
    public function setIntervention(\Cyclogram\Bundle\ProofPilotBundle\Entity\Intervention $intervention = null)
    {
        $this->intervention = $intervention;
    
        return $this;
    }

    /**
     * Get intervention
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Intervention 
     */
    public function getIntervention()
    {
        return $this->intervention;
    }

    /**
     * Set status
     *
     */
    public function setStatus( $status)
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