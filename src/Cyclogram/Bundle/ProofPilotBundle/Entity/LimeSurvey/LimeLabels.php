<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeLabels
 *
 * @ORM\Table(name="lime_labels")
 * @ORM\Entity
 */
class LimeLabels
{
    /**
     * @var integer
     *
     * @ORM\Column(name="lid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $lid;

    /**
     * @var integer
     *
     * @ORM\Column(name="sortorder", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $sortorder;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=20, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $language;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=5, nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text", nullable=true)
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\Column(name="assessment_value", type="integer", nullable=false)
     */
    private $assessmentValue;


}
