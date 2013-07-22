<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeParticipantAttributeNames
 *
 * @ORM\Table(name="lime_participant_attribute_names")
 * @ORM\Entity
 */
class LimeParticipantAttributeNames
{
    /**
     * @var integer
     *
     * @ORM\Column(name="attribute_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $attributeId;

    /**
     * @var string
     *
     * @ORM\Column(name="attribute_type", type="string", length=4, nullable=false)
     */
    private $attributeType;

    /**
     * @var string
     *
     * @ORM\Column(name="visible", type="string", length=5, nullable=false)
     */
    private $visible;


}
