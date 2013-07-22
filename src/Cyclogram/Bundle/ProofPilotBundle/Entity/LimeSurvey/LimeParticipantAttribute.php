<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeParticipantAttribute
 *
 * @ORM\Table(name="lime_participant_attribute")
 * @ORM\Entity
 */
class LimeParticipantAttribute
{
    /**
     * @var string
     *
     * @ORM\Column(name="participant_id", type="string", length=50, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $participantId;

    /**
     * @var integer
     *
     * @ORM\Column(name="attribute_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $attributeId;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text", nullable=false)
     */
    private $value;


}
