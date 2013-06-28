<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TestPreliminarResult
 *
 * @ORM\Table(name="test_preliminar_result")
 * @ORM\Entity
 */
class TestPreliminarResult
{
    /**
     * @var integer
     *
     * @ORM\Column(name="test_preliminar_result_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $testPreliminarResultId;

    /**
     * @var string
     *
     * @ORM\Column(name="test_preliminar_result_name", type="string", length=45, nullable=false)
     */
    private $testPreliminarResultName;

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
     * Get testPreliminarResultId
     *
     * @return integer 
     */
    public function getTestPreliminarResultId()
    {
        return $this->testPreliminarResultId;
    }

    /**
     * Set testPreliminarResultName
     *
     * @param string $testPreliminarResultName
     * @return TestPreliminarResult
     */
    public function setTestPreliminarResultName($testPreliminarResultName)
    {
        $this->testPreliminarResultName = $testPreliminarResultName;
    
        return $this;
    }

    /**
     * Get testPreliminarResultName
     *
     * @return string 
     */
    public function getTestPreliminarResultName()
    {
        return $this->testPreliminarResultName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return TestPreliminarResult
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
    	return $this->testPreliminarResultName;
    }
}