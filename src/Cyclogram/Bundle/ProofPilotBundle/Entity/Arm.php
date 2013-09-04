<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Arm
 *
 * @ORM\Table(name="arm")
 * @ORM\Entity
 */
class Arm
{
    /**
     * @var integer
     *
     * @ORM\Column(name="arm_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $armId;

    /**
     * @var string
     *
     * @ORM\Column(name="arm_code", type="string", length=45, nullable=false)
     */
    private $armCode;

    /**
     * @var string
     *
     * @ORM\Column(name="arm_name", type="string", length=45, nullable=false)
     */
    private $armName;

    /**
     * @var integer
     *
     * @ORM\Column(name="arm_quota", type="integer", nullable=true)
     */
    private $armQuota;

    /**
     * @var integer
     *
     * @ORM\Column(name="arm_ceilling", type="integer", nullable=true)
     */
    private $armCeilling;

    /**
     * @var string
     *
     * @ORM\Column(name="arm_description", type="string", length=2000, nullable=true)
     */
    private $armDescription;

    /**
     * @var boolean
     *
     * @ORM\Column(name="arm_default", type="boolean", nullable=false)
     */
    private $armDefault;

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
     * @var \Study
     *
     * @ORM\ManyToOne(targetEntity="Study")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="study_id", referencedColumnName="study_id")
     * })
     */
    private $study;



    /**
     * Get armId
     *
     * @return integer 
     */
    public function getArmId()
    {
        return $this->armId;
    }

    /**
     * Set armCode
     *
     * @param string $armCode
     * @return Arm
     */
    public function setArmCode($armCode)
    {
        $this->armCode = $armCode;
    
        return $this;
    }

    /**
     * Get armCode
     *
     * @return string 
     */
    public function getArmCode()
    {
        return $this->armCode;
    }

    /**
     * Set armName
     *
     * @param string $armName
     * @return Arm
     */
    public function setArmName($armName)
    {
        $this->armName = $armName;
    
        return $this;
    }

    /**
     * Get armName
     *
     * @return string 
     */
    public function getArmName()
    {
        return $this->armName;
    }

    /**
     * Set armQuota
     *
     * @param integer $armQuota
     * @return Arm
     */
    public function setArmQuota($armQuota)
    {
        $this->armQuota = $armQuota;
    
        return $this;
    }

    /**
     * Get armQuota
     *
     * @return integer 
     */
    public function getArmQuota()
    {
        return $this->armQuota;
    }

    /**
     * Set armCeilling
     *
     * @param integer $armCeilling
     * @return Arm
     */
    public function setArmCeilling($armCeilling)
    {
        $this->armCeilling = $armCeilling;
    
        return $this;
    }

    /**
     * Get armCeilling
     *
     * @return integer 
     */
    public function getArmCeilling()
    {
        return $this->armCeilling;
    }

    /**
     * Set armDescription
     *
     * @param string $armDescription
     * @return Arm
     */
    public function setArmDescription($armDescription)
    {
        $this->armDescription = $armDescription;
    
        return $this;
    }

    /**
     * Get armDescription
     *
     * @return string 
     */
    public function getArmDescription()
    {
        return $this->armDescription;
    }

    /**
     * Set armDefault
     *
     * @param boolean $armDefault
     * @return Arm
     */
    public function setArmDefault($armDefault)
    {
        $this->armDefault = $armDefault;
    
        return $this;
    }

    /**
     * Get armDefault
     *
     * @return boolean 
     */
    public function getArmDefault()
    {
        return $this->armDefault;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return Arm
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

    /**
     * Set study
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study
     * @return Arm
     */
    public function setStudy(\Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study = null)
    {
        $this->study = $study;
    
        return $this;
    }

    /**
     * Get study
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Study 
     */
    public function getStudy()
    {
        return $this->study;
    }
}