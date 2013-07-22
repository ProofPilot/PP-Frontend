<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeParticipantAttributeValues
 *
 * @ORM\Table(name="lime_participant_attribute_values")
 * @ORM\Entity
 */
class LimeParticipantAttributeValues
{
    /**
     * @var integer
     *
     * @ORM\Column(name="value_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $valueId;

    /**
     * @var integer
     *
     * @ORM\Column(name="attribute_id", type="integer", nullable=false)
     */
    private $attributeId;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text", nullable=false)
     */
    private $value;


}
