<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TestType
 *
 * @ORM\Table(name="test_type")
 * @ORM\Entity
 */
class TestType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="test_type_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $testTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="test_type_name", type="string", length=45, nullable=false)
     */
    private $testTypeName;

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
     * Get testTypeId
     *
     * @return integer 
     */
    public function getTestTypeId()
    {
        return $this->testTypeId;
    }

    /**
     * Set testTypeName
     *
     * @param string $testTypeName
     * @return TestType
     */
    public function setTestTypeName($testTypeName)
    {
        $this->testTypeName = $testTypeName;
    
        return $this;
    }

    /**
     * Get testTypeName
     *
     * @return string 
     */
    public function getTestTypeName()
    {
        return $this->testTypeName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return TestType
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
    	return $this->testTypeName;
    }
}