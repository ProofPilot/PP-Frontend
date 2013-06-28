<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdverseReaction
 *
 * @ORM\Table(name="adverse_reaction")
 * @ORM\Entity
 */
class AdverseReaction
{
    /**
     * @var integer
     *
     * @ORM\Column(name="adverse_reaction_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $adverseReactionId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="adverse_reaction_datetime_creation", type="datetime", nullable=false)
     */
    private $adverseReactionDatetimeCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="adverse_reaction_datetime_lastcontact", type="datetime", nullable=true)
     */
    private $adverseReactionDatetimeLastcontact;

    /**
     * @var \InterventionType
     *
     * @ORM\ManyToOne(targetEntity="InterventionType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="intervention_type_id", referencedColumnName="intervention_type_id")
     * })
     */
    private $interventionType;

    /**
     * @var \Participant
     *
     * @ORM\ManyToOne(targetEntity="Participant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="participant_id", referencedColumnName="participant_id")
     * })
     */
    private $participant;

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
     * @var \Study
     *
     * @ORM\ManyToOne(targetEntity="Study")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="study_id", referencedColumnName="study_id")
     * })
     */
    private $study;



    /**
     * Get adverseReactionId
     *
     * @return integer 
     */
    public function getAdverseReactionId()
    {
        return $this->adverseReactionId;
    }

    /**
     * Set adverseReactionDatetimeCreation
     *
     * @param \DateTime $adverseReactionDatetimeCreation
     * @return AdverseReaction
     */
    public function setAdverseReactionDatetimeCreation($adverseReactionDatetimeCreation)
    {
        $this->adverseReactionDatetimeCreation = $adverseReactionDatetimeCreation;
    
        return $this;
    }

    /**
     * Get adverseReactionDatetimeCreation
     *
     * @return \DateTime 
     */
    public function getAdverseReactionDatetimeCreation()
    {
        return $this->adverseReactionDatetimeCreation;
    }

    /**
     * Set adverseReactionDatetimeLastcontact
     *
     * @param \DateTime $adverseReactionDatetimeLastcontact
     * @return AdverseReaction
     */
    public function setAdverseReactionDatetimeLastcontact($adverseReactionDatetimeLastcontact)
    {
        $this->adverseReactionDatetimeLastcontact = $adverseReactionDatetimeLastcontact;
    
        return $this;
    }

    /**
     * Get adverseReactionDatetimeLastcontact
     *
     * @return \DateTime 
     */
    public function getAdverseReactionDatetimeLastcontact()
    {
        return $this->adverseReactionDatetimeLastcontact;
    }

    /**
     * Set interventionType
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\InterventionType $interventionType
     * @return AdverseReaction
     */
    public function setInterventionType(\Cyclogram\Bundle\ProofPilotBundle\Entity\InterventionType $interventionType = null)
    {
        $this->interventionType = $interventionType;
    
        return $this;
    }

    /**
     * Get interventionType
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\InterventionType 
     */
    public function getInterventionType()
    {
        return $this->interventionType;
    }

    /**
     * Set participant
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participant
     * @return AdverseReaction
     */
    public function setParticipant(\Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participant = null)
    {
        $this->participant = $participant;
    
        return $this;
    }

    /**
     * Get participant
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Participant 
     */
    public function getParticipant()
    {
        return $this->participant;
    }

    /**
     * Set representative
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Representative $representative
     * @return AdverseReaction
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
     * @return AdverseReaction
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

    /**
     * Set study
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study
     * @return AdverseReaction
     */
    public function setStudy(\Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study = null)
    {
        $this->study = $study;
    
        return $this;
    }

    /**
     * Get study
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Study 
     */
    public function getStudy()
    {
        return $this->study;
    }
}