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
 * SpecimenCollectorForum
 *
 * @ORM\Table(name="specimen_collector_forum")
 * @ORM\Entity
 */
class SpecimenCollectorForum
{
    /**
     * @var integer
     *
     * @ORM\Column(name="specimen_collector_forum_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $specimenCollectorForumId;

    /**
     * @var string
     *
     * @ORM\Column(name="specimen_collector_forum_name", type="string", length=45, nullable=true)
     */
    public $specimenCollectorForumName;

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
     * Get specimenCollectorForumId
     *
     * @return integer 
     */
    public function getSpecimenCollectorForumId()
    {
        return $this->specimenCollectorForumId;
    }

    /**
     * Set specimenCollectorForumName
     *
     * @param string $specimenCollectorForumName
     * @return SpecimenCollectorForum
     */
    public function setSpecimenCollectorForumName($specimenCollectorForumName)
    {
        $this->specimenCollectorForumName = $specimenCollectorForumName;
    
        return $this;
    }

    /**
     * Get specimenCollectorForumName
     *
     * @return string 
     */
    public function getSpecimenCollectorForumName()
    {
        return $this->specimenCollectorForumName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return SpecimenCollectorForum
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
    	return $this->specimenCollectorForumName;
    }
}