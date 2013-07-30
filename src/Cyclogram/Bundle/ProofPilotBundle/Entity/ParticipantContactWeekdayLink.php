<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParticipantContactWeekdayLink
 *
 * @ORM\Table(name="participant_contact_weekday_link")
 * @ORM\Entity(repositoryClass="Cyclogram\Bundle\ProofPilotBundle\Repository\ParticipantContactWeekdayLinkRepository")
 */
class ParticipantContactWeekdayLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="participant_contact_weekday_link_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $participantContactWeekdaysLinkId;

    /**
     * @var integer
     *
     * @ORM\Column(name="weekday_id", type="integer", nullable=true)
     */
    private $weekdayId;

    /**
     * @var \Participant
     *
     * @ORM\ManyToOne(targetEntity="Participant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="participant_id", referencedColumnName="participant_id")
     * })
     */
    private $participant;



    public function getParticipantContactWeekdaysLinkId()
    {
        return $this->participantContactWeekdaysLinkId;
    }

    public function setParticipantContactWeekdaysLinkId($participantContactWeekdaysLinkId)
    {
        $this->participantContactWeekdaysLinkId = $participantContactWeekdaysLinkId;
    }

    public function getWeekdayId()
    {
        return $this->weekdayId;
    }

    public function setWeekdayId($weekdayId)
    {
        $this->weekdayId = $weekdayId;
    }

    public function getParticipant()
    {
        return $this->participant;
    }

    public function setParticipant($participant)
    {
        $this->participant = $participant;
    }
}
