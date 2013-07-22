<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeDefaultvalues
 *
 * @ORM\Table(name="lime_defaultvalues")
 * @ORM\Entity
 */
class LimeDefaultvalues
{
    /**
     * @var integer
     *
     * @ORM\Column(name="qid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $qid;

    /**
     * @var integer
     *
     * @ORM\Column(name="scale_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $scaleId;

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
     * @ORM\Column(name="specialtype", type="string", length=20, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $specialtype;

    /**
     * @var integer
     *
     * @ORM\Column(name="sqid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $sqid;

    /**
     * @var string
     *
     * @ORM\Column(name="defaultvalue", type="text", nullable=true)
     */
    private $defaultvalue;


}
