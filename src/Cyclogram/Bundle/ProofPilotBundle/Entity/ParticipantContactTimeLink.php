<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParticipantContactTimeLink
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ParticipantContactTimeLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="participantContactTimeLinkId", type="integer")
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
     * @ORM\Column(name="participantContactTimeStart", type="datetime")
     */
    private $participantContactTimeStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="participantContactTimeEnd", type="datetime")
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
     * @ORM\Column(name="participantDayOfWeek", type="integer")
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
    private $participantId;

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
     * Set participantId
     *
     * @param integer $participantId
     * @return ParticipantContactTimeLink
     */
    public function setParticipantId(\Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participantId = null)
    {
        $this->participantId = $participantId;
    
        return $this;
    }

    /**
     * Get participantId
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Participant
     */
    public function getParticipantId()
    {
        return $this->participantId;
    }
}
