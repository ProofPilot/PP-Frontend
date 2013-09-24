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
 * LimeSurvey692294
 *
 * @ORM\Table(name="lime_survey_692294")
 * @ORM\Entity
 */
class LimeSurvey692294
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
//      * @var string
//      *
//      * @ORM\Column(name="692294X119X1615", type="string", length=5, nullable=true)
//      */
//     private $692294x119x1615;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="692294X119X1615other", type="text", nullable=true)
//      */
//     private $692294x119x1615other;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="692294X119X1616", type="string", length=5, nullable=true)
//      */
//     private $692294x119x1616;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="692294X119X16171", type="string", length=5, nullable=true)
//      */
//     private $692294x119x16171;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="692294X119X16172", type="string", length=5, nullable=true)
//      */
//     private $692294x119x16172;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="692294X119X16173", type="string", length=5, nullable=true)
//      */
//     private $692294x119x16173;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="692294X119X16174", type="string", length=5, nullable=true)
//      */
//     private $692294x119x16174;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="692294X119X16175", type="string", length=5, nullable=true)
//      */
//     private $692294x119x16175;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="692294X119X1617other", type="text", nullable=true)
//      */
//     private $692294x119x1617other;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="692294X119X1618", type="text", nullable=true)
//      */
//     private $692294x119x1618;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="692294X119X1619", type="text", nullable=true)
//      */
//     private $692294x119x1619;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="692294X119X1620", type="text", nullable=true)
//      */
//     private $692294x119x1620;

//     /**
//      * @var \DateTime
//      *
//      * @ORM\Column(name="692294X119X1621", type="datetime", nullable=true)
//      */
//     private $692294x119x1621;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="692294X119X1622", type="decimal", nullable=true)
//      */
//     private $692294x119x1622;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="692294X119X16231", type="string", length=5, nullable=true)
//      */
//     private $692294x119x16231;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="692294X119X16232", type="string", length=5, nullable=true)
//      */
//     private $692294x119x16232;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="692294X119X16233", type="string", length=5, nullable=true)
//      */
//     private $692294x119x16233;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="692294X119X16234", type="string", length=5, nullable=true)
//      */
//     private $692294x119x16234;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="692294X119X1819", type="string", length=1, nullable=true)
//      */
//     private $692294x119x1819;


}
