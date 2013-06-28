<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TestProccesingType
 *
 * @ORM\Table(name="test_proccesing_type")
 * @ORM\Entity
 */
class TestProccesingType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="test_proccesing_type_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $testProccesingTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="test_proccesing_type_name", type="string", length=45, nullable=true)
     */
    private $testProccesingTypeName;

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
     * Get testProccesingTypeId
     *
     * @return integer 
     */
    public function getTestProccesingTypeId()
    {
        return $this->testProccesingTypeId;
    }

    /**
     * Set testProccesingTypeName
     *
     * @param string $testProccesingTypeName
     * @return TestProccesingType
     */
    public function setTestProccesingTypeName($testProccesingTypeName)
    {
        $this->testProccesingTypeName = $testProccesingTypeName;
    
        return $this;
    }

    /**
     * Get testProccesingTypeName
     *
     * @return string 
     */
    public function getTestProccesingTypeName()
    {
        return $this->testProccesingTypeName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return TestProccesingType
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
    	return $this->testProccesingTypeName;
    }
}