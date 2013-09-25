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
 * OrganizationSpecimenCollectionToolLink
 *
 * @ORM\Table(name="organization_specimen_collection_tool_link")
 * @ORM\Entity
 */
class OrganizationSpecimenCollectionToolLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="organization_specimen_collection_tool_link_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $organizationSpecimenCollectionToolLinkId;

    /**
     * @var integer
     *
     * @ORM\Column(name="organization_id", type="integer", nullable=false)
     */
    private $organizationId;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=false)
     */
    private $statusId;

    /**
     * @var \SpecimenCollectionTool
     *
     * @ORM\ManyToOne(targetEntity="SpecimenCollectionTool")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="specimen_collection_tool_id", referencedColumnName="specimen_collection_tool_id")
     * })
     */
    private $specimenCollectionTool;



    /**
     * Get organizationSpecimenCollectionToolLinkId
     *
     * @return integer 
     */
    public function getOrganizationSpecimenCollectionToolLinkId()
    {
        return $this->organizationSpecimenCollectionToolLinkId;
    }

    /**
     * Set organizationId
     *
     * @param integer $organizationId
     * @return OrganizationSpecimenCollectionToolLink
     */
    public function setOrganizationId($organizationId)
    {
        $this->organizationId = $organizationId;
    
        return $this;
    }

    /**
     * Get organizationId
     *
     * @return integer 
     */
    public function getOrganizationId()
    {
        return $this->organizationId;
    }

    /**
     * Set statusId
     *
     * @param integer $statusId
     * @return OrganizationSpecimenCollectionToolLink
     */
    public function setStatusId($statusId)
    {
        $this->statusId = $statusId;
    
        return $this;
    }

    /**
     * Get statusId
     *
     * @return integer 
     */
    public function getStatusId()
    {
        return $this->statusId;
    }

    /**
     * Set specimenCollectionTool
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\SpecimenCollectionTool $specimenCollectionTool
     * @return OrganizationSpecimenCollectionToolLink
     */
    public function setSpecimenCollectionTool(\Cyclogram\Bundle\ProofPilotBundle\Entity\SpecimenCollectionTool $specimenCollectionTool = null)
    {
        $this->specimenCollectionTool = $specimenCollectionTool;
    
        return $this;
    }

    /**
     * Get specimenCollectionTool
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\SpecimenCollectionTool 
     */
    public function getSpecimenCollectionTool()
    {
        return $this->specimenCollectionTool;
    }
}