<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeOldSurvey55317320130415132446
 *
 * @ORM\Table(name="lime_old_survey_553173_20130415132446")
 * @ORM\Entity
 */
class LimeOldSurvey55317320130415132446
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
     * @var float
     *
     * @ORM\Column(name="553173X46X521", type="decimal", nullable=true)
     */
    private $553173x46x521;

    /**
     * @var string
     *
     * @ORM\Column(name="553173X46X656", type="string", length=5, nullable=true)
     */
    private $553173x46x656;

    /**
     * @var float
     *
     * @ORM\Column(name="553173X46X531", type="decimal", nullable=true)
     */
    private $553173x46x531;

    /**
     * @var string
     *
     * @ORM\Column(name="553173X46X522", type="string", length=5, nullable=true)
     */
    private $553173x46x522;

    /**
     * @var string
     *
     * @ORM\Column(name="553173X46X523SQ001", type="string", length=5, nullable=true)
     */
    private $553173x46x523sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="553173X46X523SQ002", type="string", length=5, nullable=true)
     */
    private $553173x46x523sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="553173X46X523SQ003", type="string", length=5, nullable=true)
     */
    private $553173x46x523sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="553173X46X523SQ004", type="string", length=5, nullable=true)
     */
    private $553173x46x523sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="553173X46X523SQ005", type="string", length=5, nullable=true)
     */
    private $553173x46x523sq005;

    /**
     * @var string
     *
     * @ORM\Column(name="553173X46X532", type="string", length=5, nullable=true)
     */
    private $553173x46x532;

    /**
     * @var string
     *
     * @ORM\Column(name="553173X46X536", type="string", length=5, nullable=true)
     */
    private $553173x46x536;

    /**
     * @var string
     *
     * @ORM\Column(name="553173X46X536other", type="text", nullable=true)
     */
    private $553173x46x536other;

    /**
     * @var string
     *
     * @ORM\Column(name="553173X46X537", type="string", length=5, nullable=true)
     */
    private $553173x46x537;

    /**
     * @var string
     *
     * @ORM\Column(name="553173X46X538", type="string", length=5, nullable=true)
     */
    private $553173x46x538;

    /**
     * @var string
     *
     * @ORM\Column(name="553173X46X539", type="string", length=1, nullable=true)
     */
    private $553173x46x539;

    /**
     * @var string
     *
     * @ORM\Column(name="553173X46X540", type="string", length=5, nullable=true)
     */
    private $553173x46x540;

    /**
     * @var string
     *
     * @ORM\Column(name="553173X46X541", type="string", length=5, nullable=true)
     */
    private $553173x46x541;

    /**
     * @var string
     *
     * @ORM\Column(name="553173X46X542", type="string", length=5, nullable=true)
     */
    private $553173x46x542;


}
