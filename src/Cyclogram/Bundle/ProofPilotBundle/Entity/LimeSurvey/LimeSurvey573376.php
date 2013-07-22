<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeSurvey573376
 *
 * @ORM\Table(name="lime_survey_573376")
 * @ORM\Entity
 */
class LimeSurvey573376
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
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

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1004", type="string", length=5, nullable=true)
     */
    private $573376x77x1004;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1004other", type="text", nullable=true)
     */
    private $573376x77x1004other;

    /**
     * @var float
     *
     * @ORM\Column(name="573376X77X1634", type="decimal", nullable=true)
     */
    private $573376x77x1634;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1003", type="string", length=5, nullable=true)
     */
    private $573376x77x1003;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1003other", type="text", nullable=true)
     */
    private $573376x77x1003other;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1009", type="string", length=5, nullable=true)
     */
    private $573376x77x1009;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1010", type="string", length=5, nullable=true)
     */
    private $573376x77x1010;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="573376X77X1002", type="datetime", nullable=true)
     */
    private $573376x77x1002;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X10051", type="string", length=5, nullable=true)
     */
    private $573376x77x10051;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X10052", type="string", length=5, nullable=true)
     */
    private $573376x77x10052;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X10053", type="string", length=5, nullable=true)
     */
    private $573376x77x10053;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X10054", type="string", length=5, nullable=true)
     */
    private $573376x77x10054;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X10061", type="string", length=5, nullable=true)
     */
    private $573376x77x10061;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X10062", type="string", length=5, nullable=true)
     */
    private $573376x77x10062;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X10063", type="string", length=5, nullable=true)
     */
    private $573376x77x10063;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X10064", type="string", length=5, nullable=true)
     */
    private $573376x77x10064;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X10071", type="string", length=5, nullable=true)
     */
    private $573376x77x10071;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X10072", type="string", length=5, nullable=true)
     */
    private $573376x77x10072;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X10073", type="string", length=5, nullable=true)
     */
    private $573376x77x10073;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X10074", type="string", length=5, nullable=true)
     */
    private $573376x77x10074;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X10075", type="string", length=5, nullable=true)
     */
    private $573376x77x10075;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X10076", type="string", length=5, nullable=true)
     */
    private $573376x77x10076;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X10077", type="string", length=5, nullable=true)
     */
    private $573376x77x10077;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1008", type="string", length=5, nullable=true)
     */
    private $573376x77x1008;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X10111", type="string", length=5, nullable=true)
     */
    private $573376x77x10111;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X10112", type="string", length=5, nullable=true)
     */
    private $573376x77x10112;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X10113", type="string", length=5, nullable=true)
     */
    private $573376x77x10113;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X10114", type="string", length=5, nullable=true)
     */
    private $573376x77x10114;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X10115", type="string", length=5, nullable=true)
     */
    private $573376x77x10115;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X16031", type="string", length=5, nullable=true)
     */
    private $573376x77x16031;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X16032", type="string", length=5, nullable=true)
     */
    private $573376x77x16032;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X16033", type="string", length=5, nullable=true)
     */
    private $573376x77x16033;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X16034", type="string", length=5, nullable=true)
     */
    private $573376x77x16034;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X16035", type="string", length=5, nullable=true)
     */
    private $573376x77x16035;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X16091", type="string", length=5, nullable=true)
     */
    private $573376x77x16091;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X16092", type="string", length=5, nullable=true)
     */
    private $573376x77x16092;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X16093", type="string", length=5, nullable=true)
     */
    private $573376x77x16093;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X16094", type="string", length=5, nullable=true)
     */
    private $573376x77x16094;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X16095", type="string", length=5, nullable=true)
     */
    private $573376x77x16095;


}
