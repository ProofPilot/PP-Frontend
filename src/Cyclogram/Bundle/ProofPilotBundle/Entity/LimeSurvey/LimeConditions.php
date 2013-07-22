<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeConditions
 *
 * @ORM\Table(name="lime_conditions")
 * @ORM\Entity
 */
class LimeConditions
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cid;

    /**
     * @var integer
     *
     * @ORM\Column(name="qid", type="integer", nullable=false)
     */
    private $qid;

    /**
     * @var integer
     *
     * @ORM\Column(name="scenario", type="integer", nullable=false)
     */
    private $scenario;

    /**
     * @var integer
     *
     * @ORM\Column(name="cqid", type="integer", nullable=false)
     */
    private $cqid;

    /**
     * @var string
     *
     * @ORM\Column(name="cfieldname", type="string", length=50, nullable=false)
     */
    private $cfieldname;

    /**
     * @var string
     *
     * @ORM\Column(name="method", type="string", length=5, nullable=false)
     */
    private $method;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255, nullable=false)
     */
    private $value;


}
