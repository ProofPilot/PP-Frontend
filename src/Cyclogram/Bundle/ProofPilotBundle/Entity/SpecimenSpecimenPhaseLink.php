<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SpecimenSpecimenPhaseLink
 *
 * @ORM\Table(name="specimen_specimen_phase_link")
 * @ORM\Entity
 */
class SpecimenSpecimenPhaseLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="specimen_specimen_phase_link_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $specimenSpecimenPhaseLinkId;

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
     * @var \SpecimenCollectorForum
     *
     * @ORM\ManyToOne(targetEntity="SpecimenCollectorForum")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="specimen_collector_forum_id", referencedColumnName="specimen_collector_forum_id")
     * })
     */
    private $specimenCollectorForum;



    /**
     * Get specimenSpecimenPhaseLinkId
     *
     * @return integer 
     */
    public function getSpecimenSpecimenPhaseLinkId()
    {
        return $this->specimenSpecimenPhaseLinkId;
    }

    /**
     * Set specimenPhase
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\SpecimenPhase $specimenPhase
     * @return SpecimenSpecimenPhaseLink
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
     * Set specimenCollectorForum
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\SpecimenCollectorForum $specimenCollectorForum
     * @return SpecimenSpecimenPhaseLink
     */
    public function setSpecimenCollectorForum(\Cyclogram\Bundle\ProofPilotBundle\Entity\SpecimenCollectorForum $specimenCollectorForum = null)
    {
        $this->specimenCollectorForum = $specimenCollectorForum;
    
        return $this;
    }

    /**
     * Get specimenCollectorForum
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\SpecimenCollectorForum 
     */
    public function getSpecimenCollectorForum()
    {
        return $this->specimenCollectorForum;
    }
}