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
 * LimeQuestions
 *
 * @ORM\Table(name="lime_questions")
 * @ORM\Entity
 */
class LimeQuestions
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
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=20, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $language;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent_qid", type="integer", nullable=false)
     */
    private $parentQid;

    /**
     * @var integer
     *
     * @ORM\Column(name="sid", type="integer", nullable=false)
     */
    private $sid;

    /**
     * @var integer
     *
     * @ORM\Column(name="gid", type="integer", nullable=false)
     */
    private $gid;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=1, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=20, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="text", nullable=false)
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="preg", type="text", nullable=true)
     */
    private $preg;

    /**
     * @var string
     *
     * @ORM\Column(name="help", type="text", nullable=true)
     */
    private $help;

    /**
     * @var string
     *
     * @ORM\Column(name="other", type="string", length=1, nullable=false)
     */
    private $other;

    /**
     * @var string
     *
     * @ORM\Column(name="mandatory", type="string", length=1, nullable=true)
     */
    private $mandatory;

    /**
     * @var integer
     *
     * @ORM\Column(name="question_order", type="integer", nullable=false)
     */
    private $questionOrder;

    /**
     * @var integer
     *
     * @ORM\Column(name="scale_id", type="integer", nullable=false)
     */
    private $scaleId;

    /**
     * @var integer
     *
     * @ORM\Column(name="same_default", type="integer", nullable=false)
     */
    private $sameDefault;

    /**
     * @var string
     *
     * @ORM\Column(name="relevance", type="text", nullable=true)
     */
    private $relevance;


}
