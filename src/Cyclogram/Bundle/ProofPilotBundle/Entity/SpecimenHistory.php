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
 * SpecimenHistory
 *
 * @ORM\Table(name="specimen_history")
 * @ORM\Entity
 */
class SpecimenHistory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="specimen_history_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $specimenHistoryId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="specimen_history_datetime", type="datetime", nullable=false)
     */
    private $specimenHistoryDatetime;

    /**
     * @var string
     *
     * @ORM\Column(name="specimen_history_ip_address", type="string", length=15, nullable=false)
     */
    private $specimenHistoryIpAddress;

    /**
     * @var float
     *
     * @ORM\Column(name="specimen_history_latitude", type="float", nullable=true)
     */
    private $specimenHistoryLatitude;

    /**
     * @var float
     *
     * @ORM\Column(name="specimen_history_longitude", type="float", nullable=true)
     */
    private $specimenHistoryLongitude;

    /**
     * @var \Representative
     *
     * @ORM\ManyToOne(targetEntity="Representative")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="representative_id", referencedColumnName="representative_id")
     * })
     */
    private $representative;

    /**
     * @var \Specimen
     *
     * @ORM\ManyToOne(targetEntity="Specimen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="specimen_id", referencedColumnName="specimen_id")
     * })
     */
    private $specimen;

    /**
     * @var \SpecimenPhase
     *
     * @ORM\ManyToOne(targetEntity="SpecimenPhase")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="specimen_phase_id", referencedColumnName="specimen_phase_id")
     * })
     */
    private $specimenPhase;



    /**
     * Get specimenHistoryId
     *
     * @return integer 
     */
    public function getSpecimenHistoryId()
    {
        return $this->specimenHistoryId;
    }

    /**
     * Set specimenHistoryDatetime
     *
     * @param \DateTime $specimenHistoryDatetime
     * @return SpecimenHistory
     */
    public function setSpecimenHistoryDatetime($specimenHistoryDatetime)
    {
        $this->specimenHistoryDatetime = $specimenHistoryDatetime;
    
        return $this;
    }

    /**
     * Get specimenHistoryDatetime
     *
     * @return \DateTime 
     */
    public function getSpecimenHistoryDatetime()
    {
        return $this->specimenHistoryDatetime;
    }

    /**
     * Set specimenHistoryIpAddress
     *
     * @param string $specimenHistoryIpAddress
     * @return SpecimenHistory
     */
    public function setSpecimenHistoryIpAddress($specimenHistoryIpAddress)
    {
        $this->specimenHistoryIpAddress = $specimenHistoryIpAddress;
    
        return $this;
    }

    /**
     * Get specimenHistoryIpAddress
     *
     * @return string 
     */
    public function getSpecimenHistoryIpAddress()
    {
        return $this->specimenHistoryIpAddress;
    }

    /**
     * Set specimenHistoryLatitude
     *
     * @param float $specimenHistoryLatitude
     * @return SpecimenHistory
     */
    public function setSpecimenHistoryLatitude($specimenHistoryLatitude)
    {
        $this->specimenHistoryLatitude = $specimenHistoryLatitude;
    
        return $this;
    }

    /**
     * Get specimenHistoryLatitude
     *
     * @return float 
     */
    public function getSpecimenHistoryLatitude()
    {
        return $this->specimenHistoryLatitude;
    }

    /**
     * Set specimenHistoryLongitude
     *
     * @param float $specimenHistoryLongitude
     * @return SpecimenHistory
     */
    public function setSpecimenHistoryLongitude($specimenHistoryLongitude)
    {
        $this->specimenHistoryLongitude = $specimenHistoryLongitude;
    
        return $this;
    }

    /**
     * Get specimenHistoryLongitude
     *
     * @return float 
     */
    public function getSpecimenHistoryLongitude()
    {
        return $this->specimenHistoryLongitude;
    }

    /**
     * Set representative
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Representative $representative
     * @return SpecimenHistory
     */
    public function setRepresentative(\Cyclogram\Bundle\ProofPilotBundle\Entity\Representative $representative = null)
    {
        $this->representative = $representative;
    
        return $this;
    }

    /**
     * Get representative
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Representative 
     */
    public function getRepresentative()
    {
        return $this->representative;
    }

    /**
     * Set specimen
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Specimen $specimen
     * @return SpecimenHistory
     */
    public function setSpecimen(\Cyclogram\Bundle\ProofPilotBundle\Entity\Specimen $specimen = null)
    {
        $this->specimen = $specimen;
    
        return $this;
    }

    /**
     * Get specimen
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Specimen 
     */
    public function getSpecimen()
    {
        return $this->specimen;
    }

    /**
     * Set specimenPhase
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\SpecimenPhase $specimenPhase
     * @return SpecimenHistory
     */
    public function setSpecimenPhase(\Cyclogram\Bundle\ProofPilotBundle\Entity\SpecimenPhase $specimenPhase = null)
    {
        $this->specimenPhase = $specimenPhase;
    
        return $this;
    }

    /**
     * Get specimenPhase
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\SpecimenPhase 
     */
    public function getSpecimenPhase()
    {
        return $this->specimenPhase;
    }
}