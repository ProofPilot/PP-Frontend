<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParticipantRole
 *
 * @ORM\Table(name="participant_role")
 * @ORM\Entity
 */
class ParticipantRole
{
    /**
     * @var integer
     *
     * @ORM\Column(name="participant_role_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $participantRoleId;

    /**
     * @var string
     *
     * @ORM\Column(name="participant_role_name", type="string", length=45, nullable=false)
     */
    private $participantRoleName;



    /**
     * Get participantRoleId
     *
     * @return integer 
     */
    public function getParticipantRoleId()
    {
        return $this->participantRoleId;
    }

    /**
     * Set participantRoleName
     *
     * @param string $participantRoleName
     * @return ParticipantRole
     */
    public function setParticipantRoleName($participantRoleName)
    {
        $this->participantRoleName = $participantRoleName;
    
        return $this;
    }

    /**
     * Get participantRoleName
     *
     * @return string 
     */
    public function getParticipantRoleName()
    {
        return $this->participantRoleName;
    }
}