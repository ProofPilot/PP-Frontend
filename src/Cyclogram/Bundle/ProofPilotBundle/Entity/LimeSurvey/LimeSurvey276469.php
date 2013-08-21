<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeSurvey276469
 *
 * @ORM\Table(name="lime_survey_276469")
 * @ORM\Entity
 */
class LimeSurvey276469
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
//      * @ORM\Column(name="276469X541X4795", type="decimal", nullable=true)
//      */
//     private $276469x541x4795;

//     /**
//      * @var \DateTime
//      *
//      * @ORM\Column(name="276469X541X4796", type="datetime", nullable=true)
//      */
//     private $276469x541x4796;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4797SQ001", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4797sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4797SQ002", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4797sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4797SQ003", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4797sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4797SQ004", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4797sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4798SQ001", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4798sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4798SQ002", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4798sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4798SQ003", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4798sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4798SQ004", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4798sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4798SQ005", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4798sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4798SQ006", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4798sq006;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4798SQ007", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4798sq007;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4799", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4799;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4800", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4800;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4838", type="string", length=1, nullable=true)
//      */
//     private $276469x541x4838;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4801", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4801;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4802", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4802;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4803SQ001", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4803sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4803SQ002", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4803sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4803SQ003", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4803sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4803SQ004", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4803sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4804SQ001", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4804sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4804SQ002", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4804sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4804SQ003", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4804sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4804SQ004", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4804sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4804SQ005", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4804sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4805SQ001", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4805sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4805SQ002", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4805sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4805SQ003", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4805sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4805SQ004", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4805sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4805SQ005", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4805sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4806SQ001", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4806sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4806SQ002", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4806sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4806SQ003", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4806sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4806SQ004", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4806sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4806SQ005", type="string", length=5, nullable=true)
//      */
//     private $276469x541x4806sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="276469X541X4807", type="text", nullable=true)
//      */
//     private $276469x541x4807;


}
