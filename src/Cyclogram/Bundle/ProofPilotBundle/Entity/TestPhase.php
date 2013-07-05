<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TestPhase
 *
 * @ORM\Table(name="test_phase")
 * @ORM\Entity
 */
class TestPhase
{
    /**
     * @var integer
     *
     * @ORM\Column(name="test_phase_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $testPhaseId;

    /**
     * @var string
     *
     * @ORM\Column(name="test_phase_name", type="string", length=45, nullable=false)
     */
    private $testPhaseName;

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
     * Get testPhaseId
     *
     * @return integer 
     */
    public function getTestPhaseId()
    {
        return $this->testPhaseId;
    }

    /**
     * Set testPhaseName
     *
     * @param string $testPhaseName
     * @return TestPhase
     */
    public function setTestPhaseName($testPhaseName)
    {
        $this->testPhaseName = $testPhaseName;
    
        return $this;
    }

    /**
     * Get testPhaseName
     *
     * @return string 
     */
    public function getTestPhaseName()
    {
        return $this->testPhaseName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return TestPhase
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
    	return $this->testPhaseName;
    }
}