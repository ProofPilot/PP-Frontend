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
 * ParticipantCommunicationChannelLink
 *
 * @ORM\Table(name="participant_communication_channel_link")
 * @ORM\Entity
 */
class ParticipantCommunicationChannelLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="participant_communication_channel_link_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $participantCommunicationChannelLinkId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="participant_communication_channel_link_active", type="boolean", nullable=false)
     */
    private $participantCommunicationChannelLinkActive;

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
     * @var \Participant
     *
     * @ORM\ManyToOne(targetEntity="Participant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="participant_id", referencedColumnName="participant_id")
     * })
     */
    private $participant;

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
     * Get participantCommunicationChannelLinkId
     *
     * @return integer 
     */
    public function getParticipantCommunicationChannelLinkId()
    {
        return $this->participantCommunicationChannelLinkId;
    }

    /**
     * Set participantCommunicationChannelLinkActive
     *
     * @param boolean $participantCommunicationChannelLinkActive
     * @return ParticipantCommunicationChannelLink
     */
    public function setParticipantCommunicationChannelLinkActive($participantCommunicationChannelLinkActive)
    {
        $this->participantCommunicationChannelLinkActive = $participantCommunicationChannelLinkActive;
    
        return $this;
    }

    /**
     * Get participantCommunicationChannelLinkActive
     *
     * @return boolean 
     */
    public function getParticipantCommunicationChannelLinkActive()
    {
        return $this->participantCommunicationChannelLinkActive;
    }

    /**
     * Set communicationChannel
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\CommunicationChannel $communicationChannel
     * @return ParticipantCommunicationChannelLink
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
     * Set participant
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participant
     * @return ParticipantCommunicationChannelLink
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
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return ParticipantCommunicationChannelLink
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