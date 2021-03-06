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
 * Specimen
 *
 * @ORM\Table(name="specimen")
 * @ORM\Entity
 */
class Specimen
{
    const STATUS_ACTIVE =1;
    /**
     * @var integer
     *
     * @ORM\Column(name="specimen_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $specimenId;

    /**
     * @var string
     *
     * @ORM\Column(name="specimen_kit_number", type="string", length=45, nullable=true)
     */
    private $specimenKitNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="specimen_kit_received_at_lab", type="datetime", nullable=true)
     */
    private $specimenKitReceivedAtLab;

    /**
     * @var string
     *
     * @ORM\Column(name="specimen_name", type="string", length=45, nullable=false)
     */
    private $specimenName;

    /**
     * @var boolean
     *
     * @ORM\Column(name="specimen_fda_approval_status", type="boolean", nullable=false)
     */
    private $specimenFdaApprovalStatus;

    /**
     * @var \SpecimenCollectionTool
     *
     * @ORM\ManyToOne(targetEntity="SpecimenCollectionTool")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="specimen_collection_tool_id", referencedColumnName="specimen_collection_tool_id")
     * })
     */
    private $specimenCollectionTool;

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
     * @var \CollectorForum
     *
     * @ORM\ManyToOne(targetEntity="CollectorForum")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="collector_forum_id", referencedColumnName="collector_forum_id")
     * })
     */
    private $collectorForum;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=false)
     */
    private $status;



    /**
     * Get specimenId
     *
     * @return integer 
     */
    public function getSpecimenId()
    {
        return $this->specimenId;
    }

    /**
     * Set specimenKitNumber
     *
     * @param string $specimenKitNumber
     * @return Specimen
     */
    public function setSpecimenKitNumber($specimenKitNumber)
    {
        $this->specimenKitNumber = $specimenKitNumber;
    
        return $this;
    }

    /**
     * Get specimenKitNumber
     *
     * @return string 
     */
    public function getSpecimenKitNumber()
    {
        return $this->specimenKitNumber;
    }

    /**
     * Set specimenKitReceivedAtLab
     *
     * @param \DateTime $specimenKitReceivedAtLab
     * @return Specimen
     */
    public function setSpecimenKitReceivedAtLab($specimenKitReceivedAtLab)
    {
        $this->specimenKitReceivedAtLab = $specimenKitReceivedAtLab;
    
        return $this;
    }

    /**
     * Get specimenKitReceivedAtLab
     *
     * @return \DateTime 
     */
    public function getSpecimenKitReceivedAtLab()
    {
        return $this->specimenKitReceivedAtLab;
    }

    /**
     * Set specimenName
     *
     * @param string $specimenName
     * @return Specimen
     */
    public function setSpecimenName($specimenName)
    {
        $this->specimenName = $specimenName;
    
        return $this;
    }

    /**
     * Get specimenName
     *
     * @return string 
     */
    public function getSpecimenName()
    {
        return $this->specimenName;
    }

    /**
     * Set specimenFdaApprovalStatus
     *
     * @param boolean $specimenFdaApprovalStatus
     * @return Specimen
     */
    public function setSpecimenFdaApprovalStatus($specimenFdaApprovalStatus)
    {
        $this->specimenFdaApprovalStatus = $specimenFdaApprovalStatus;
    
        return $this;
    }

    /**
     * Get specimenFdaApprovalStatus
     *
     * @return boolean 
     */
    public function getSpecimenFdaApprovalStatus()
    {
        return $this->specimenFdaApprovalStatus;
    }

    /**
     * Set specimenCollectionTool
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\SpecimenCollectionTool $specimenCollectionTool
     * @return Specimen
     */
    public function setSpecimenCollectionTool(\Cyclogram\Bundle\ProofPilotBundle\Entity\SpecimenCollectionTool $specimenCollectionTool = null)
    {
        $this->specimenCollectionTool = $specimenCollectionTool;
    
        return $this;
    }

    /**
     * Get specimenCollectionTool
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\SpecimenCollectionTool 
     */
    public function getSpecimenCollectionTool()
    {
        return $this->specimenCollectionTool;
    }

    /**
     * Set specimenPhase
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\SpecimenPhase $specimenPhase
     * @return Specimen
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

    /**
     * Set collectorForum
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\CollectorForum $collectorForum
     * @return Specimen
     */
    public function setCollectorForum(\Cyclogram\Bundle\ProofPilotBundle\Entity\CollectorForum $collectorForum = null)
    {
        $this->collectorForum = $collectorForum;
    
        return $this;
    }

    /**
     * Get collectorForum
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\CollectorForum 
     */
    public function getCollectorForum()
    {
        return $this->collectorForum;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return Specimen
     */
    public function setStatus($status)
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