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
 * LimeSurvey249413
 *
 * @ORM\Table(name="lime_survey_249413")
 * @ORM\Entity
 */
class LimeSurvey249413
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
//      * @ORM\Column(name="249413X104X1367SQ001_SQ001", type="text", nullable=true)
//      */
//     private $249413x104x1367sq001Sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="249413X104X1367SQ001_SQ002", type="text", nullable=true)
//      */
//     private $249413x104x1367sq001Sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="249413X104X1367SQ001_SQ003", type="text", nullable=true)
//      */
//     private $249413x104x1367sq001Sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="249413X104X1367SQ001_SQ004", type="text", nullable=true)
//      */
//     private $249413x104x1367sq001Sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="249413X104X1367SQ001_SQ005", type="text", nullable=true)
//      */
//     private $249413x104x1367sq001Sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="249413X104X1367SQ002_SQ001", type="text", nullable=true)
//      */
//     private $249413x104x1367sq002Sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="249413X104X1367SQ002_SQ002", type="text", nullable=true)
//      */
//     private $249413x104x1367sq002Sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="249413X104X1367SQ002_SQ003", type="text", nullable=true)
//      */
//     private $249413x104x1367sq002Sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="249413X104X1367SQ002_SQ004", type="text", nullable=true)
//      */
//     private $249413x104x1367sq002Sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="249413X104X1367SQ002_SQ005", type="text", nullable=true)
//      */
//     private $249413x104x1367sq002Sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="249413X104X1367SQ003_SQ001", type="text", nullable=true)
//      */
//     private $249413x104x1367sq003Sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="249413X104X1367SQ003_SQ002", type="text", nullable=true)
//      */
//     private $249413x104x1367sq003Sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="249413X104X1367SQ003_SQ003", type="text", nullable=true)
//      */
//     private $249413x104x1367sq003Sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="249413X104X1367SQ003_SQ004", type="text", nullable=true)
//      */
//     private $249413x104x1367sq003Sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="249413X104X1367SQ003_SQ005", type="text", nullable=true)
//      */
//     private $249413x104x1367sq003Sq005;


}
