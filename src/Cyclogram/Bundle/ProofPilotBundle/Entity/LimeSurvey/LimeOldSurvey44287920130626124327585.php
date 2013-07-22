<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeOldSurvey44287920130626124327585
 *
 * @ORM\Table(name="lime_old_survey_442879_20130626124327585")
 * @ORM\Entity
 */
class LimeOldSurvey44287920130626124327585
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
     * @var float
     *
     * @ORM\Column(name="442879X61X743SQ001", type="float", nullable=true)
     */
    private $442879x61x743sq001;

    /**
     * @var float
     *
     * @ORM\Column(name="442879X61X743SQ002", type="float", nullable=true)
     */
    private $442879x61x743sq002;

    /**
     * @var float
     *
     * @ORM\Column(name="442879X61X743SQ003", type="float", nullable=true)
     */
    private $442879x61x743sq003;

    /**
     * @var float
     *
     * @ORM\Column(name="442879X61X743SQ004", type="float", nullable=true)
     */
    private $442879x61x743sq004;

    /**
     * @var float
     *
     * @ORM\Column(name="442879X61X743SQ005", type="float", nullable=true)
     */
    private $442879x61x743sq005;

    /**
     * @var float
     *
     * @ORM\Column(name="442879X61X749SQ001", type="float", nullable=true)
     */
    private $442879x61x749sq001;

    /**
     * @var float
     *
     * @ORM\Column(name="442879X61X749SQ002", type="float", nullable=true)
     */
    private $442879x61x749sq002;

    /**
     * @var float
     *
     * @ORM\Column(name="442879X61X749SQ003", type="float", nullable=true)
     */
    private $442879x61x749sq003;

    /**
     * @var float
     *
     * @ORM\Column(name="442879X61X749SQ004", type="float", nullable=true)
     */
    private $442879x61x749sq004;

    /**
     * @var float
     *
     * @ORM\Column(name="442879X61X749SQ005", type="float", nullable=true)
     */
    private $442879x61x749sq005;

    /**
     * @var string
     *
     * @ORM\Column(name="442879X60X7121", type="string", length=5, nullable=true)
     */
    private $442879x60x7121;

    /**
     * @var string
     *
     * @ORM\Column(name="442879X60X7122", type="string", length=5, nullable=true)
     */
    private $442879x60x7122;

    /**
     * @var string
     *
     * @ORM\Column(name="442879X60X7123", type="string", length=5, nullable=true)
     */
    private $442879x60x7123;

    /**
     * @var string
     *
     * @ORM\Column(name="442879X60X7124", type="string", length=5, nullable=true)
     */
    private $442879x60x7124;

    /**
     * @var string
     *
     * @ORM\Column(name="442879X60X7125", type="string", length=5, nullable=true)
     */
    private $442879x60x7125;

    /**
     * @var string
     *
     * @ORM\Column(name="442879X60X7126", type="string", length=5, nullable=true)
     */
    private $442879x60x7126;

    /**
     * @var string
     *
     * @ORM\Column(name="442879X60X7127", type="string", length=5, nullable=true)
     */
    private $442879x60x7127;

    /**
     * @var string
     *
     * @ORM\Column(name="442879X60X718", type="string", length=5, nullable=true)
     */
    private $442879x60x718;

    /**
     * @var string
     *
     * @ORM\Column(name="442879X60X718other", type="text", nullable=true)
     */
    private $442879x60x718other;

    /**
     * @var string
     *
     * @ORM\Column(name="442879X60X723SQ001", type="string", length=5, nullable=true)
     */
    private $442879x60x723sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="442879X60X723SQ002", type="string", length=5, nullable=true)
     */
    private $442879x60x723sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="442879X60X723SQ003", type="string", length=5, nullable=true)
     */
    private $442879x60x723sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="442879X60X723SQ004", type="string", length=5, nullable=true)
     */
    private $442879x60x723sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="442879X60X723SQ005", type="string", length=5, nullable=true)
     */
    private $442879x60x723sq005;

    /**
     * @var string
     *
     * @ORM\Column(name="442879X60X723other", type="text", nullable=true)
     */
    private $442879x60x723other;

    /**
     * @var string
     *
     * @ORM\Column(name="442879X60X729SQ001", type="string", length=5, nullable=true)
     */
    private $442879x60x729sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="442879X60X729SQ002", type="string", length=5, nullable=true)
     */
    private $442879x60x729sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="442879X60X729SQ003", type="string", length=5, nullable=true)
     */
    private $442879x60x729sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="442879X60X729SQ004", type="string", length=5, nullable=true)
     */
    private $442879x60x729sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="442879X60X729SQ005", type="string", length=5, nullable=true)
     */
    private $442879x60x729sq005;

    /**
     * @var string
     *
     * @ORM\Column(name="442879X60X729SQ006", type="string", length=5, nullable=true)
     */
    private $442879x60x729sq006;

    /**
     * @var string
     *
     * @ORM\Column(name="442879X60X729other", type="text", nullable=true)
     */
    private $442879x60x729other;

    /**
     * @var float
     *
     * @ORM\Column(name="442879X60X735SQ001", type="float", nullable=true)
     */
    private $442879x60x735sq001;

    /**
     * @var float
     *
     * @ORM\Column(name="442879X60X735SQ002", type="float", nullable=true)
     */
    private $442879x60x735sq002;

    /**
     * @var float
     *
     * @ORM\Column(name="442879X60X735SQ003", type="float", nullable=true)
     */
    private $442879x60x735sq003;

    /**
     * @var float
     *
     * @ORM\Column(name="442879X60X735SQ004", type="float", nullable=true)
     */
    private $442879x60x735sq004;

    /**
     * @var float
     *
     * @ORM\Column(name="442879X60X735SQ005", type="float", nullable=true)
     */
    private $442879x60x735sq005;

    /**
     * @var float
     *
     * @ORM\Column(name="442879X60X735SQ006", type="float", nullable=true)
     */
    private $442879x60x735sq006;

    /**
     * @var string
     *
     * @ORM\Column(name="442879X60X719", type="string", length=1, nullable=true)
     */
    private $442879x60x719;


}
