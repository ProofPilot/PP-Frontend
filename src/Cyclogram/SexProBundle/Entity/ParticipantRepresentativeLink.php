<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParticipantRepresentativeLink
 *
 * @ORM\Table(name="participant_representative_link")
 * @ORM\Entity
 */
class ParticipantRepresentativeLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="participant_representative_link_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $participantRepresentativeLinkId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="participant_representative_link_last_touch", type="datetime", nullable=true)
     */
    private $participantRepresentativeLinkLastTouch;

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
     * Get participantRepresentativeLinkId
     *
     * @return integer 
     */
    public function getParticipantRepresentativeLinkId()
    {
        return $this->participantRepresentativeLinkId;
    }

    /**
     * Set participantRepresentativeLinkLastTouch
     *
     * @param \DateTime $participantRepresentativeLinkLastTouch
     * @return ParticipantRepresentativeLink
     */
    public function setParticipantRepresentativeLinkLastTouch($participantRepresentativeLinkLastTouch)
    {
        $this->participantRepresentativeLinkLastTouch = $participantRepresentativeLinkLastTouch;
    
        return $this;
    }

    /**
     * Get participantRepresentativeLinkLastTouch
     *
     * @return \DateTime 
     */
    public function getParticipantRepresentativeLinkLastTouch()
    {
        return $this->participantRepresentativeLinkLastTouch;
    }

    /**
     * Set participant
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participant
     * @return ParticipantRepresentativeLink
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
     * @return ParticipantRepresentativeLink
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