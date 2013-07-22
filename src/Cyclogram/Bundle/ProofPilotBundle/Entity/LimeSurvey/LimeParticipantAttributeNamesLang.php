<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeParticipantAttributeNamesLang
 *
 * @ORM\Table(name="lime_participant_attribute_names_lang")
 * @ORM\Entity
 */
class LimeParticipantAttributeNamesLang
{
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
     * @ORM\Column(name="lang", type="string", length=20, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $lang;

    /**
     * @var string
     *
     * @ORM\Column(name="attribute_name", type="string", length=255, nullable=false)
     */
    private $attributeName;


}
