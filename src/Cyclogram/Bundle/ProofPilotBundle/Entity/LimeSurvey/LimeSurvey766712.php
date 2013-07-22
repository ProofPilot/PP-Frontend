<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeSurvey766712
 *
 * @ORM\Table(name="lime_survey_766712")
 * @ORM\Entity
 */
class LimeSurvey766712
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
     * @ORM\Column(name="766712X493X4186", type="decimal", nullable=true)
     */
    private $766712x493x4186;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="766712X493X4187", type="datetime", nullable=true)
     */
    private $766712x493x4187;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4188SQ001", type="string", length=5, nullable=true)
     */
    private $766712x493x4188sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4188SQ002", type="string", length=5, nullable=true)
     */
    private $766712x493x4188sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4188SQ003", type="string", length=5, nullable=true)
     */
    private $766712x493x4188sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4188SQ004", type="string", length=5, nullable=true)
     */
    private $766712x493x4188sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4193SQ001", type="string", length=5, nullable=true)
     */
    private $766712x493x4193sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4193SQ002", type="string", length=5, nullable=true)
     */
    private $766712x493x4193sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4193SQ003", type="string", length=5, nullable=true)
     */
    private $766712x493x4193sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4193SQ004", type="string", length=5, nullable=true)
     */
    private $766712x493x4193sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4193SQ005", type="string", length=5, nullable=true)
     */
    private $766712x493x4193sq005;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4193SQ006", type="string", length=5, nullable=true)
     */
    private $766712x493x4193sq006;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4193SQ007", type="string", length=5, nullable=true)
     */
    private $766712x493x4193sq007;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4201", type="string", length=5, nullable=true)
     */
    private $766712x493x4201;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4202", type="string", length=5, nullable=true)
     */
    private $766712x493x4202;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4203", type="string", length=5, nullable=true)
     */
    private $766712x493x4203;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4204", type="string", length=5, nullable=true)
     */
    private $766712x493x4204;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4205SQ001", type="string", length=5, nullable=true)
     */
    private $766712x493x4205sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4205SQ002", type="string", length=5, nullable=true)
     */
    private $766712x493x4205sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4205SQ003", type="string", length=5, nullable=true)
     */
    private $766712x493x4205sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4205SQ004", type="string", length=5, nullable=true)
     */
    private $766712x493x4205sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4210SQ001", type="string", length=5, nullable=true)
     */
    private $766712x493x4210sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4210SQ002", type="string", length=5, nullable=true)
     */
    private $766712x493x4210sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4210SQ003", type="string", length=5, nullable=true)
     */
    private $766712x493x4210sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4210SQ004", type="string", length=5, nullable=true)
     */
    private $766712x493x4210sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4210SQ005", type="string", length=5, nullable=true)
     */
    private $766712x493x4210sq005;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4216SQ001", type="string", length=5, nullable=true)
     */
    private $766712x493x4216sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4216SQ002", type="string", length=5, nullable=true)
     */
    private $766712x493x4216sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4216SQ003", type="string", length=5, nullable=true)
     */
    private $766712x493x4216sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4216SQ004", type="string", length=5, nullable=true)
     */
    private $766712x493x4216sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4216SQ005", type="string", length=5, nullable=true)
     */
    private $766712x493x4216sq005;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4222SQ001", type="string", length=5, nullable=true)
     */
    private $766712x493x4222sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4222SQ002", type="string", length=5, nullable=true)
     */
    private $766712x493x4222sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4222SQ003", type="string", length=5, nullable=true)
     */
    private $766712x493x4222sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4222SQ004", type="string", length=5, nullable=true)
     */
    private $766712x493x4222sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4222SQ005", type="string", length=5, nullable=true)
     */
    private $766712x493x4222sq005;

    /**
     * @var string
     *
     * @ORM\Column(name="766712X493X4228", type="text", nullable=true)
     */
    private $766712x493x4228;


}
