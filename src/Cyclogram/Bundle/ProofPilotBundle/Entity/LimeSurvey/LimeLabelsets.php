<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeLabelsets
 *
 * @ORM\Table(name="lime_labelsets")
 * @ORM\Entity
 */
class LimeLabelsets
{
    /**
     * @var integer
     *
     * @ORM\Column(name="lid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $lid;

    /**
     * @var string
     *
     * @ORM\Column(name="label_name", type="string", length=100, nullable=false)
     */
    private $labelName;

    /**
     * @var string
     *
     * @ORM\Column(name="languages", type="string", length=200, nullable=true)
     */
    private $languages;


}
