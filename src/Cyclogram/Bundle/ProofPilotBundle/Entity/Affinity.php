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
 * Affinity
 *
 * @ORM\Table(name="affinity")
 * @ORM\Entity
 */
class Affinity
{
    
    const STATUS_ACTIVE = 1;
    /**
     * @var integer
     *
     * @ORM\Column(name="affinity_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $affinityId;

    /**
     * @var string
     *
     * @ORM\Column(name="affinity_name", type="string", length=45, nullable=false)
     */
    private $affinityName;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=false)
     */
    private $status;



    /**
     * Get affinityId
     *
     * @return integer 
     */
    public function getAffinityId()
    {
        return $this->affinityId;
    }

    /**
     * Set affinityName
     *
     * @param string $affinityName
     * @return Affinity
     */
    public function setAffinityName($affinityName)
    {
        $this->affinityName = $affinityName;
    
        return $this;
    }

    /**
     * Get affinityName
     *
     * @return string 
     */
    public function getAffinityName()
    {
        return $this->affinityName;
    }

    /**
     * Set status
     *
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
}