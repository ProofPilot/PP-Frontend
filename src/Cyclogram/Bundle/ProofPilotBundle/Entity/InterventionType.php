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
 * InterventionType
 *
 * @ORM\Table(name="intervention_type")
 * @ORM\Entity
 */
class InterventionType
{
    const STATUS_ACTIVE =1;
    /**
     * @var integer
     *
     * @ORM\Column(name="intervention_type_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $interventionTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="intervention_type_name", type="string", length=45, nullable=false)
     */
    private $interventionTypeName;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=false)
     */
    private $status;



    /**
     * Get interventionTypeId
     *
     * @return integer 
     */
    public function getInterventionTypeId()
    {
        return $this->interventionTypeId;
    }

    /**
     * Set interventionTypeName
     *
     * @param string $interventionTypeName
     * @return InterventionType
     */
    public function setInterventionTypeName($interventionTypeName)
    {
        $this->interventionTypeName = $interventionTypeName;
    
        return $this;
    }

    /**
     * Get interventionTypeName
     *
     * @return string 
     */
    public function getInterventionTypeName()
    {
        return $this->interventionTypeName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return InterventionType
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
    	return $this->interventionTypeName;
    }
}