<?php

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
     * @var \Status
     *
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="status_id")
     * })
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
    
    public function __toString()
    {
    	return $this->specimenPhaseName;
    }
}