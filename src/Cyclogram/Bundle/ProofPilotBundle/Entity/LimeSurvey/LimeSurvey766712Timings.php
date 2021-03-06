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
 * LimeSurvey766712Timings
 *
 * @ORM\Table(name="lime_survey_766712_timings")
 * @ORM\Entity
 */
class LimeSurvey766712Timings
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
     * @var float
     *
     * @ORM\Column(name="interviewtime", type="float", nullable=true)
     */
    private $interviewtime;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="766712X493time", type="float", nullable=true)
//      */
//     private $766712x493time;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="766712X493X4186time", type="float", nullable=true)
//      */
//     private $766712x493x4186time;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="766712X493X4187time", type="float", nullable=true)
//      */
//     private $766712x493x4187time;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="766712X493X4188time", type="float", nullable=true)
//      */
//     private $766712x493x4188time;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="766712X493X4193time", type="float", nullable=true)
//      */
//     private $766712x493x4193time;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="766712X493X4201time", type="float", nullable=true)
//      */
//     private $766712x493x4201time;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="766712X493X4202time", type="float", nullable=true)
//      */
//     private $766712x493x4202time;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="766712X493X4203time", type="float", nullable=true)
//      */
//     private $766712x493x4203time;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="766712X493X4204time", type="float", nullable=true)
//      */
//     private $766712x493x4204time;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="766712X493X4205time", type="float", nullable=true)
//      */
//     private $766712x493x4205time;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="766712X493X4210time", type="float", nullable=true)
//      */
//     private $766712x493x4210time;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="766712X493X4216time", type="float", nullable=true)
//      */
//     private $766712x493x4216time;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="766712X493X4222time", type="float", nullable=true)
//      */
//     private $766712x493x4222time;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="766712X493X4228time", type="float", nullable=true)
//      */
//     private $766712x493x4228time;


}
