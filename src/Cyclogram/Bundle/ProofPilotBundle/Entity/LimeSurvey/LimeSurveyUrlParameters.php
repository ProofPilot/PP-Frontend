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
 * LimeSurveyUrlParameters
 *
 * @ORM\Table(name="lime_survey_url_parameters")
 * @ORM\Entity
 */
class LimeSurveyUrlParameters
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
     * @ORM\Column(name="sid", type="integer", nullable=false)
     */
    private $sid;

    /**
     * @var string
     *
     * @ORM\Column(name="parameter", type="string", length=50, nullable=false)
     */
    private $parameter;

    /**
     * @var integer
     *
     * @ORM\Column(name="targetqid", type="integer", nullable=true)
     */
    private $targetqid;

    /**
     * @var integer
     *
     * @ORM\Column(name="targetsqid", type="integer", nullable=true)
     */
    private $targetsqid;


}
