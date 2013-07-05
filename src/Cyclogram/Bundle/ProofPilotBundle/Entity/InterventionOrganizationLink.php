<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InterventionOrganizationLink
 *
 * @ORM\Table(name="intervention_organization_link")
 * @ORM\Entity
 */
class InterventionOrganizationLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="intervention_organization_link_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $interventionOrganizationLinkId;

    /**
     * @var \Intervention
     *
     * @ORM\ManyToOne(targetEntity="Intervention")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="intervention_id", referencedColumnName="intervention_id")
     * })
     */
    private $intervention;

    /**
     * @var \Organization
     *
     * @ORM\ManyToOne(targetEntity="Organization")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="organization_id", referencedColumnName="organization_id")
     * })
     */
    private $organization;



    /**
     * Get interventionOrganizationLinkId
     *
     * @return integer 
     */
    public function getInterventionOrganizationLinkId()
    {
        return $this->interventionOrganizationLinkId;
    }

    /**
     * Set intervention
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Intervention $intervention
     * @return InterventionOrganizationLink
     */
    public function setIntervention(\Cyclogram\Bundle\ProofPilotBundle\Entity\Intervention $intervention = null)
    {
        $this->intervention = $intervention;
    
        return $this;
    }

    /**
     * Get intervention
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Intervention 
     */
    public function getIntervention()
    {
        return $this->intervention;
    }

    /**
     * Set organization
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Organization $organization
     * @return InterventionOrganizationLink
     */
    public function setOrganization(\Cyclogram\Bundle\ProofPilotBundle\Entity\Organization $organization = null)
    {
        $this->organization = $organization;
    
        return $this;
    }

    /**
     * Get organization
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Organization 
     */
    public function getOrganization()
    {
        return $this->organization;
    }
}