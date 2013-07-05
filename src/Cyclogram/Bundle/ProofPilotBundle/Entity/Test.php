<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Test
 *
 * @ORM\Table(name="test")
 * @ORM\Entity
 */
class Test
{
    /**
     * @var integer
     *
     * @ORM\Column(name="test_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $testId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="test_date_creation", type="datetime", nullable=true)
     */
    private $testDateCreation;

    /**
     * @var string
     *
     * @ORM\Column(name="test_name", type="string", length=45, nullable=true)
     */
    private $testName;

    /**
     * @var string
     *
     * @ORM\Column(name="test_kit_number", type="string", length=45, nullable=true)
     */
    private $testKitNumber;

    /**
     * @var boolean
     *
     * @ORM\Column(name="test_kit_registered", type="boolean", nullable=false)
     */
    private $testKitRegistered;

    /**
     * @var string
     *
     * @ORM\Column(name="test_disease_count", type="string", length=45, nullable=true)
     */
    private $testDiseaseCount;

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
     * @var \Status
     *
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="status_id")
     * })
     */
    private $status;

    /**
     * @var \TestOutcomeType
     *
     * @ORM\ManyToOne(targetEntity="TestOutcomeType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="test_outcome_type_id", referencedColumnName="test_outcome_type_id")
     * })
     */
    private $testOutcomeType;

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
     * @var \TestPreliminarResult
     *
     * @ORM\ManyToOne(targetEntity="TestPreliminarResult")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="test_preliminar_result_id", referencedColumnName="test_preliminar_result_id")
     * })
     */
    private $testPreliminarResult;

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
     * @var \TestType
     *
     * @ORM\ManyToOne(targetEntity="TestType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="test_type_id", referencedColumnName="test_type_id")
     * })
     */
    private $testType;



    /**
     * Get testId
     *
     * @return integer 
     */
    public function getTestId()
    {
        return $this->testId;
    }

    /**
     * Set testDateCreation
     *
     * @param \DateTime $testDateCreation
     * @return Test
     */
    public function setTestDateCreation($testDateCreation)
    {
        $this->testDateCreation = $testDateCreation;
    
        return $this;
    }

    /**
     * Get testDateCreation
     *
     * @return \DateTime 
     */
    public function getTestDateCreation()
    {
        return $this->testDateCreation;
    }

    /**
     * Set testName
     *
     * @param string $testName
     * @return Test
     */
    public function setTestName($testName)
    {
        $this->testName = $testName;
    
        return $this;
    }

    /**
     * Get testName
     *
     * @return string 
     */
    public function getTestName()
    {
        return $this->testName;
    }

    /**
     * Set testKitNumber
     *
     * @param string $testKitNumber
     * @return Test
     */
    public function setTestKitNumber($testKitNumber)
    {
        $this->testKitNumber = $testKitNumber;
    
        return $this;
    }

    /**
     * Get testKitNumber
     *
     * @return string 
     */
    public function getTestKitNumber()
    {
        return $this->testKitNumber;
    }

    /**
     * Set testKitRegistered
     *
     * @param boolean $testKitRegistered
     * @return Test
     */
    public function setTestKitRegistered($testKitRegistered)
    {
        $this->testKitRegistered = $testKitRegistered;
    
        return $this;
    }

    /**
     * Get testKitRegistered
     *
     * @return boolean 
     */
    public function getTestKitRegistered()
    {
        return $this->testKitRegistered;
    }

    /**
     * Set testDiseaseCount
     *
     * @param string $testDiseaseCount
     * @return Test
     */
    public function setTestDiseaseCount($testDiseaseCount)
    {
        $this->testDiseaseCount = $testDiseaseCount;
    
        return $this;
    }

    /**
     * Get testDiseaseCount
     *
     * @return string 
     */
    public function getTestDiseaseCount()
    {
        return $this->testDiseaseCount;
    }

    /**
     * Set collectorForum
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\CollectorForum $collectorForum
     * @return Test
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
     * @return Test
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

    /**
     * Set testOutcomeType
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\TestOutcomeType $testOutcomeType
     * @return Test
     */
    public function setTestOutcomeType(\Cyclogram\Bundle\ProofPilotBundle\Entity\TestOutcomeType $testOutcomeType = null)
    {
        $this->testOutcomeType = $testOutcomeType;
    
        return $this;
    }

    /**
     * Get testOutcomeType
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\TestOutcomeType 
     */
    public function getTestOutcomeType()
    {
        return $this->testOutcomeType;
    }

    /**
     * Set testPhase
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\TestPhase $testPhase
     * @return Test
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
     * Set testPreliminarResult
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\TestPreliminarResult $testPreliminarResult
     * @return Test
     */
    public function setTestPreliminarResult(\Cyclogram\Bundle\ProofPilotBundle\Entity\TestPreliminarResult $testPreliminarResult = null)
    {
        $this->testPreliminarResult = $testPreliminarResult;
    
        return $this;
    }

    /**
     * Get testPreliminarResult
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\TestPreliminarResult 
     */
    public function getTestPreliminarResult()
    {
        return $this->testPreliminarResult;
    }

    /**
     * Set testProccesingType
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\TestProccesingType $testProccesingType
     * @return Test
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

    /**
     * Set testType
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\TestType $testType
     * @return Test
     */
    public function setTestType(\Cyclogram\Bundle\ProofPilotBundle\Entity\TestType $testType = null)
    {
        $this->testType = $testType;
    
        return $this;
    }

    /**
     * Get testType
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\TestType 
     */
    public function getTestType()
    {
        return $this->testType;
    }
}