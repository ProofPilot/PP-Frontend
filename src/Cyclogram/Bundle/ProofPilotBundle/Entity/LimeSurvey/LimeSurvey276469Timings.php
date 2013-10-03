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
 * LimeSurvey276469Timings
 *
 * @ORM\Table(name="lime_survey_276469_timings")
 * @ORM\Entity
 */
class LimeSurvey276469Timings
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
//      * @ORM\Column(name="276469X541time", type="float", nullable=true)
//      */
//     private $276469x541time;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="276469X541X4795time", type="float", nullable=true)
//      */
//     private $276469x541x4795time;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="276469X541X4796time", type="float", nullable=true)
//      */
//     private $276469x541x4796time;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="276469X541X4797time", type="float", nullable=true)
//      */
//     private $276469x541x4797time;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="276469X541X4798time", type="float", nullable=true)
//      */
//     private $276469x541x4798time;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="276469X541X4799time", type="float", nullable=true)
//      */
//     private $276469x541x4799time;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="276469X541X4800time", type="float", nullable=true)
//      */
//     private $276469x541x4800time;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="276469X541X4838time", type="float", nullable=true)
//      */
//     private $276469x541x4838time;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="276469X541X4801time", type="float", nullable=true)
//      */
//     private $276469x541x4801time;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="276469X541X4802time", type="float", nullable=true)
//      */
//     private $276469x541x4802time;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="276469X541X4803time", type="float", nullable=true)
//      */
//     private $276469x541x4803time;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="276469X541X4804time", type="float", nullable=true)
//      */
//     private $276469x541x4804time;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="276469X541X4805time", type="float", nullable=true)
//      */
//     private $276469x541x4805time;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="276469X541X4806time", type="float", nullable=true)
//      */
//     private $276469x541x4806time;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="276469X541X4807time", type="float", nullable=true)
//      */
//     private $276469x541x4807time;


}
