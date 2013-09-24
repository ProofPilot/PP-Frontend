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
 * AdverseReactionReferal
 *
 * @ORM\Table(name="adverse_reaction_referal")
 * @ORM\Entity
 */
class AdverseReactionReferal
{
    /**
     * @var integer
     *
     * @ORM\Column(name="adverse_reaction_referal_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $adverseReactionReferalId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="adverse_reaction_referal_datetime", type="datetime", nullable=false)
     */
    private $adverseReactionReferalDatetime;

    /**
     * @var \AdverseReaction
     *
     * @ORM\ManyToOne(targetEntity="AdverseReaction")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="adverse_reaction_id", referencedColumnName="adverse_reaction_id")
     * })
     */
    private $adverseReaction;

    /**
     * @var \Individual
     *
     * @ORM\ManyToOne(targetEntity="Individual")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="individual_id", referencedColumnName="individual_id")
     * })
     */
    private $individual;

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
     * @var \Representative
     *
     * @ORM\ManyToOne(targetEntity="Representative")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="representative_id", referencedColumnName="representative_id")
     * })
     */
    private $representative;

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
     * Get adverseReactionReferalId
     *
     * @return integer 
     */
    public function getAdverseReactionReferalId()
    {
        return $this->adverseReactionReferalId;
    }

    /**
     * Set adverseReactionReferalDatetime
     *
     * @param \DateTime $adverseReactionReferalDatetime
     * @return AdverseReactionReferal
     */
    public function setAdverseReactionReferalDatetime($adverseReactionReferalDatetime)
    {
        $this->adverseReactionReferalDatetime = $adverseReactionReferalDatetime;
    
        return $this;
    }

    /**
     * Get adverseReactionReferalDatetime
     *
     * @return \DateTime 
     */
    public function getAdverseReactionReferalDatetime()
    {
        return $this->adverseReactionReferalDatetime;
    }

    /**
     * Set adverseReaction
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\AdverseReaction $adverseReaction
     * @return AdverseReactionReferal
     */
    public function setAdverseReaction(\Cyclogram\Bundle\ProofPilotBundle\Entity\AdverseReaction $adverseReaction = null)
    {
        $this->adverseReaction = $adverseReaction;
    
        return $this;
    }

    /**
     * Get adverseReaction
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\AdverseReaction 
     */
    public function getAdverseReaction()
    {
        return $this->adverseReaction;
    }

    /**
     * Set individual
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Individual $individual
     * @return AdverseReactionReferal
     */
    public function setIndividual(\Cyclogram\Bundle\ProofPilotBundle\Entity\Individual $individual = null)
    {
        $this->individual = $individual;
    
        return $this;
    }

    /**
     * Get individual
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Individual 
     */
    public function getIndividual()
    {
        return $this->individual;
    }

    /**
     * Set organization
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Organization $organization
     * @return AdverseReactionReferal
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

    /**
     * Set representative
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Representative $representative
     * @return AdverseReactionReferal
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
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return AdverseReactionReferal
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
}