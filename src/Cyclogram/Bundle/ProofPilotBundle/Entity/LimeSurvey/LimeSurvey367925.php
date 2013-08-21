<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeSurvey367925
 *
 * @ORM\Table(name="lime_survey_367925")
 * @ORM\Entity
 */
class LimeSurvey367925
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
//      * @ORM\Column(name="367925X142X1927", type="text", nullable=true)
//      */
//     private $367925x142x1927;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X142X1928", type="text", nullable=true)
//      */
//     private $367925x142x1928;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1929SQ001", type="text", nullable=true)
//      */
//     private $367925x143x1929sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1929SQ002", type="text", nullable=true)
//      */
//     private $367925x143x1929sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1929SQ003", type="text", nullable=true)
//      */
//     private $367925x143x1929sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1933SQ001", type="string", length=5, nullable=true)
//      */
//     private $367925x143x1933sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1933SQ002", type="string", length=5, nullable=true)
//      */
//     private $367925x143x1933sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1933SQ003", type="string", length=5, nullable=true)
//      */
//     private $367925x143x1933sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1937SQ001", type="string", length=5, nullable=true)
//      */
//     private $367925x143x1937sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1937SQ002", type="string", length=5, nullable=true)
//      */
//     private $367925x143x1937sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1937SQ003", type="string", length=5, nullable=true)
//      */
//     private $367925x143x1937sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1937SQ004", type="string", length=5, nullable=true)
//      */
//     private $367925x143x1937sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1937SQ005", type="string", length=5, nullable=true)
//      */
//     private $367925x143x1937sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1943SQ001", type="text", nullable=true)
//      */
//     private $367925x143x1943sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1943SQ002", type="text", nullable=true)
//      */
//     private $367925x143x1943sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1943SQ003", type="text", nullable=true)
//      */
//     private $367925x143x1943sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1947SQ001", type="text", nullable=true)
//      */
//     private $367925x143x1947sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1947SQ002", type="text", nullable=true)
//      */
//     private $367925x143x1947sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1947SQ003", type="text", nullable=true)
//      */
//     private $367925x143x1947sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1951", type="string", length=5, nullable=true)
//      */
//     private $367925x143x1951;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1952", type="string", length=5, nullable=true)
//      */
//     private $367925x143x1952;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1953SQ001", type="text", nullable=true)
//      */
//     private $367925x143x1953sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1953SQ002", type="text", nullable=true)
//      */
//     private $367925x143x1953sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1953SQ003", type="text", nullable=true)
//      */
//     private $367925x143x1953sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1957", type="string", length=1, nullable=true)
//      */
//     private $367925x143x1957;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1958SQ001", type="string", length=5, nullable=true)
//      */
//     private $367925x143x1958sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1958SQ002", type="string", length=5, nullable=true)
//      */
//     private $367925x143x1958sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1958SQ003", type="string", length=5, nullable=true)
//      */
//     private $367925x143x1958sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1958SQ004", type="string", length=5, nullable=true)
//      */
//     private $367925x143x1958sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="367925X143X1958SQ005", type="string", length=5, nullable=true)
//      */
//     private $367925x143x1958sq005;


}
