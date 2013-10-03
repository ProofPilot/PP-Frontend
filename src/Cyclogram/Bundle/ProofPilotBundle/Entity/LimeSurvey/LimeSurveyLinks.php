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
 * LimeSurveyLinks
 *
 * @ORM\Table(name="lime_survey_links")
 * @ORM\Entity
 */
class LimeSurveyLinks
{
    /**
     * @var string
     *
     * @ORM\Column(name="participant_id", type="string", length=50, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $participantId;

    /**
     * @var integer
     *
     * @ORM\Column(name="token_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $tokenId;

    /**
     * @var integer
     *
     * @ORM\Column(name="survey_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $surveyId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="datetime", nullable=true)
     */
    private $dateCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_invited", type="datetime", nullable=true)
     */
    private $dateInvited;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_completed", type="datetime", nullable=true)
     */
    private $dateCompleted;


}
