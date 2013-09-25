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
 * LimeSurvey553173
 *
 * @ORM\Table(name="lime_survey_553173")
 * @ORM\Entity
 */
class LimeSurvey553173
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
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=36, nullable=true)
     */
    private $token;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="submitdate", type="datetime", nullable=true)
     */
    private $submitdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="lastpage", type="integer", nullable=true)
     */
    private $lastpage;

    /**
     * @var string
     *
     * @ORM\Column(name="startlanguage", type="string", length=20, nullable=false)
     */
    private $startlanguage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startdate", type="datetime", nullable=false)
     */
    private $startdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datestamp", type="datetime", nullable=false)
     */
    private $datestamp;

    /**
     * @var string
     *
     * @ORM\Column(name="ipaddr", type="text", nullable=true)
     */
    private $ipaddr;

    /**
     * @var string
     *
     * @ORM\Column(name="refurl", type="text", nullable=true)
     */
    private $refurl;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="553173X46X521", type="decimal", nullable=true)
//      */
//     private $553173x46x521;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="553173X46X522", type="string", length=5, nullable=true)
//      */
//     private $553173x46x522;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="553173X46X523SQ001", type="string", length=5, nullable=true)
//      */
//     private $553173x46x523sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="553173X46X523SQ002", type="string", length=5, nullable=true)
//      */
//     private $553173x46x523sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="553173X46X523SQ003", type="string", length=5, nullable=true)
//      */
//     private $553173x46x523sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="553173X46X523SQ004", type="string", length=5, nullable=true)
//      */
//     private $553173x46x523sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="553173X46X523SQ005", type="string", length=5, nullable=true)
//      */
//     private $553173x46x523sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="553173X46X523SQ008", type="string", length=5, nullable=true)
//      */
//     private $553173x46x523sq008;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="553173X46X523SQ006", type="string", length=5, nullable=true)
//      */
//     private $553173x46x523sq006;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="553173X46X523SQ007", type="string", length=5, nullable=true)
//      */
//     private $553173x46x523sq007;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="553173X126X531", type="decimal", nullable=true)
//      */
//     private $553173x126x531;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="553173X126X532", type="string", length=5, nullable=true)
//      */
//     private $553173x126x532;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="553173X126X536", type="string", length=5, nullable=true)
//      */
//     private $553173x126x536;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="553173X126X537", type="string", length=5, nullable=true)
//      */
//     private $553173x126x537;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="553173X127X539", type="string", length=5, nullable=true)
//      */
//     private $553173x127x539;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="553173X127X540", type="string", length=5, nullable=true)
//      */
//     private $553173x127x540;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="553173X127X1635", type="text", nullable=true)
//      */
//     private $553173x127x1635;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="553173X128X1636", type="decimal", nullable=true)
//      */
//     private $553173x128x1636;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="553173X128X1693", type="text", nullable=true)
//      */
//     private $553173x128x1693;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="553173X128X1695", type="text", nullable=true)
//      */
//     private $553173x128x1695;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="553173X128X1820", type="string", length=1, nullable=true)
//      */
//     private $553173x128x1820;


}
