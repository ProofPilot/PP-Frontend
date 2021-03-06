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
 * TestPreliminarResult
 *
 * @ORM\Table(name="test_preliminar_result")
 * @ORM\Entity
 */
class TestPreliminarResult
{
    const STATUS_ACTIVE =1;
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
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=false)
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
    	return $this->testPreliminarResultName;
    }
}