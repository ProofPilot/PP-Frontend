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
 * LimeSurvey218685
 *
 * @ORM\Table(name="lime_survey_218685")
 * @ORM\Entity
 */
class LimeSurvey218685
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
//      * @ORM\Column(name="218685X135X1822", type="text", nullable=true)
//      */
//     private $218685x135x1822;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="218685X135X1823", type="text", nullable=true)
//      */
//     private $218685x135x1823;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="218685X135X1824", type="text", nullable=true)
//      */
//     private $218685x135x1824;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="218685X135X1825", type="text", nullable=true)
//      */
//     private $218685x135x1825;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="218685X135X1826", type="string", length=1, nullable=true)
//      */
//     private $218685x135x1826;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="218685X135X1827", type="text", nullable=true)
//      */
//     private $218685x135x1827;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="218685X135X1828", type="text", nullable=true)
//      */
//     private $218685x135x1828;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="218685X135X1829", type="text", nullable=true)
//      */
//     private $218685x135x1829;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="218685X136X1830", type="text", nullable=true)
//      */
//     private $218685x136x1830;

//     /**
//      * @var \DateTime
//      *
//      * @ORM\Column(name="218685X136X1831", type="datetime", nullable=true)
//      */
//     private $218685x136x1831;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="218685X136X1832SQ001", type="string", length=5, nullable=true)
//      */
//     private $218685x136x1832sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="218685X136X1832SQ002", type="string", length=5, nullable=true)
//      */
//     private $218685x136x1832sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="218685X136X1832SQ003", type="string", length=5, nullable=true)
//      */
//     private $218685x136x1832sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="218685X136X1832SQ004", type="string", length=5, nullable=true)
//      */
//     private $218685x136x1832sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="218685X136X1832SQ005", type="string", length=5, nullable=true)
//      */
//     private $218685x136x1832sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="218685X136X1832SQ006", type="string", length=5, nullable=true)
//      */
//     private $218685x136x1832sq006;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="218685X136X1832SQ007", type="string", length=5, nullable=true)
//      */
//     private $218685x136x1832sq007;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="218685X136X1832SQ008", type="string", length=5, nullable=true)
//      */
//     private $218685x136x1832sq008;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="218685X136X1832SQ009", type="string", length=5, nullable=true)
//      */
//     private $218685x136x1832sq009;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="218685X136X1832SQ010", type="string", length=5, nullable=true)
//      */
//     private $218685x136x1832sq010;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="218685X136X1832SQ011", type="string", length=5, nullable=true)
//      */
//     private $218685x136x1832sq011;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="218685X136X1832SQ012", type="string", length=5, nullable=true)
//      */
//     private $218685x136x1832sq012;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="218685X136X1832SQ013", type="string", length=5, nullable=true)
//      */
//     private $218685x136x1832sq013;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="218685X136X1832SQ014", type="string", length=5, nullable=true)
//      */
//     private $218685x136x1832sq014;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="218685X136X1832SQ015", type="string", length=5, nullable=true)
//      */
//     private $218685x136x1832sq015;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="218685X136X1832SQ016", type="string", length=5, nullable=true)
//      */
//     private $218685x136x1832sq016;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="218685X136X1832SQ017", type="string", length=5, nullable=true)
//      */
//     private $218685x136x1832sq017;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="218685X136X1832other", type="text", nullable=true)
//      */
//     private $218685x136x1832other;


}
