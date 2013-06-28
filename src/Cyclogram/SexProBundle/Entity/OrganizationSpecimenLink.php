<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrganizationSpecimenLink
 *
 * @ORM\Table(name="organization_specimen_link")
 * @ORM\Entity
 */
class OrganizationSpecimenLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="organization_speciment_link_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $organizationSpecimentLinkId;

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
     * @var \Specimen
     *
     * @ORM\ManyToOne(targetEntity="Specimen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="specimen_id", referencedColumnName="specimen_id")
     * })
     */
    private $specimen;



    /**
     * Get organizationSpecimentLinkId
     *
     * @return integer 
     */
    public function getOrganizationSpecimentLinkId()
    {
        return $this->organizationSpecimentLinkId;
    }

    /**
     * Set organizationId
     *
     * @param integer $organizationId
     * @return OrganizationSpecimenLink
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
     * @return OrganizationSpecimenLink
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
     * Set specimen
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Specimen $specimen
     * @return OrganizationSpecimenLink
     */
    public function setSpecimen(\Cyclogram\Bundle\ProofPilotBundle\Entity\Specimen $specimen = null)
    {
        $this->specimen = $specimen;
    
        return $this;
    }

    /**
     * Get specimen
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Specimen 
     */
    public function getSpecimen()
    {
        return $this->specimen;
    }
}