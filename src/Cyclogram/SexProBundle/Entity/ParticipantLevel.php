<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParticipantLevel
 *
 * @ORM\Table(name="participant_level")
 * @ORM\Entity
 */
class ParticipantLevel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="participant_level_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $participantLevelId;

    /**
     * @var string
     *
     * @ORM\Column(name="participant_level_name", type="string", length=45, nullable=true)
     */
    private $participantLevelName;

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
     * Get participantLevelId
     *
     * @return integer 
     */
    public function getParticipantLevelId()
    {
        return $this->participantLevelId;
    }

    /**
     * Set participantLevelName
     *
     * @param string $participantLevelName
     * @return ParticipantLevel
     */
    public function setParticipantLevelName($participantLevelName)
    {
        $this->participantLevelName = $participantLevelName;
    
        return $this;
    }

    /**
     * Get participantLevelName
     *
     * @return string 
     */
    public function getParticipantLevelName()
    {
        return $this->participantLevelName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return ParticipantLevel
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