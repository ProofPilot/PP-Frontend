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
     * @ORM\JoinColumn(name="participant_contact_time", referencedColumnName="participant_contact_times_id")
     * })
     */
    private $participantContactTime;



    /**
     * @var integer
     *
     * @ORM\Column(name="participant_weekday", type="integer", length=45)
     */
    private $participantWeekday;

    /**
     * @var \Participant
     *
     * @ORM\ManyToOne(targetEntity="Participant", inversedBy="contacttimelinks")
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
    public function setParticipantContactTimeLinkId(
            $participantContactTimeLinkId)
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
    public function setParticipantContactTime(
            \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantContactTime $participantContactTime = null)
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
     * Set participant
     *
     * @param integer $participant
     * @return ParticipantContactTimeLink
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


    public function getParticipantWeekday()
    {
        return $this->participantWeekday;
    }

    public function setParticipantWeekday($participantWeekday)
    {
        $this->participantWeekday = $participantWeekday;
    }

}
