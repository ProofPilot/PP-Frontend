<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeQuotaMembers
 *
 * @ORM\Table(name="lime_quota_members")
 * @ORM\Entity
 */
class LimeQuotaMembers
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
     * @var integer
     *
     * @ORM\Column(name="sid", type="integer", nullable=true)
     */
    private $sid;

    /**
     * @var integer
     *
     * @ORM\Column(name="qid", type="integer", nullable=true)
     */
    private $qid;

    /**
     * @var integer
     *
     * @ORM\Column(name="quota_id", type="integer", nullable=true)
     */
    private $quotaId;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=11, nullable=true)
     */
    private $code;


}
