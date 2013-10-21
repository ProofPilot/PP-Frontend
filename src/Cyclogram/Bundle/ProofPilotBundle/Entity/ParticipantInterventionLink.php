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
 * ParticipantInterventionLink
 *
 * @ORM\Table(name="participant_intervention_link")
 * @ORM\Entity(repositoryClass="Cyclogram\Bundle\ProofPilotBundle\Repository\ParticipantInterventionLinkRepository")
 */
class ParticipantInterventionLink
{
    const STATUS_ACTIVE = 1;
    const STATUS_CLOSED = 11;
    /**
     * @var integer
     *
     * @ORM\Column(name="participant_intervention_link_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $participantInterventionLinkId;

    /**
     * @var string
     *
     * @ORM\Column(name="participant_intervention_link_name", type="string", length=100, nullable=true)
     */
    private $participantInterventionLinkName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="participant_intervention_link_datetime_start", type="datetime", nullable=false)
     */
    private $participantInterventionLinkDatetimeStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="participant_intervention_link_send_time", type="datetime", nullable=true)
     */
    private $sendTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="participant_intervention_link_datetime_end", type="datetime", nullable=true)
     */
    private $participantInterventionLinkDatetimeEnd;

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
     * @var \Participant
     *
     * @ORM\ManyToOne(targetEntity="Participant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="participant_id", referencedColumnName="participant_id")
     * })
     */
    private $participant;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=false)
     */
    private $status;

    /**
     * Get participantInterventionLinkId
     *
     * @return integer 
     */
    public function getParticipantInterventionLinkId()
    {
        return $this->participantInterventionLinkId;
    }

    /**
     * Set participantInterventionLinkName
     *
     * @param string $participantInterventionLinkName
     * @return ParticipantInterventionLink
     */
    public function setParticipantInterventionLinkName(
            $participantInterventionLinkName)
    {
        $this->participantInterventionLinkName = $participantInterventionLinkName;

        return $this;
    }

    /**
     * Get participantInterventionLinkName
     *
     * @return string 
     */
    public function getParticipantInterventionLinkName()
    {
        return $this->participantInterventionLinkName;
    }

    /**
     * Set participantInterventionLinkDatetimeStart
     *
     * @param \DateTime $participantInterventionLinkDatetimeStart
     * @return ParticipantInterventionLink
     */
    public function setParticipantInterventionLinkDatetimeStart(
            $participantInterventionLinkDatetimeStart)
    {
        $this->participantInterventionLinkDatetimeStart = $participantInterventionLinkDatetimeStart;

        return $this;
    }

    /**
     * Get participantInterventionLinkDatetimeStart
     *
     * @return \DateTime 
     */
    public function getParticipantInterventionLinkDatetimeStart()
    {
        return $this->participantInterventionLinkDatetimeStart;
    }

    /**
     * Set participantInterventionLinkDatetimeEnd
     *
     * @param \DateTime $participantInterventionLinkDatetimeEnd
     * @return ParticipantInterventionLink
     */
    public function setParticipantInterventionLinkDatetimeEnd(
            $participantInterventionLinkDatetimeEnd)
    {
        $this->participantInterventionLinkDatetimeEnd = $participantInterventionLinkDatetimeEnd;

        return $this;
    }

    /**
     * Get participantInterventionLinkDatetimeEnd
     *
     * @return \DateTime 
     */
    public function getParticipantInterventionLinkDatetimeEnd()
    {
        return $this->participantInterventionLinkDatetimeEnd;
    }

    /**
     * Set intervention
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Intervention $intervention
     * @return ParticipantInterventionLink
     */
    public function setIntervention(
            \Cyclogram\Bundle\ProofPilotBundle\Entity\Intervention $intervention = null)
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
     * Set participant
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participant
     * @return ParticipantInterventionLink
     */
    public function setParticipant(
            \Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participant = null)
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
     * @return ParticipantInterventionLink
     */
    public function setStatus($status)
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

    public function getSendTime()
    {
        return $this->sendTime;
    }

    public function setSendTime($sendTime)
    {
        $this->sendTime = $sendTime;
    }

}
