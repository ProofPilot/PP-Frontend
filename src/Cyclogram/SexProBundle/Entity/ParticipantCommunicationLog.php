<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParticipantCommunicationLog
 *
 * @ORM\Table(name="participant_communication_log")
 * @ORM\Entity
 */
class ParticipantCommunicationLog
{
    /**
     * @var integer
     *
     * @ORM\Column(name="participant_communication_log_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $participantCommunicationLogId;

    /**
     * @var string
     *
     * @ORM\Column(name="participant_communication_log_subject", type="string", length=100, nullable=true)
     */
    private $participantCommunicationLogSubject;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="participant_communication_log_datetime", type="datetime", nullable=false)
     */
    private $participantCommunicationLogDatetime;

    /**
     * @var string
     *
     * @ORM\Column(name="participant_communication_log_text", type="string", length=1000, nullable=false)
     */
    private $participantCommunicationLogText;

    /**
     * @var integer
     *
     * @ORM\Column(name="from_id", type="integer", nullable=false)
     */
    private $fromId;

    /**
     * @var integer
     *
     * @ORM\Column(name="to_id", type="integer", nullable=false)
     */
    private $toId;

    /**
     * @var \CommunicationChannel
     *
     * @ORM\ManyToOne(targetEntity="CommunicationChannel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="communication_channel_id", referencedColumnName="communication_channel_id")
     * })
     */
    private $communicationChannel;

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
     * @var \Participant
     *
     * @ORM\ManyToOne(targetEntity="Participant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="participant_id", referencedColumnName="participant_id")
     * })
     */
    private $participant;

    /**
     * @var \Sender
     *
     * @ORM\ManyToOne(targetEntity="Sender")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="from_sender_id", referencedColumnName="sender_id")
     * })
     */
    private $fromSender;

    /**
     * @var \Sender
     *
     * @ORM\ManyToOne(targetEntity="Sender")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="to_sender_id", referencedColumnName="sender_id")
     * })
     */
    private $toSender;

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
     * Get participantCommunicationLogId
     *
     * @return integer 
     */
    public function getParticipantCommunicationLogId()
    {
        return $this->participantCommunicationLogId;
    }

    /**
     * Set participantCommunicationLogSubject
     *
     * @param string $participantCommunicationLogSubject
     * @return ParticipantCommunicationLog
     */
    public function setParticipantCommunicationLogSubject($participantCommunicationLogSubject)
    {
        $this->participantCommunicationLogSubject = $participantCommunicationLogSubject;
    
        return $this;
    }

    /**
     * Get participantCommunicationLogSubject
     *
     * @return string 
     */
    public function getParticipantCommunicationLogSubject()
    {
        return $this->participantCommunicationLogSubject;
    }

    /**
     * Set participantCommunicationLogDatetime
     *
     * @param \DateTime $participantCommunicationLogDatetime
     * @return ParticipantCommunicationLog
     */
    public function setParticipantCommunicationLogDatetime($participantCommunicationLogDatetime)
    {
        $this->participantCommunicationLogDatetime = $participantCommunicationLogDatetime;
    
        return $this;
    }

    /**
     * Get participantCommunicationLogDatetime
     *
     * @return \DateTime 
     */
    public function getParticipantCommunicationLogDatetime()
    {
        return $this->participantCommunicationLogDatetime;
    }

    /**
     * Set participantCommunicationLogText
     *
     * @param string $participantCommunicationLogText
     * @return ParticipantCommunicationLog
     */
    public function setParticipantCommunicationLogText($participantCommunicationLogText)
    {
        $this->participantCommunicationLogText = $participantCommunicationLogText;
    
        return $this;
    }

    /**
     * Get participantCommunicationLogText
     *
     * @return string 
     */
    public function getParticipantCommunicationLogText()
    {
        return $this->participantCommunicationLogText;
    }

    /**
     * Set fromId
     *
     * @param integer $fromId
     * @return ParticipantCommunicationLog
     */
    public function setFromId($fromId)
    {
        $this->fromId = $fromId;
    
        return $this;
    }

    /**
     * Get fromId
     *
     * @return integer 
     */
    public function getFromId()
    {
        return $this->fromId;
    }

    /**
     * Set toId
     *
     * @param integer $toId
     * @return ParticipantCommunicationLog
     */
    public function setToId($toId)
    {
        $this->toId = $toId;
    
        return $this;
    }

    /**
     * Get toId
     *
     * @return integer 
     */
    public function getToId()
    {
        return $this->toId;
    }

    /**
     * Set communicationChannel
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\CommunicationChannel $communicationChannel
     * @return ParticipantCommunicationLog
     */
    public function setCommunicationChannel(\Cyclogram\Bundle\ProofPilotBundle\Entity\CommunicationChannel $communicationChannel = null)
    {
        $this->communicationChannel = $communicationChannel;
    
        return $this;
    }

    /**
     * Get communicationChannel
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\CommunicationChannel 
     */
    public function getCommunicationChannel()
    {
        return $this->communicationChannel;
    }

    /**
     * Set organization
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Organization $organization
     * @return ParticipantCommunicationLog
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
     * Set participant
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participant
     * @return ParticipantCommunicationLog
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
     * Set fromSender
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Sender $fromSender
     * @return ParticipantCommunicationLog
     */
    public function setFromSender(\Cyclogram\Bundle\ProofPilotBundle\Entity\Sender $fromSender = null)
    {
        $this->fromSender = $fromSender;
    
        return $this;
    }

    /**
     * Get fromSender
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Sender 
     */
    public function getFromSender()
    {
        return $this->fromSender;
    }

    /**
     * Set toSender
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Sender $toSender
     * @return ParticipantCommunicationLog
     */
    public function setToSender(\Cyclogram\Bundle\ProofPilotBundle\Entity\Sender $toSender = null)
    {
        $this->toSender = $toSender;
    
        return $this;
    }

    /**
     * Get toSender
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Sender 
     */
    public function getToSender()
    {
        return $this->toSender;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return ParticipantCommunicationLog
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