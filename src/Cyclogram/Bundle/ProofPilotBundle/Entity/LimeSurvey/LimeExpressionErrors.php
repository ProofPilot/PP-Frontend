<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeExpressionErrors
 *
 * @ORM\Table(name="lime_expression_errors")
 * @ORM\Entity
 */
class LimeExpressionErrors
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="errortime", type="string", length=50, nullable=true)
     */
    private $errortime;

    /**
     * @var integer
     *
     * @ORM\Column(name="sid", type="integer", nullable=true)
     */
    private $sid;

    /**
     * @var integer
     *
     * @ORM\Column(name="gid", type="integer", nullable=true)
     */
    private $gid;

    /**
     * @var integer
     *
     * @ORM\Column(name="qid", type="integer", nullable=true)
     */
    private $qid;

    /**
     * @var integer
     *
     * @ORM\Column(name="gseq", type="integer", nullable=true)
     */
    private $gseq;

    /**
     * @var integer
     *
     * @ORM\Column(name="qseq", type="integer", nullable=true)
     */
    private $qseq;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="eqn", type="text", nullable=true)
     */
    private $eqn;

    /**
     * @var string
     *
     * @ORM\Column(name="prettyprint", type="text", nullable=true)
     */
    private $prettyprint;


}
