<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeSurvey828945
 *
 * @ORM\Table(name="lime_survey_828945")
 * @ORM\Entity
 */
class LimeSurvey828945
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
//      * @ORM\Column(name="828945X43X1771", type="text", nullable=true)
//      */
//     private $828945x43x1771;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X43X485", type="string", length=5, nullable=true)
//      */
//     private $828945x43x485;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X43X488", type="string", length=5, nullable=true)
//      */
//     private $828945x43x488;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X44X1772", type="text", nullable=true)
//      */
//     private $828945x44x1772;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X44X489", type="string", length=5, nullable=true)
//      */
//     private $828945x44x489;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="828945X44X490", type="decimal", nullable=true)
//      */
//     private $828945x44x490;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X44X491", type="string", length=5, nullable=true)
//      */
//     private $828945x44x491;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X44X492SQ001", type="string", length=5, nullable=true)
//      */
//     private $828945x44x492sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X44X492SQ002", type="string", length=5, nullable=true)
//      */
//     private $828945x44x492sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X44X492SQ003", type="string", length=5, nullable=true)
//      */
//     private $828945x44x492sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X44X492SQ004", type="string", length=5, nullable=true)
//      */
//     private $828945x44x492sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X44X492SQ005", type="string", length=5, nullable=true)
//      */
//     private $828945x44x492sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X44X498", type="string", length=5, nullable=true)
//      */
//     private $828945x44x498;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X44X499", type="string", length=5, nullable=true)
//      */
//     private $828945x44x499;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X44X500", type="string", length=1, nullable=true)
//      */
//     private $828945x44x500;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X44X501", type="text", nullable=true)
//      */
//     private $828945x44x501;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X45X502SQ001", type="string", length=5, nullable=true)
//      */
//     private $828945x45x502sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X45X502SQ002", type="string", length=5, nullable=true)
//      */
//     private $828945x45x502sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X45X502SQ003", type="string", length=5, nullable=true)
//      */
//     private $828945x45x502sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X45X502SQ004", type="string", length=5, nullable=true)
//      */
//     private $828945x45x502sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X45X502other", type="text", nullable=true)
//      */
//     private $828945x45x502other;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X45X506", type="string", length=5, nullable=true)
//      */
//     private $828945x45x506;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X45X507", type="string", length=5, nullable=true)
//      */
//     private $828945x45x507;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X45X508", type="text", nullable=true)
//      */
//     private $828945x45x508;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X45X509SQ001", type="string", length=5, nullable=true)
//      */
//     private $828945x45x509sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X45X509SQ002", type="string", length=5, nullable=true)
//      */
//     private $828945x45x509sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X45X509SQ003", type="string", length=5, nullable=true)
//      */
//     private $828945x45x509sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X45X509SQ004", type="string", length=5, nullable=true)
//      */
//     private $828945x45x509sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X45X509other", type="text", nullable=true)
//      */
//     private $828945x45x509other;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X45X514", type="string", length=5, nullable=true)
//      */
//     private $828945x45x514;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X45X515", type="string", length=5, nullable=true)
//      */
//     private $828945x45x515;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="828945X45X520", type="text", nullable=true)
//      */
//     private $828945x45x520;


}
