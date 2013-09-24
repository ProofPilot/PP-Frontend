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
