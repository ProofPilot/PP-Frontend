<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TestPhaseProcessingTypeLink
 *
 * @ORM\Table(name="test_phase_processing_type_link")
 * @ORM\Entity
 */
class TestPhaseProcessingTypeLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="test_phase_processing_type_link_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $testPhaseProcessingTypeLinkId;

    /**
     * @var \TestPhase
     *
     * @ORM\ManyToOne(targetEntity="TestPhase")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="test_phase_id", referencedColumnName="test_phase_id")
     * })
     */
    private $testPhase;

    /**
     * @var \TestProccesingType
     *
     * @ORM\ManyToOne(targetEntity="TestProccesingType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="test_proccesing_type_id", referencedColumnName="test_proccesing_type_id")
     * })
     */
    private $testProccesingType;



    /**
     * Get testPhaseProcessingTypeLinkId
     *
     * @return integer 
     */
    public function getTestPhaseProcessingTypeLinkId()
    {
        return $this->testPhaseProcessingTypeLinkId;
    }

    /**
     * Set testPhase
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\TestPhase $testPhase
     * @return TestPhaseProcessingTypeLink
     */
    public function setTestPhase(\Cyclogram\Bundle\ProofPilotBundle\Entity\TestPhase $testPhase = null)
    {
        $this->testPhase = $testPhase;
    
        return $this;
    }

    /**
     * Get testPhase
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\TestPhase 
     */
    public function getTestPhase()
    {
        return $this->testPhase;
    }

    /**
     * Set testProccesingType
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\TestProccesingType $testProccesingType
     * @return TestPhaseProcessingTypeLink
     */
    public function setTestProccesingType(\Cyclogram\Bundle\ProofPilotBundle\Entity\TestProccesingType $testProccesingType = null)
    {
        $this->testProccesingType = $testProccesingType;
    
        return $this;
    }

    /**
     * Get testProccesingType
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\TestProccesingType 
     */
    public function getTestProccesingType()
    {
        return $this->testProccesingType;
    }
}