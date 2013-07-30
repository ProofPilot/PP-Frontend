<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParticipantContactTimeLink
 *
 * @ORM\Table(name="participant_contact_time_link")
 * @ORM\Entity(repositoryClass="Cyclogram\Bundle\ProofPilotBundle\Repository\ParticipantContactTimeLinkRepository")
 */
class ParticipantContactTimeLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="participant_contact_time_link_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $participantContactTimeLinkId;

    /**
     * @var \ParticipantContactTime
     *
     * @ORM\ManyToOne(targetEntity="ParticipantContactTime")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="participant_contact_time_id", referencedColumnName="participant_contact_time_id")
     * })
     */
    private $participantContactTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="participant_contact_time_start", type="datetime")
     */
    private $participantContactTimeStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="participant_contact_time_end", type="datetime")
     */
    private $participantContactTimeEnd;

    /**
     * @var \ParticipantTimezone
     *
     * @ORM\ManyToOne(targetEntity="ParticipantTimezone")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="participant_timezone_id", referencedColumnName="participant_timezone_id")
     * })
     */
    private $participantTimezone;

    /**
     * @var integer
     *
     * @ORM\Column(name="participant_day_of_week", type="integer")
     */
    private $participantDayOfWeek;

    /**
     * @var \Participant
     *
     * @ORM\ManyToOne(targetEntity="Participant")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="participant_id", referencedColumnName="participant_id")
     * })
     */
    private $participant;

    /**
     * Set participantContactTimeLinkId
     *
     * @param integer $participantContactTimeLinkId
     * @return ParticipantContactTimeLink
     */
    public function setParticipantContactTimeLinkId($participantContactTimeLinkId)
    {
        $this->participantContactTimeLinkId = $participantContactTimeLinkId;
    
        return $this;
    }

    /**
     * Get participantContactTimeLinkId
     *
     * @return integer 
     */
    public function getParticipantContactTimeLinkId()
    {
        return $this->participantContactTimeLinkId;
    }

    /**
     * Set participantContactTime
     *
     * @param integer $participantContactTime
     * @return ParticipantContactTimeLink
     */
    public function setParticipantContactTime(\Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantContactTime $participantContactTime = null)
    {
        $this->participantContactTime = $participantContactTime;
    
        return $this;
    }

    /**
     * Get participantContactTime
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantContactTime
     */
    public function getParticipantContactTime()
    {
        return $this->participantContactTime;
    }

    /**
     * Set participantContactTimeStart
     *
     * @param \DateTime $participantContactTimeStart
     * @return ParticipantContactTimeLink
     */
    public function setParticipantContactTimeStart($participantContactTimeStart)
    {
        $this->participantContactTimeStart = $participantContactTimeStart;
    
        return $this;
    }

    /**
     * Get participantContactTimeStart
     *
     * @return \DateTime 
     */
    public function getParticipantContactTimeStart()
    {
        return $this->participantContactTimeStart;
    }

    /**
     * Set participantContactTimeEnd
     *
     * @param \DateTime $participantContactTimeEnd
     * @return ParticipantContactTimeLink
     */
    public function setParticipantContactTimeEnd($participantContactTimeEnd)
    {
        $this->participantContactTimeEnd = $participantContactTimeEnd;
    
        return $this;
    }

    /**
     * Get participantContactTimeEnd
     *
     * @return \DateTime 
     */
    public function getParticipantContactTimeEnd()
    {
        return $this->participantContactTimeEnd;
    }

    /**
     * Set participantTimezone
     *
     * @param integer $participantTimezone
     * @return ParticipantContactTimeLink
     */
    public function setParticipantTimezone(\Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantTimezone $participantTimezone = null)
    {
        $this->participantTimezone = $participantTimezone;
    
        return $this;
    }

    /**
     * Get participantTimezone
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantTimeZone
     */
    public function getParticipantTimezone()
    {
        return $this->participantTimezone;
    }

    /**
     * Set participantDayOfWeek
     *
     * @param integer $participantDayOfWeek
     * @return ParticipantContactTimeLink
     */
    public function setParticipantDayOfWeek($participantDayOfWeek)
    {
        $this->participantDayOfWeek = $participantDayOfWeek;
    
        return $this;
    }

    /**
     * Get participantDayOfWeek
     *
     * @return integer 
     */
    public function getParticipantDayOfWeek()
    {
        return $this->participantDayOfWeek;
    }

    /**
     * Set participant
     *
     * @param integer $participant
     * @return ParticipantContactTimeLink
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
}
