<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParticipantContactTime
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ParticipantContactTime
{
    /**
     * @var integer
     *
     * @ORM\Column(name="participantContactTimesId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $participantContactTimesId;

    /**
     * @var string
     *
     * @ORM\Column(name="participantContactTimesName", type="string", length=45)
     */
    private $participantContactTimesName;


    /**
     * Set participantContactTimesId
     *
     * @param integer $participantContactTimesId
     * @return ParticipantContactTime
     */
    public function setParticipantContactTimesId($participantContactTimesId)
    {
        $this->participantContactTimesId = $participantContactTimesId;
    
        return $this;
    }

    /**
     * Get participantContactTimesId
     *
     * @return integer 
     */
    public function getParticipantContactTimesId()
    {
        return $this->participantContactTimesId;
    }

    /**
     * Set participantContactTimesName
     *
     * @param string $participantContactTimesName
     * @return ParticipantContactTime
     */
    public function setParticipantContactTimesName($participantContactTimesName)
    {
        $this->participantContactTimesName = $participantContactTimesName;
    
        return $this;
    }

    /**
     * Get participantContactTimesName
     *
     * @return string 
     */
    public function getParticipantContactTimesName()
    {
        return $this->participantContactTimesName;
    }
}
