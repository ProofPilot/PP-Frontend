<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeSurvey729891
 *
 * @ORM\Table(name="lime_survey_729891")
 * @ORM\Entity
 */
class LimeSurvey729891
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
//      * @ORM\Column(name="729891X129X1717", type="decimal", nullable=true)
//      */
//     private $729891x129x1717;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="729891X129X1770", type="string", length=5, nullable=true)
//      */
//     private $729891x129x1770;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="729891X129X1720", type="decimal", nullable=true)
//      */
//     private $729891x129x1720;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="729891X129X1718", type="string", length=5, nullable=true)
//      */
//     private $729891x129x1718;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="729891X129X1719SQ001", type="string", length=5, nullable=true)
//      */
//     private $729891x129x1719sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="729891X129X1719SQ002", type="string", length=5, nullable=true)
//      */
//     private $729891x129x1719sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="729891X129X1719SQ003", type="string", length=5, nullable=true)
//      */
//     private $729891x129x1719sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="729891X129X1719SQ004", type="string", length=5, nullable=true)
//      */
//     private $729891x129x1719sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="729891X129X1719SQ005", type="string", length=5, nullable=true)
//      */
//     private $729891x129x1719sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="729891X130X1721", type="string", length=5, nullable=true)
//      */
//     private $729891x130x1721;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="729891X130X1722", type="string", length=5, nullable=true)
//      */
//     private $729891x130x1722;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="729891X130X1722other", type="text", nullable=true)
//      */
//     private $729891x130x1722other;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="729891X130X1723", type="string", length=5, nullable=true)
//      */
//     private $729891x130x1723;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="729891X131X1738", type="string", length=5, nullable=true)
//      */
//     private $729891x131x1738;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="729891X131X1724", type="string", length=5, nullable=true)
//      */
//     private $729891x131x1724;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="729891X131X1725", type="string", length=5, nullable=true)
//      */
//     private $729891x131x1725;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="729891X133X1739", type="string", length=5, nullable=true)
//      */
//     private $729891x133x1739;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="729891X133X1740", type="string", length=5, nullable=true)
//      */
//     private $729891x133x1740;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="729891X132X1726", type="text", nullable=true)
//      */
//     private $729891x132x1726;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="729891X132X1729", type="decimal", nullable=true)
//      */
//     private $729891x132x1729;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="729891X132X1727", type="decimal", nullable=true)
//      */
//     private $729891x132x1727;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="729891X132X1728", type="text", nullable=true)
//      */
//     private $729891x132x1728;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="729891X132X1821", type="string", length=1, nullable=true)
//      */
//     private $729891x132x1821;


}
