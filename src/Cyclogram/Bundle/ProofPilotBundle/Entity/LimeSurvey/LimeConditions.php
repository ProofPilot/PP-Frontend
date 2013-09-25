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
