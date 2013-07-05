<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RepresentativeSurveyLink
 *
 * @ORM\Table(name="representative_survey_link")
 * @ORM\Entity
 */
class RepresentativeSurveyLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="representative_survey_link_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $representativeSurveyLinkId;

    /**
     * @var integer
     *
     * @ORM\Column(name="sid_id", type="integer", nullable=false)
     */
    private $sidId;

    /**
     * @var integer
     *
     * @ORM\Column(name="save_id", type="integer", nullable=false)
     */
    private $saveId;

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
     * @var \AdverseReaction
     *
     * @ORM\ManyToOne(targetEntity="AdverseReaction")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="adverse_reaction_id", referencedColumnName="adverse_reaction_id")
     * })
     */
    private $adverseReaction;

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
     * Get representativeSurveyLinkId
     *
     * @return integer 
     */
    public function getRepresentativeSurveyLinkId()
    {
        return $this->representativeSurveyLinkId;
    }

    /**
     * Set sidId
     *
     * @param integer $sidId
     * @return RepresentativeSurveyLink
     */
    public function setSidId($sidId)
    {
        $this->sidId = $sidId;
    
        return $this;
    }

    /**
     * Get sidId
     *
     * @return integer 
     */
    public function getSidId()
    {
        return $this->sidId;
    }

    /**
     * Set saveId
     *
     * @param integer $saveId
     * @return RepresentativeSurveyLink
     */
    public function setSaveId($saveId)
    {
        $this->saveId = $saveId;
    
        return $this;
    }

    /**
     * Get saveId
     *
     * @return integer 
     */
    public function getSaveId()
    {
        return $this->saveId;
    }

    /**
     * Set participant
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participant
     * @return RepresentativeSurveyLink
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
     * Set adverseReaction
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\AdverseReaction $adverseReaction
     * @return RepresentativeSurveyLink
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
     * Set representative
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Representative $representative
     * @return RepresentativeSurveyLink
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
}