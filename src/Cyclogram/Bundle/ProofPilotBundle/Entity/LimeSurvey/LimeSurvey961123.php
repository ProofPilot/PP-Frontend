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
 * LimeSurvey961123
 *
 * @ORM\Table(name="lime_survey_961123")
 * @ORM\Entity
 */
class LimeSurvey961123
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

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X137X1849", type="text", nullable=true)
//      */
//     private $961123x137x1849;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X137X1850", type="text", nullable=true)
//      */
//     private $961123x137x1850;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X137X1851", type="text", nullable=true)
//      */
//     private $961123x137x1851;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ001", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ002", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ003", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ004", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ005", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ006", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq006;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ007", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq007;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ008", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq008;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ009", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq009;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ010", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq010;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ011", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq011;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ012", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq012;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ013", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq013;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ014", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq014;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ015", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq015;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ016", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq016;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ017", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq017;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ018", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq018;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ019", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq019;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ020", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq020;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ021", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq021;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ022", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq022;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ023", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq023;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ024", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq024;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ025", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq025;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ026", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq026;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ027", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq027;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ028", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq028;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ029", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq029;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ030", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq030;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ031", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq031;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ032", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq032;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X138X1852SQ033", type="string", length=5, nullable=true)
//      */
//     private $961123x138x1852sq033;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X139X1886", type="text", nullable=true)
//      */
//     private $961123x139x1886;

//     /**
//      * @var \DateTime
//      *
//      * @ORM\Column(name="961123X139X1887", type="datetime", nullable=true)
//      */
//     private $961123x139x1887;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X139X1888SQ001", type="string", length=5, nullable=true)
//      */
//     private $961123x139x1888sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X139X1888SQ002", type="string", length=5, nullable=true)
//      */
//     private $961123x139x1888sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X139X1888SQ003", type="string", length=5, nullable=true)
//      */
//     private $961123x139x1888sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X139X1888SQ004", type="string", length=5, nullable=true)
//      */
//     private $961123x139x1888sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X139X1888SQ005", type="string", length=5, nullable=true)
//      */
//     private $961123x139x1888sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X139X1888SQ006", type="string", length=5, nullable=true)
//      */
//     private $961123x139x1888sq006;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X139X1888SQ007", type="string", length=5, nullable=true)
//      */
//     private $961123x139x1888sq007;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X139X1888SQ008", type="string", length=5, nullable=true)
//      */
//     private $961123x139x1888sq008;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X139X1888SQ009", type="string", length=5, nullable=true)
//      */
//     private $961123x139x1888sq009;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X139X1888SQ010", type="string", length=5, nullable=true)
//      */
//     private $961123x139x1888sq010;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X139X1888SQ011", type="string", length=5, nullable=true)
//      */
//     private $961123x139x1888sq011;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X139X1888SQ012", type="string", length=5, nullable=true)
//      */
//     private $961123x139x1888sq012;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X139X1888SQ013", type="string", length=5, nullable=true)
//      */
//     private $961123x139x1888sq013;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X139X1888SQ014", type="string", length=5, nullable=true)
//      */
//     private $961123x139x1888sq014;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X139X1888SQ015", type="string", length=5, nullable=true)
//      */
//     private $961123x139x1888sq015;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X139X1888SQ016", type="string", length=5, nullable=true)
//      */
//     private $961123x139x1888sq016;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X139X1888SQ017", type="string", length=5, nullable=true)
//      */
//     private $961123x139x1888sq017;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X139X1888SQ018", type="string", length=5, nullable=true)
//      */
//     private $961123x139x1888sq018;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X139X1888SQ019", type="string", length=5, nullable=true)
//      */
//     private $961123x139x1888sq019;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X139X1888SQ020", type="string", length=5, nullable=true)
//      */
//     private $961123x139x1888sq020;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="961123X139X1888other", type="text", nullable=true)
//      */
//     private $961123x139x1888other;


}
