<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParticipantTimezone
 *
 * @ORM\Table("participant_timezone")
 * @ORM\Entity
 */
class ParticipantTimezone
{
    /**
     * @var integer
     *
     * @ORM\Column(name="participant_timezone_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $participantTimezoneId;

    /**
     * @var string
     *
     * @ORM\Column(name="participant_timezone_desc", type="string", length=45)
     */
    private $participantTimezoneDesc;

    /**
     * Set participantTimezoneId
     *
     * @param integer $participantTimezoneId
     * @return ParticipantTimezone
     */
    public function setParticipantTimezoneId($participantTimezoneId)
    {
        $this->participantTimezoneId = $participantTimezoneId;
    
        return $this;
    }

    /**
     * Get participantTimezoneId
     *
     * @return integer 
     */
    public function getParticipantTimezoneId()
    {
        return $this->participantTimezoneId;
    }

    /**
     * Set participantTimezoneDesc
     *
     * @param string $participantTimezoneDesc
     * @return ParticipantTimezone
     */
    public function setParticipantTimezoneDesc($participantTimezoneDesc)
    {
        $this->participantTimezoneDesc = $participantTimezoneDesc;
    
        return $this;
    }

    /**
     * Get participantTimezoneDesc
     *
     * @return string 
     */
    public function getParticipantTimezoneDesc()
    {
        return $this->participantTimezoneDesc;
    }
}
