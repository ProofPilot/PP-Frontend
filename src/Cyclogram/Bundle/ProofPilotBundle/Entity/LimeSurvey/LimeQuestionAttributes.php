<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeQuestionAttributes
 *
 * @ORM\Table(name="lime_question_attributes")
 * @ORM\Entity
 */
class LimeQuestionAttributes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="qaid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $qaid;

    /**
     * @var integer
     *
     * @ORM\Column(name="qid", type="integer", nullable=false)
     */
    private $qid;

    /**
     * @var string
     *
     * @ORM\Column(name="attribute", type="string", length=50, nullable=true)
     */
    private $attribute;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text", nullable=true)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=20, nullable=true)
     */
    private $language;


}
