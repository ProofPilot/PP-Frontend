<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeSurvey365338
 *
 * @ORM\Table(name="lime_survey_365338")
 * @ORM\Entity
 */
class LimeSurvey365338
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
//      * @ORM\Column(name="365338X15X177", type="string", length=5, nullable=true)
//      */
//     private $365338x15x177;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X15X178", type="string", length=5, nullable=true)
//      */
//     private $365338x15x178;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X15X179", type="string", length=5, nullable=true)
//      */
//     private $365338x15x179;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X15X180", type="string", length=5, nullable=true)
//      */
//     private $365338x15x180;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X15X181", type="string", length=5, nullable=true)
//      */
//     private $365338x15x181;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="365338X15X182", type="decimal", nullable=true)
//      */
//     private $365338x15x182;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X15X183", type="string", length=5, nullable=true)
//      */
//     private $365338x15x183;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X15X183other", type="text", nullable=true)
//      */
//     private $365338x15x183other;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X15X184", type="string", length=5, nullable=true)
//      */
//     private $365338x15x184;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X15X185", type="string", length=5, nullable=true)
//      */
//     private $365338x15x185;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X16X1861", type="string", length=5, nullable=true)
//      */
//     private $365338x16x1861;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X16X1862", type="string", length=5, nullable=true)
//      */
//     private $365338x16x1862;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X16X1863", type="string", length=5, nullable=true)
//      */
//     private $365338x16x1863;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X16X1864", type="string", length=5, nullable=true)
//      */
//     private $365338x16x1864;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X16X1865", type="string", length=5, nullable=true)
//      */
//     private $365338x16x1865;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X16X1866", type="string", length=5, nullable=true)
//      */
//     private $365338x16x1866;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X16X1867", type="string", length=5, nullable=true)
//      */
//     private $365338x16x1867;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X16X1868", type="string", length=5, nullable=true)
//      */
//     private $365338x16x1868;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X16X1869", type="string", length=5, nullable=true)
//      */
//     private $365338x16x1869;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X16X18610", type="string", length=5, nullable=true)
//      */
//     private $365338x16x18610;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X16X18611", type="string", length=5, nullable=true)
//      */
//     private $365338x16x18611;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X16X18612", type="string", length=5, nullable=true)
//      */
//     private $365338x16x18612;

