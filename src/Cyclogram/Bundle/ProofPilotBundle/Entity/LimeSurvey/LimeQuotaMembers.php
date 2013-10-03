<?php
/*
* This is part of the ProofPilot package.
*
* (c)2012-2013 Cyclogram, Inc, West Hollywood, CA <crew@proofpilot.com>
* ALL RIGHTS RESERVED
*
* This software is provided by the copyright holders to Manila Consulting for use on the
* Center for Disease Control's Evaluation of Rapid HIV Self-Testing among MSM in High
* Prevalence Cities until 2016 or the project is completed.
*
* Any unauthorized use, modification or resale is not permitted without expressed permission
* from the copyright holders.
*
* KnowatHome branding, URL, study logic, survey instruments, and resulting data are not part
* of this copyright and remain the property of the prime contractor.
*
*/

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
