<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeOldSurvey32264920130415132437
 *
 * @ORM\Table(name="lime_old_survey_322649_20130415132437")
 * @ORM\Entity
 */
class LimeOldSurvey32264920130415132437
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
     * @var string
     *
     * @ORM\Column(name="322649X24X339SQ001", type="text", nullable=true)
     */
    private $322649x24x339sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X24X339SQ002", type="text", nullable=true)
     */
    private $322649x24x339sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X24X341", type="string", length=1, nullable=true)
     */
    private $322649x24x341;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X24X342", type="text", nullable=true)
     */
    private $322649x24x342;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X24X343SQ001", type="string", length=5, nullable=true)
     */
    private $322649x24x343sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X24X343SQ002", type="string", length=5, nullable=true)
     */
    private $322649x24x343sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X24X343SQ003", type="string", length=5, nullable=true)
     */
    private $322649x24x343sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X24X343SQ004", type="string", length=5, nullable=true)
     */
    private $322649x24x343sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X24X343other", type="text", nullable=true)
     */
    private $322649x24x343other;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X24X348SQ001", type="string", length=5, nullable=true)
     */
    private $322649x24x348sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X24X348SQ002", type="string", length=5, nullable=true)
     */
    private $322649x24x348sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X24X348SQ003", type="string", length=5, nullable=true)
     */
    private $322649x24x348sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X24X348SQ004", type="string", length=5, nullable=true)
     */
    private $322649x24x348sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X24X348other", type="text", nullable=true)
     */
    private $322649x24x348other;

    /**
     * @var float
     *
     * @ORM\Column(name="322649X25X354", type="decimal", nullable=true)
     */
    private $322649x25x354;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="322649X25X355", type="datetime", nullable=true)
     */
    private $322649x25x355;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X3561", type="string", length=5, nullable=true)
     */
    private $322649x25x3561;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X3561comment", type="text", nullable=true)
     */
    private $322649x25x3561comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X3562", type="string", length=5, nullable=true)
     */
    private $322649x25x3562;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X3562comment", type="text", nullable=true)
     */
    private $322649x25x3562comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X3563", type="string", length=5, nullable=true)
     */
    private $322649x25x3563;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X3563comment", type="text", nullable=true)
     */
    private $322649x25x3563comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X3564", type="string", length=5, nullable=true)
     */
    private $322649x25x3564;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X3564comment", type="text", nullable=true)
     */
    private $322649x25x3564comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X3565", type="string", length=5, nullable=true)
     */
    private $322649x25x3565;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X3565comment", type="text", nullable=true)
     */
    private $322649x25x3565comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X3566", type="string", length=5, nullable=true)
     */
    private $322649x25x3566;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X3566comment", type="text", nullable=true)
     */
    private $322649x25x3566comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X3567", type="string", length=5, nullable=true)
     */
    private $322649x25x3567;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X3567comment", type="text", nullable=true)
     */
    private $322649x25x3567comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X3568", type="string", length=5, nullable=true)
     */
    private $322649x25x3568;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X3568comment", type="text", nullable=true)
     */
    private $322649x25x3568comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X3569", type="string", length=5, nullable=true)
     */
    private $322649x25x3569;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X3569comment", type="text", nullable=true)
     */
    private $322649x25x3569comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X35610", type="string", length=5, nullable=true)
     */
    private $322649x25x35610;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X35610comment", type="text", nullable=true)
     */
    private $322649x25x35610comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X35611", type="string", length=5, nullable=true)
     */
    private $322649x25x35611;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X35611comment", type="text", nullable=true)
     */
    private $322649x25x35611comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X35612", type="string", length=5, nullable=true)
     */
    private $322649x25x35612;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X35612comment", type="text", nullable=true)
     */
    private $322649x25x35612comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X35613", type="string", length=5, nullable=true)
     */
    private $322649x25x35613;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X35613comment", type="text", nullable=true)
     */
    private $322649x25x35613comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X35614", type="string", length=5, nullable=true)
     */
    private $322649x25x35614;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X35614comment", type="text", nullable=true)
     */
    private $322649x25x35614comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X35615", type="string", length=5, nullable=true)
     */
    private $322649x25x35615;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X35615comment", type="text", nullable=true)
     */
    private $322649x25x35615comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X373", type="string", length=1, nullable=true)
     */
    private $322649x25x373;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X25X374", type="text", nullable=true)
     */
    private $322649x25x374;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X32X4361", type="string", length=5, nullable=true)
     */
    private $322649x32x4361;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X32X4361comment", type="text", nullable=true)
     */
    private $322649x32x4361comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X32X4362", type="string", length=5, nullable=true)
     */
    private $322649x32x4362;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X32X4362comment", type="text", nullable=true)
     */
    private $322649x32x4362comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X32X4363", type="string", length=5, nullable=true)
     */
    private $322649x32x4363;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X32X4363comment", type="text", nullable=true)
     */
    private $322649x32x4363comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X32X4364", type="string", length=5, nullable=true)
     */
    private $322649x32x4364;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X32X4364comment", type="text", nullable=true)
     */
    private $322649x32x4364comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X32X4365", type="string", length=5, nullable=true)
     */
    private $322649x32x4365;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X32X4365comment", type="text", nullable=true)
     */
    private $322649x32x4365comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X32X4366", type="string", length=5, nullable=true)
     */
    private $322649x32x4366;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X32X4366comment", type="text", nullable=true)
     */
    private $322649x32x4366comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X32X4367", type="string", length=5, nullable=true)
     */
    private $322649x32x4367;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X32X4367comment", type="text", nullable=true)
     */
    private $322649x32x4367comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X32X4368", type="string", length=5, nullable=true)
     */
    private $322649x32x4368;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X32X4368comment", type="text", nullable=true)
     */
    private $322649x32x4368comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X32X446", type="string", length=1, nullable=true)
     */
    private $322649x32x446;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X32X447", type="text", nullable=true)
     */
    private $322649x32x447;

    /**
     * @var float
     *
     * @ORM\Column(name="322649X33X462SQ001", type="float", nullable=true)
     */
    private $322649x33x462sq001;

    /**
     * @var float
     *
     * @ORM\Column(name="322649X33X462SQ002", type="float", nullable=true)
     */
    private $322649x33x462sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X33X464", type="string", length=5, nullable=true)
     */
    private $322649x33x464;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X33X465", type="string", length=5, nullable=true)
     */
    private $322649x33x465;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X41X466", type="text", nullable=true)
     */
    private $322649x41x466;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X41X467", type="text", nullable=true)
     */
    private $322649x41x467;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X41X468", type="text", nullable=true)
     */
    private $322649x41x468;

    /**
     * @var float
     *
     * @ORM\Column(name="322649X27X411", type="decimal", nullable=true)
     */
    private $322649x27x411;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="322649X27X412", type="datetime", nullable=true)
     */
    private $322649x27x412;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X4131", type="string", length=5, nullable=true)
     */
    private $322649x27x4131;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X4131comment", type="text", nullable=true)
     */
    private $322649x27x4131comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X4132", type="string", length=5, nullable=true)
     */
    private $322649x27x4132;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X4132comment", type="text", nullable=true)
     */
    private $322649x27x4132comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X4133", type="string", length=5, nullable=true)
     */
    private $322649x27x4133;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X4133comment", type="text", nullable=true)
     */
    private $322649x27x4133comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X4134", type="string", length=5, nullable=true)
     */
    private $322649x27x4134;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X4134comment", type="text", nullable=true)
     */
    private $322649x27x4134comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X4135", type="string", length=5, nullable=true)
     */
    private $322649x27x4135;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X4135comment", type="text", nullable=true)
     */
    private $322649x27x4135comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X4136", type="string", length=5, nullable=true)
     */
    private $322649x27x4136;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X4136comment", type="text", nullable=true)
     */
    private $322649x27x4136comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X4137", type="string", length=5, nullable=true)
     */
    private $322649x27x4137;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X4137comment", type="text", nullable=true)
     */
    private $322649x27x4137comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X4138", type="string", length=5, nullable=true)
     */
    private $322649x27x4138;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X4138comment", type="text", nullable=true)
     */
    private $322649x27x4138comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X4139", type="string", length=5, nullable=true)
     */
    private $322649x27x4139;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X4139comment", type="text", nullable=true)
     */
    private $322649x27x4139comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X41310", type="string", length=5, nullable=true)
     */
    private $322649x27x41310;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X41310comment", type="text", nullable=true)
     */
    private $322649x27x41310comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X41311", type="string", length=5, nullable=true)
     */
    private $322649x27x41311;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X41311comment", type="text", nullable=true)
     */
    private $322649x27x41311comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X41312", type="string", length=5, nullable=true)
     */
    private $322649x27x41312;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X41312comment", type="text", nullable=true)
     */
    private $322649x27x41312comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X41313", type="string", length=5, nullable=true)
     */
    private $322649x27x41313;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X41313comment", type="text", nullable=true)
     */
    private $322649x27x41313comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X41314", type="string", length=5, nullable=true)
     */
    private $322649x27x41314;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X41314comment", type="text", nullable=true)
     */
    private $322649x27x41314comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X41315", type="string", length=5, nullable=true)
     */
    private $322649x27x41315;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X41315comment", type="text", nullable=true)
     */
    private $322649x27x41315comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X41316", type="string", length=5, nullable=true)
     */
    private $322649x27x41316;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X41316comment", type="text", nullable=true)
     */
    private $322649x27x41316comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X41317", type="string", length=5, nullable=true)
     */
    private $322649x27x41317;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X41317comment", type="text", nullable=true)
     */
    private $322649x27x41317comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X41318", type="string", length=5, nullable=true)
     */
    private $322649x27x41318;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X41318comment", type="text", nullable=true)
     */
    private $322649x27x41318comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X41319", type="string", length=5, nullable=true)
     */
    private $322649x27x41319;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X41319comment", type="text", nullable=true)
     */
    private $322649x27x41319comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X434", type="string", length=1, nullable=true)
     */
    private $322649x27x434;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X27X435", type="text", nullable=true)
     */
    private $322649x27x435;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X28X4481", type="string", length=5, nullable=true)
     */
    private $322649x28x4481;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X28X4481comment", type="text", nullable=true)
     */
    private $322649x28x4481comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X28X4482", type="string", length=5, nullable=true)
     */
    private $322649x28x4482;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X28X4482comment", type="text", nullable=true)
     */
    private $322649x28x4482comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X28X4483", type="string", length=5, nullable=true)
     */
    private $322649x28x4483;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X28X4483comment", type="text", nullable=true)
     */
    private $322649x28x4483comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X28X4484", type="string", length=5, nullable=true)
     */
    private $322649x28x4484;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X28X4484comment", type="text", nullable=true)
     */
    private $322649x28x4484comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X28X4485", type="string", length=5, nullable=true)
     */
    private $322649x28x4485;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X28X4485comment", type="text", nullable=true)
     */
    private $322649x28x4485comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X28X4486", type="string", length=5, nullable=true)
     */
    private $322649x28x4486;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X28X4486comment", type="text", nullable=true)
     */
    private $322649x28x4486comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X28X4487", type="string", length=5, nullable=true)
     */
    private $322649x28x4487;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X28X4487comment", type="text", nullable=true)
     */
    private $322649x28x4487comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X28X4488", type="string", length=5, nullable=true)
     */
    private $322649x28x4488;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X28X4488comment", type="text", nullable=true)
     */
    private $322649x28x4488comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X28X4489", type="string", length=5, nullable=true)
     */
    private $322649x28x4489;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X28X4489comment", type="text", nullable=true)
     */
    private $322649x28x4489comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X28X44810", type="string", length=5, nullable=true)
     */
    private $322649x28x44810;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X28X44810comment", type="text", nullable=true)
     */
    private $322649x28x44810comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X28X460", type="string", length=1, nullable=true)
     */
    private $322649x28x460;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X28X461", type="text", nullable=true)
     */
    private $322649x28x461;

    /**
     * @var float
     *
     * @ORM\Column(name="322649X29X469SQ001", type="float", nullable=true)
     */
    private $322649x29x469sq001;

    /**
     * @var float
     *
     * @ORM\Column(name="322649X29X469SQ002", type="float", nullable=true)
     */
    private $322649x29x469sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X29X471", type="string", length=5, nullable=true)
     */
    private $322649x29x471;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X29X472", type="string", length=5, nullable=true)
     */
    private $322649x29x472;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X42X473", type="text", nullable=true)
     */
    private $322649x42x473;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X42X474", type="text", nullable=true)
     */
    private $322649x42x474;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X42X475", type="text", nullable=true)
     */
    private $322649x42x475;

    /**
     * @var float
     *
     * @ORM\Column(name="322649X26X375", type="decimal", nullable=true)
     */
    private $322649x26x375;

    /**
     * @var float
     *
     * @ORM\Column(name="322649X26X376", type="decimal", nullable=true)
     */
    private $322649x26x376;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="322649X26X377", type="datetime", nullable=true)
     */
    private $322649x26x377;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X3781", type="string", length=5, nullable=true)
     */
    private $322649x26x3781;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X3781comment", type="text", nullable=true)
     */
    private $322649x26x3781comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X3782", type="string", length=5, nullable=true)
     */
    private $322649x26x3782;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X3782comment", type="text", nullable=true)
     */
    private $322649x26x3782comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X3783", type="string", length=5, nullable=true)
     */
    private $322649x26x3783;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X3783comment", type="text", nullable=true)
     */
    private $322649x26x3783comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X3784", type="string", length=5, nullable=true)
     */
    private $322649x26x3784;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X3784comment", type="text", nullable=true)
     */
    private $322649x26x3784comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X3785", type="string", length=5, nullable=true)
     */
    private $322649x26x3785;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X3785comment", type="text", nullable=true)
     */
    private $322649x26x3785comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X3786", type="string", length=5, nullable=true)
     */
    private $322649x26x3786;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X3786comment", type="text", nullable=true)
     */
    private $322649x26x3786comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X3787", type="string", length=5, nullable=true)
     */
    private $322649x26x3787;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X3787comment", type="text", nullable=true)
     */
    private $322649x26x3787comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X3788", type="string", length=5, nullable=true)
     */
    private $322649x26x3788;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X3788comment", type="text", nullable=true)
     */
    private $322649x26x3788comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X3789", type="string", length=5, nullable=true)
     */
    private $322649x26x3789;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X3789comment", type="text", nullable=true)
     */
    private $322649x26x3789comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37810", type="string", length=5, nullable=true)
     */
    private $322649x26x37810;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37810comment", type="text", nullable=true)
     */
    private $322649x26x37810comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37811", type="string", length=5, nullable=true)
     */
    private $322649x26x37811;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37811comment", type="text", nullable=true)
     */
    private $322649x26x37811comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37812", type="string", length=5, nullable=true)
     */
    private $322649x26x37812;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37812comment", type="text", nullable=true)
     */
    private $322649x26x37812comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37813", type="string", length=5, nullable=true)
     */
    private $322649x26x37813;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37813comment", type="text", nullable=true)
     */
    private $322649x26x37813comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37814", type="string", length=5, nullable=true)
     */
    private $322649x26x37814;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37814comment", type="text", nullable=true)
     */
    private $322649x26x37814comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37815", type="string", length=5, nullable=true)
     */
    private $322649x26x37815;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37815comment", type="text", nullable=true)
     */
    private $322649x26x37815comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37816", type="string", length=5, nullable=true)
     */
    private $322649x26x37816;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37816comment", type="text", nullable=true)
     */
    private $322649x26x37816comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37817", type="string", length=5, nullable=true)
     */
    private $322649x26x37817;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37817comment", type="text", nullable=true)
     */
    private $322649x26x37817comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37818", type="string", length=5, nullable=true)
     */
    private $322649x26x37818;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37818comment", type="text", nullable=true)
     */
    private $322649x26x37818comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37819", type="string", length=5, nullable=true)
     */
    private $322649x26x37819;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37819comment", type="text", nullable=true)
     */
    private $322649x26x37819comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37820", type="string", length=5, nullable=true)
     */
    private $322649x26x37820;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37820comment", type="text", nullable=true)
     */
    private $322649x26x37820comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37821", type="string", length=5, nullable=true)
     */
    private $322649x26x37821;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37821comment", type="text", nullable=true)
     */
    private $322649x26x37821comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37822", type="string", length=5, nullable=true)
     */
    private $322649x26x37822;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37822comment", type="text", nullable=true)
     */
    private $322649x26x37822comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37823", type="string", length=5, nullable=true)
     */
    private $322649x26x37823;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37823comment", type="text", nullable=true)
     */
    private $322649x26x37823comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37824", type="string", length=5, nullable=true)
     */
    private $322649x26x37824;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37824comment", type="text", nullable=true)
     */
    private $322649x26x37824comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37825", type="string", length=5, nullable=true)
     */
    private $322649x26x37825;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37825comment", type="text", nullable=true)
     */
    private $322649x26x37825comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37826", type="string", length=5, nullable=true)
     */
    private $322649x26x37826;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37826comment", type="text", nullable=true)
     */
    private $322649x26x37826comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37827", type="string", length=5, nullable=true)
     */
    private $322649x26x37827;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37827comment", type="text", nullable=true)
     */
    private $322649x26x37827comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37828", type="string", length=5, nullable=true)
     */
    private $322649x26x37828;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37828comment", type="text", nullable=true)
     */
    private $322649x26x37828comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37829", type="string", length=5, nullable=true)
     */
    private $322649x26x37829;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37829comment", type="text", nullable=true)
     */
    private $322649x26x37829comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37830", type="string", length=5, nullable=true)
     */
    private $322649x26x37830;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37830comment", type="text", nullable=true)
     */
    private $322649x26x37830comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37831", type="string", length=5, nullable=true)
     */
    private $322649x26x37831;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X26X37831comment", type="text", nullable=true)
     */
    private $322649x26x37831comment;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X30X476", type="string", length=1, nullable=true)
     */
    private $322649x30x476;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X30X477", type="string", length=5, nullable=true)
     */
    private $322649x30x477;

    /**
     * @var string
     *
     * @ORM\Column(name="322649X30X478", type="string", length=5, nullable=true)
     */
    private $322649x30x478;


}
