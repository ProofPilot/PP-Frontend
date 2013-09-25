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
 * TestOutcomeType
 *
 * @ORM\Table(name="test_outcome_type")
 * @ORM\Entity
 */
class TestOutcomeType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="test_outcome_type_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $testOutcomeTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="test_outcome_type_name", type="string", length=45, nullable=true)
     */
    private $testOutcomeTypeName;

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
     * Get testOutcomeTypeId
     *
     * @return integer 
     */
    public function getTestOutcomeTypeId()
    {
        return $this->testOutcomeTypeId;
    }

    /**
     * Set testOutcomeTypeName
     *
     * @param string $testOutcomeTypeName
     * @return TestOutcomeType
     */
    public function setTestOutcomeTypeName($testOutcomeTypeName)
    {
        $this->testOutcomeTypeName = $testOutcomeTypeName;
    
        return $this;
    }

    /**
     * Get testOutcomeTypeName
     *
     * @return string 
     */
    public function getTestOutcomeTypeName()
    {
        return $this->testOutcomeTypeName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return TestOutcomeType
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
    	return $this->testOutcomeTypeName;
    }
}