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
 * Arm
 *
 * @ORM\Table(name="arm")
 * @ORM\Entity
 */
class Arm
{
    
    const STATUS_ACTIVE = 1;
    /**
     * @var integer
     *
     * @ORM\Column(name="arm_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $armId;

    /**
     * @var string
     *
     * @ORM\Column(name="arm_code", type="string", length=45, nullable=false)
     */
    protected $armCode;

    /**
     * @var string
     *
     * @ORM\Column(name="arm_name", type="string", length=45, nullable=false)
     */
    protected $armName;

    /**
     * @var integer
     *
     * @ORM\Column(name="arm_quota", type="integer", nullable=true)
     */
    protected $armQuota;

    /**
     * @var integer
     *
     * @ORM\Column(name="arm_ceilling", type="integer", nullable=true)
     */
    protected $armCeilling;

    /**
     * @var string
     *
     * @ORM\Column(name="arm_description", type="string", length=2000, nullable=true)
     */
    protected $armDescription;

    /**
     * @var boolean
     *
     * @ORM\Column(name="arm_default", type="boolean", nullable=false)
     */
    protected $armDefault;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=false)
     */
    protected $status;

    /**
     * @var \Study
     *
     * @ORM\ManyToOne(targetEntity="Study")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="study_id", referencedColumnName="study_id")
     * })
     */
    protected $study;



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
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
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