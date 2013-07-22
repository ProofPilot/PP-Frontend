<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeOldSurvey25166120130626124327772
 *
 * @ORM\Table(name="lime_old_survey_251661_20130626124327772")
 * @ORM\Entity
 */
class LimeOldSurvey25166120130626124327772
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

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X782", type="string", length=5, nullable=true)
     */
    private $251661x64x782;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X782other", type="text", nullable=true)
     */
    private $251661x64x782other;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X781", type="string", length=5, nullable=true)
     */
    private $251661x64x781;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X781other", type="text", nullable=true)
     */
    private $251661x64x781other;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X787", type="string", length=5, nullable=true)
     */
    private $251661x64x787;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X788", type="string", length=5, nullable=true)
     */
    private $251661x64x788;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="251661X64X780", type="datetime", nullable=true)
     */
    private $251661x64x780;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X783SQ001", type="string", length=5, nullable=true)
     */
    private $251661x64x783sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X783SQ002", type="string", length=5, nullable=true)
     */
    private $251661x64x783sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X783SQ003", type="string", length=5, nullable=true)
     */
    private $251661x64x783sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X783SQ004", type="string", length=5, nullable=true)
     */
    private $251661x64x783sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X784SQ001", type="string", length=5, nullable=true)
     */
    private $251661x64x784sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X784SQ004", type="string", length=5, nullable=true)
     */
    private $251661x64x784sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X784SQ002", type="string", length=5, nullable=true)
     */
    private $251661x64x784sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X784SQ003", type="string", length=5, nullable=true)
     */
    private $251661x64x784sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X785SQ001", type="string", length=5, nullable=true)
     */
    private $251661x64x785sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X785SQ002", type="string", length=5, nullable=true)
     */
    private $251661x64x785sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X785SQ003", type="string", length=5, nullable=true)
     */
    private $251661x64x785sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X785SQ004", type="string", length=5, nullable=true)
     */
    private $251661x64x785sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X785SQ005", type="string", length=5, nullable=true)
     */
    private $251661x64x785sq005;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X785SQ006", type="string", length=5, nullable=true)
     */
    private $251661x64x785sq006;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X785SQ007", type="string", length=5, nullable=true)
     */
    private $251661x64x785sq007;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X786", type="string", length=5, nullable=true)
     */
    private $251661x64x786;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X7891_1", type="text", nullable=true)
     */
    private $251661x64x78911;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X7891_2", type="text", nullable=true)
     */
    private $251661x64x78912;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X7891_3", type="text", nullable=true)
     */
    private $251661x64x78913;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X7892_1", type="text", nullable=true)
     */
    private $251661x64x78921;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X7892_2", type="text", nullable=true)
     */
    private $251661x64x78922;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X7892_3", type="text", nullable=true)
     */
    private $251661x64x78923;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X7893_1", type="text", nullable=true)
     */
    private $251661x64x78931;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X7893_2", type="text", nullable=true)
     */
    private $251661x64x78932;

    /**
     * @var string
     *
     * @ORM\Column(name="251661X64X7893_3", type="text", nullable=true)
     */
    private $251661x64x78933;


}
