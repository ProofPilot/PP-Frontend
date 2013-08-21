<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeSurvey149926
 *
 * @ORM\Table(name="lime_survey_149926")
 * @ORM\Entity
 */
class LimeSurvey149926
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
//      * @ORM\Column(name="149926X92X1361pid", type="text", nullable=true)
//      */
//     private $149926x92x1361pid;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="149926X92X1361vid", type="text", nullable=true)
//      */
//     private $149926x92x1361vid;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="149926X92X1224SQ001", type="text", nullable=true)
//      */
//     private $149926x92x1224sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="149926X92X1224SQ002", type="text", nullable=true)
//      */
//     private $149926x92x1224sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="149926X92X1225", type="string", length=1, nullable=true)
//      */
//     private $149926x92x1225;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="149926X92X1226", type="text", nullable=true)
//      */
//     private $149926x92x1226;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="149926X92X1227SQ001", type="string", length=5, nullable=true)
//      */
//     private $149926x92x1227sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="149926X92X1227SQ002", type="string", length=5, nullable=true)
//      */
//     private $149926x92x1227sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="149926X92X1227SQ003", type="string", length=5, nullable=true)
//      */
//     private $149926x92x1227sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="149926X92X1227SQ004", type="string", length=5, nullable=true)
//      */
//     private $149926x92x1227sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="149926X92X1227other", type="text", nullable=true)
//      */
//     private $149926x92x1227other;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="149926X92X1228SQ001", type="string", length=5, nullable=true)
//      */
//     private $149926x92x1228sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="149926X92X1228SQ002", type="string", length=5, nullable=true)
//      */
//     private $149926x92x1228sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="149926X92X1228SQ003", type="string", length=5, nullable=true)
//      */
//     private $149926x92x1228sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="149926X92X1228SQ004", type="string", length=5, nullable=true)
//      */
//     private $149926x92x1228sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="149926X92X1228other", type="text", nullable=true)
//      */
//     private $149926x92x1228other;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="149926X92X1364", type="text", nullable=true)
//      */
//     private $149926x92x1364;


}