//     /**
//      * @var \DateTime
//      *
//      * @ORM\Column(name="365338X17X201", type="datetime", nullable=true)
//      */
//     private $365338x17x201;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="365338X17X202", type="decimal", nullable=true)
//      */
//     private $365338x17x202;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X17X203", type="string", length=5, nullable=true)
//      */
//     private $365338x17x203;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X17X204", type="string", length=5, nullable=true)
//      */
//     private $365338x17x204;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X205", type="string", length=5, nullable=true)
//      */
//     private $365338x18x205;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X206", type="string", length=5, nullable=true)
//      */
//     private $365338x18x206;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X207", type="string", length=5, nullable=true)
//      */
//     private $365338x18x207;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X208SQ001", type="string", length=5, nullable=true)
//      */
//     private $365338x18x208sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X208SQ002", type="string", length=5, nullable=true)
//      */
//     private $365338x18x208sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X208SQ003", type="string", length=5, nullable=true)
//      */
//     private $365338x18x208sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X208SQ004", type="string", length=5, nullable=true)
//      */
//     private $365338x18x208sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X208SQ005", type="string", length=5, nullable=true)
//      */
//     private $365338x18x208sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X208SQ006", type="string", length=5, nullable=true)
//      */
//     private $365338x18x208sq006;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X208SQ007", type="string", length=5, nullable=true)
//      */
//     private $365338x18x208sq007;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X208SQ008", type="string", length=5, nullable=true)
//      */
//     private $365338x18x208sq008;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X208SQ009", type="string", length=5, nullable=true)
//      */
//     private $365338x18x208sq009;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X208SQ010", type="string", length=5, nullable=true)
//      */
//     private $365338x18x208sq010;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X208SQ011", type="string", length=5, nullable=true)
//      */
//     private $365338x18x208sq011;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X208SQ012", type="string", length=5, nullable=true)
//      */
//     private $365338x18x208sq012;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X221", type="string", length=5, nullable=true)
//      */
//     private $365338x18x221;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X222SQ001", type="string", length=5, nullable=true)
//      */
//     private $365338x18x222sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X222SQ002", type="string", length=5, nullable=true)
//      */
//     private $365338x18x222sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X222SQ003", type="string", length=5, nullable=true)
//      */
//     private $365338x18x222sq003;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="365338X18X226", type="decimal", nullable=true)
//      */
//     private $365338x18x226;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X227SQ001", type="string", length=5, nullable=true)
//      */
//     private $365338x18x227sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X227SQ002", type="string", length=5, nullable=true)
//      */
//     private $365338x18x227sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X227SQ003", type="string", length=5, nullable=true)
//      */
//     private $365338x18x227sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X227SQ004", type="string", length=5, nullable=true)
//      */
//     private $365338x18x227sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X227SQ005", type="string", length=5, nullable=true)
//      */
//     private $365338x18x227sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X227SQ006", type="string", length=5, nullable=true)
//      */
//     private $365338x18x227sq006;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X227SQ007", type="string", length=5, nullable=true)
//      */
//     private $365338x18x227sq007;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X227SQ008", type="string", length=5, nullable=true)
//      */
//     private $365338x18x227sq008;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X227SQ009", type="string", length=5, nullable=true)
//      */
//     private $365338x18x227sq009;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X227SQ010", type="string", length=5, nullable=true)
//      */
//     private $365338x18x227sq010;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X238SQ001", type="string", length=5, nullable=true)
//      */
//     private $365338x18x238sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X238SQ002", type="string", length=5, nullable=true)
//      */
//     private $365338x18x238sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X238SQ003", type="string", length=5, nullable=true)
//      */
//     private $365338x18x238sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X238SQ004", type="string", length=5, nullable=true)
//      */
//     private $365338x18x238sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X238SQ005", type="string", length=5, nullable=true)
//      */
//     private $365338x18x238sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X18X238SQ006", type="string", length=5, nullable=true)
//      */
//     private $365338x18x238sq006;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X19X245", type="string", length=5, nullable=true)
//      */
//     private $365338x19x245;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X19X246", type="string", length=5, nullable=true)
//      */
//     private $365338x19x246;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X19X247SQ001", type="string", length=5, nullable=true)
//      */
//     private $365338x19x247sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X19X247SQ002", type="string", length=5, nullable=true)
//      */
//     private $365338x19x247sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X19X247SQ004", type="string", length=5, nullable=true)
//      */
//     private $365338x19x247sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X19X247SQ003", type="string", length=5, nullable=true)
//      */
//     private $365338x19x247sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X19X247SQ005", type="string", length=5, nullable=true)
//      */
//     private $365338x19x247sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X19X247SQ006", type="string", length=5, nullable=true)
//      */
//     private $365338x19x247sq006;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X19X247SQ007", type="string", length=5, nullable=true)
//      */
//     private $365338x19x247sq007;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X19X247SQ008", type="string", length=5, nullable=true)
//      */
//     private $365338x19x247sq008;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X19X247SQ009", type="string", length=5, nullable=true)
//      */
//     private $365338x19x247sq009;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X19X247SQ010", type="string", length=5, nullable=true)
//      */
//     private $365338x19x247sq010;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X19X247SQ011", type="string", length=5, nullable=true)
//      */
//     private $365338x19x247sq011;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X19X247SQ012", type="string", length=5, nullable=true)
//      */
//     private $365338x19x247sq012;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X19X247other", type="text", nullable=true)
//      */
//     private $365338x19x247other;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X19X260SQ001", type="string", length=5, nullable=true)
//      */
//     private $365338x19x260sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X262", type="string", length=5, nullable=true)
//      */
//     private $365338x20x262;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X263", type="string", length=5, nullable=true)
//      */
//     private $365338x20x263;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X264SQ001", type="string", length=5, nullable=true)
//      */
//     private $365338x20x264sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X264SQ002", type="string", length=5, nullable=true)
//      */
//     private $365338x20x264sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X264SQ003", type="string", length=5, nullable=true)
//      */
//     private $365338x20x264sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X264SQ004", type="string", length=5, nullable=true)
//      */
//     private $365338x20x264sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X264SQ005", type="string", length=5, nullable=true)
//      */
//     private $365338x20x264sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X264SQ006", type="string", length=5, nullable=true)
//      */
//     private $365338x20x264sq006;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X264SQ007", type="string", length=5, nullable=true)
//      */
//     private $365338x20x264sq007;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X264SQ008", type="string", length=5, nullable=true)
//      */
//     private $365338x20x264sq008;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X264SQ009", type="string", length=5, nullable=true)
//      */
//     private $365338x20x264sq009;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X264SQ010", type="string", length=5, nullable=true)
//      */
//     private $365338x20x264sq010;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X264SQ011", type="string", length=5, nullable=true)
//      */
//     private $365338x20x264sq011;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X264other", type="text", nullable=true)
//      */
//     private $365338x20x264other;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X276", type="string", length=5, nullable=true)
//      */
//     private $365338x20x276;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X277SQ001", type="string", length=5, nullable=true)
//      */
//     private $365338x20x277sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X277SQ002", type="string", length=5, nullable=true)
//      */
//     private $365338x20x277sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X277SQ003", type="string", length=5, nullable=true)
//      */
//     private $365338x20x277sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X277SQ004", type="string", length=5, nullable=true)
//      */
//     private $365338x20x277sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X277SQ005", type="string", length=5, nullable=true)
//      */
//     private $365338x20x277sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X277SQ006", type="string", length=5, nullable=true)
//      */
//     private $365338x20x277sq006;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X277SQ007", type="string", length=5, nullable=true)
//      */
//     private $365338x20x277sq007;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X277SQ008", type="string", length=5, nullable=true)
//      */
//     private $365338x20x277sq008;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X277other", type="text", nullable=true)
//      */
//     private $365338x20x277other;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X286", type="string", length=5, nullable=true)
//      */
//     private $365338x20x286;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X287SQ001", type="string", length=5, nullable=true)
//      */
//     private $365338x20x287sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X287SQ002", type="string", length=5, nullable=true)
//      */
//     private $365338x20x287sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X287SQ003", type="string", length=5, nullable=true)
//      */
//     private $365338x20x287sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X287SQ004", type="string", length=5, nullable=true)
//      */
//     private $365338x20x287sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X287SQ005", type="string", length=5, nullable=true)
//      */
//     private $365338x20x287sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X287SQ006", type="string", length=5, nullable=true)
//      */
//     private $365338x20x287sq006;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X287SQ007", type="string", length=5, nullable=true)
//      */
//     private $365338x20x287sq007;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X287SQ008", type="string", length=5, nullable=true)
//      */
//     private $365338x20x287sq008;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X287other", type="text", nullable=true)
//      */
//     private $365338x20x287other;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X296", type="string", length=5, nullable=true)
//      */
//     private $365338x20x296;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X297SQ001", type="string", length=5, nullable=true)
//      */
//     private $365338x20x297sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X297SQ002", type="string", length=5, nullable=true)
//      */
//     private $365338x20x297sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X297SQ003", type="string", length=5, nullable=true)
//      */
//     private $365338x20x297sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X297SQ004", type="string", length=5, nullable=true)
//      */
//     private $365338x20x297sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X297SQ005", type="string", length=5, nullable=true)
//      */
//     private $365338x20x297sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X297SQ006", type="string", length=5, nullable=true)
//      */
//     private $365338x20x297sq006;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X297SQ007", type="string", length=5, nullable=true)
//      */
//     private $365338x20x297sq007;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X297SQ008", type="string", length=5, nullable=true)
//      */
//     private $365338x20x297sq008;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X297SQ009", type="string", length=5, nullable=true)
//      */
//     private $365338x20x297sq009;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X297other", type="text", nullable=true)
//      */
//     private $365338x20x297other;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X307SQ001", type="string", length=5, nullable=true)
//      */
//     private $365338x20x307sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X307SQ002", type="string", length=5, nullable=true)
//      */
//     private $365338x20x307sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X307SQ003", type="string", length=5, nullable=true)
//      */
//     private $365338x20x307sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X307SQ004", type="string", length=5, nullable=true)
//      */
//     private $365338x20x307sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X307SQ005", type="string", length=5, nullable=true)
//      */
//     private $365338x20x307sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X307SQ006", type="string", length=5, nullable=true)
//      */
//     private $365338x20x307sq006;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X307SQ007", type="string", length=5, nullable=true)
//      */
//     private $365338x20x307sq007;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X307SQ008", type="string", length=5, nullable=true)
//      */
//     private $365338x20x307sq008;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X20X307other", type="text", nullable=true)
//      */
//     private $365338x20x307other;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X21X316", type="string", length=5, nullable=true)
//      */
//     private $365338x21x316;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X21X317", type="string", length=5, nullable=true)
//      */
//     private $365338x21x317;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X21X318", type="string", length=5, nullable=true)
//      */
//     private $365338x21x318;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="365338X21X319", type="string", length=5, nullable=true)
//      */
//     private $365338x21x319;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="365338X22X320", type="decimal", nullable=true)
//      */
//     private $365338x22x320;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="365338X22X321", type="decimal", nullable=true)
//      */
//     private $365338x22x321;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="365338X22X322", type="decimal", nullable=true)
//      */
//     private $365338x22x322;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="365338X22X323", type="decimal", nullable=true)
//      */
//     private $365338x22x323;


}
