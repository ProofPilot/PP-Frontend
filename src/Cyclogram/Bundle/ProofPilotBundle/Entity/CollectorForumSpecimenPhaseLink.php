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
 * CollectorForumSpecimenPhaseLink
 *
 * @ORM\Table(name="collector_forum_specimen_phase_link")
 * @ORM\Entity
 */
class CollectorForumSpecimenPhaseLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="specimen_specimen_phase_link_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $specimenSpecimenPhaseLinkId;

    /**
     * @var integer
     *
     * @ORM\Column(name="specimen_phase_id", type="integer", nullable=false)
     */
    private $specimenPhaseId;

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
     * Get specimenSpecimenPhaseLinkId
     *
     * @return integer 
     */
    public function getSpecimenSpecimenPhaseLinkId()
    {
        return $this->specimenSpecimenPhaseLinkId;
    }

    /**
     * Set specimenPhaseId
     *
     * @param integer $specimenPhaseId
     * @return CollectorForumSpecimenPhaseLink
     */
    public function setSpecimenPhaseId($specimenPhaseId)
    {
        $this->specimenPhaseId = $specimenPhaseId;
    
        return $this;
    }

    /**
     * Get specimenPhaseId
     *
     * @return integer 
     */
    public function getSpecimenPhaseId()
    {
        return $this->specimenPhaseId;
    }

    /**
     * Set collectorForum
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\CollectorForum $collectorForum
     * @return CollectorForumSpecimenPhaseLink
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
}