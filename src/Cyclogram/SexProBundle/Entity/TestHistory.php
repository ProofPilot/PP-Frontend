<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TestHistory
 *
 * @ORM\Table(name="test_history")
 * @ORM\Entity
 */
class TestHistory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="test_history_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $testHistoryId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="test_history_datetime", type="datetime", nullable=false)
     */
    private $testHistoryDatetime;

    /**
     * @var string
     *
     * @ORM\Column(name="test_history_ip_address", type="string", length=15, nullable=true)
     */
    private $testHistoryIpAddress;

    /**
     * @var \Representative
     *
     * @ORM\ManyToOne(targetEntity="Representative")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="representative_id", referencedColumnName="representative_id")
     * })
     */
    private $representative;

    /**
     * @var \Test
     *
     * @ORM\ManyToOne(targetEntity="Test")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="test_id", referencedColumnName="test_id")
     * })
     */
    private $test;

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
     * Get testHistoryId
     *
     * @return integer 
     */
    public function getTestHistoryId()
    {
        return $this->testHistoryId;
    }

    /**
     * Set testHistoryDatetime
     *
     * @param \DateTime $testHistoryDatetime
     * @return TestHistory
     */
    public function setTestHistoryDatetime($testHistoryDatetime)
    {
        $this->testHistoryDatetime = $testHistoryDatetime;
    
        return $this;
    }

    /**
     * Get testHistoryDatetime
     *
     * @return \DateTime 
     */
    public function getTestHistoryDatetime()
    {
        return $this->testHistoryDatetime;
    }

    /**
     * Set testHistoryIpAddress
     *
     * @param string $testHistoryIpAddress
     * @return TestHistory
     */
    public function setTestHistoryIpAddress($testHistoryIpAddress)
    {
        $this->testHistoryIpAddress = $testHistoryIpAddress;
    
        return $this;
    }

    /**
     * Get testHistoryIpAddress
     *
     * @return string 
     */
    public function getTestHistoryIpAddress()
    {
        return $this->testHistoryIpAddress;
    }

    /**
     * Set representative
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Representative $representative
     * @return TestHistory
     */
    public function setRepresentative(\Cyclogram\Bundle\ProofPilotBundle\Entity\Representative $representative = null)
    {
        $this->representative = $representative;
    
        return $this;
    }

    /**
     * Get representative
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Representative 
     */
    public function getRepresentative()
    {
        return $this->representative;
    }

    /**
     * Set test
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Test $test
     * @return TestHistory
     */
    public function setTest(\Cyclogram\Bundle\ProofPilotBundle\Entity\Test $test = null)
    {
        $this->test = $test;
    
        return $this;
    }

    /**
     * Get test
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Test 
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * Set testPhase
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\TestPhase $testPhase
     * @return TestHistory
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
}