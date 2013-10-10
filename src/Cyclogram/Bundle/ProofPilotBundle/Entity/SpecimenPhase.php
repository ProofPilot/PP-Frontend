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
 * SpecimenPhase
 *
 * @ORM\Table(name="specimen_phase")
 * @ORM\Entity
 */
class SpecimenPhase
{
    const STATUS_ACTIVE =1;
    /**
     * @var integer
     *
     * @ORM\Column(name="specimen_phase_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $specimenPhaseId;

    /**
     * @var string
     *
     * @ORM\Column(name="specimen_phase_name", type="string", length=45, nullable=true)
     */
    private $specimenPhaseName;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=false)
     */
    private $status;



    /**
     * Get specimenPhaseId
     *
     * @return integer 
     */
    public function getSpecimenPhaseId()
    {
        return $this->specimenPhaseId;
    }

    /**
     * Set specimenPhaseName
     *
     * @param string $specimenPhaseName
     * @return SpecimenPhase
     */
    public function setSpecimenPhaseName($specimenPhaseName)
    {
        $this->specimenPhaseName = $specimenPhaseName;
    
        return $this;
    }

    /**
     * Get specimenPhaseName
     *
     * @return string 
     */
    public function getSpecimenPhaseName()
    {
        return $this->specimenPhaseName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return SpecimenPhase
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
    
    public function __toString()
    {
    	return $this->specimenPhaseName;
    }
}