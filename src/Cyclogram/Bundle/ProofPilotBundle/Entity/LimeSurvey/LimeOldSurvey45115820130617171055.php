<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeOldSurvey45115820130617171055
 *
 * @ORM\Table(name="lime_old_survey_451158_20130617171055")
 * @ORM\Entity
 */
class LimeOldSurvey45115820130617171055
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
     * @ORM\Column(name="451158X83X1096SQ001", type="text", nullable=true)
     */
    private $451158x83x1096sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X83X1096SQ002", type="text", nullable=true)
     */
    private $451158x83x1096sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X83X10971", type="string", length=5, nullable=true)
     */
    private $451158x83x10971;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X83X10972", type="string", length=5, nullable=true)
     */
    private $451158x83x10972;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X83X10973", type="string", length=5, nullable=true)
     */
    private $451158x83x10973;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X83X10974", type="string", length=5, nullable=true)
     */
    private $451158x83x10974;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X83X10975", type="string", length=5, nullable=true)
     */
    private $451158x83x10975;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X83X10976", type="string", length=5, nullable=true)
     */
    private $451158x83x10976;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X83X1098", type="string", length=5, nullable=true)
     */
    private $451158x83x1098;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X83X1099", type="decimal", nullable=true)
     */
    private $451158x83x1099;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X83X11001", type="string", length=5, nullable=true)
     */
    private $451158x83x11001;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X83X11002", type="string", length=5, nullable=true)
     */
    private $451158x83x11002;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X83X11003", type="string", length=5, nullable=true)
     */
    private $451158x83x11003;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X83X11004", type="string", length=5, nullable=true)
     */
    private $451158x83x11004;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X83X11005", type="string", length=5, nullable=true)
     */
    private $451158x83x11005;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X83X11007", type="string", length=5, nullable=true)
     */
    private $451158x83x11007;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X83X11008", type="string", length=5, nullable=true)
     */
    private $451158x83x11008;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X83X1100other", type="text", nullable=true)
     */
    private $451158x83x1100other;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X84X1101", type="string", length=5, nullable=true)
     */
    private $451158x84x1101;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X84X1102", type="string", length=5, nullable=true)
     */
    private $451158x84x1102;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X84X1103", type="string", length=5, nullable=true)
     */
    private $451158x84x1103;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X85X1104", type="string", length=5, nullable=true)
     */
    private $451158x85x1104;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X85X1105", type="string", length=5, nullable=true)
     */
    private $451158x85x1105;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X85X1105other", type="text", nullable=true)
     */
    private $451158x85x1105other;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X85X1106", type="string", length=5, nullable=true)
     */
    private $451158x85x1106;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X85X1106other", type="text", nullable=true)
     */
    private $451158x85x1106other;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X85X1107", type="string", length=5, nullable=true)
     */
    private $451158x85x1107;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X85X1108", type="string", length=5, nullable=true)
     */
    private $451158x85x1108;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X85X1109", type="string", length=5, nullable=true)
     */
    private $451158x85x1109;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X85X11101", type="string", length=5, nullable=true)
     */
    private $451158x85x11101;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X85X11102", type="string", length=5, nullable=true)
     */
    private $451158x85x11102;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X85X11103", type="string", length=5, nullable=true)
     */
    private $451158x85x11103;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X85X11104", type="string", length=5, nullable=true)
     */
    private $451158x85x11104;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X85X11105", type="string", length=5, nullable=true)
     */
    private $451158x85x11105;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X85X11106", type="string", length=5, nullable=true)
     */
    private $451158x85x11106;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X86X1111", type="string", length=5, nullable=true)
     */
    private $451158x86x1111;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X86X1112", type="string", length=5, nullable=true)
     */
    private $451158x86x1112;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X86X1113", type="string", length=5, nullable=true)
     */
    private $451158x86x1113;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X86X1114", type="string", length=5, nullable=true)
     */
    private $451158x86x1114;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X86X11151", type="string", length=5, nullable=true)
     */
    private $451158x86x11151;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X86X11152", type="string", length=5, nullable=true)
     */
    private $451158x86x11152;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X86X11153", type="string", length=5, nullable=true)
     */
    private $451158x86x11153;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X86X11154", type="string", length=5, nullable=true)
     */
    private $451158x86x11154;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X86X11155", type="string", length=5, nullable=true)
     */
    private $451158x86x11155;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X86X11156", type="string", length=5, nullable=true)
     */
    private $451158x86x11156;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X86X11157", type="string", length=5, nullable=true)
     */
    private $451158x86x11157;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X86X11158", type="string", length=5, nullable=true)
     */
    private $451158x86x11158;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X86X11159", type="string", length=5, nullable=true)
     */
    private $451158x86x11159;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X86X111510", type="string", length=5, nullable=true)
     */
    private $451158x86x111510;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X86X111511", type="string", length=5, nullable=true)
     */
    private $451158x86x111511;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X86X111512", type="string", length=5, nullable=true)
     */
    private $451158x86x111512;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X86X111513", type="string", length=5, nullable=true)
     */
    private $451158x86x111513;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X86X111514", type="string", length=5, nullable=true)
     */
    private $451158x86x111514;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X87X1116", type="string", length=5, nullable=true)
     */
    private $451158x87x1116;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X87X1116other", type="text", nullable=true)
     */
    private $451158x87x1116other;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X87X1117", type="string", length=5, nullable=true)
     */
    private $451158x87x1117;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X87X1117other", type="text", nullable=true)
     */
    private $451158x87x1117other;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X87X1118", type="string", length=5, nullable=true)
     */
    private $451158x87x1118;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X87X1118other", type="text", nullable=true)
     */
    private $451158x87x1118other;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X87X1119", type="text", nullable=true)
     */
    private $451158x87x1119;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X87X11201", type="string", length=5, nullable=true)
     */
    private $451158x87x11201;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X87X11201comment", type="text", nullable=true)
     */
    private $451158x87x11201comment;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X87X11202", type="string", length=5, nullable=true)
     */
    private $451158x87x11202;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X87X11202comment", type="text", nullable=true)
     */
    private $451158x87x11202comment;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X87X11203", type="string", length=5, nullable=true)
     */
    private $451158x87x11203;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X87X11203comment", type="text", nullable=true)
     */
    private $451158x87x11203comment;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X87X1121", type="decimal", nullable=true)
     */
    private $451158x87x1121;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X87X1122", type="decimal", nullable=true)
     */
    private $451158x87x1122;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X87X1123", type="decimal", nullable=true)
     */
    private $451158x87x1123;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X87X1124", type="decimal", nullable=true)
     */
    private $451158x87x1124;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X87X1125", type="decimal", nullable=true)
     */
    private $451158x87x1125;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X87X1126", type="decimal", nullable=true)
     */
    private $451158x87x1126;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X87X1127", type="decimal", nullable=true)
     */
    private $451158x87x1127;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X87X1128", type="decimal", nullable=true)
     */
    private $451158x87x1128;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X87X1129", type="decimal", nullable=true)
     */
    private $451158x87x1129;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X87X1130", type="decimal", nullable=true)
     */
    private $451158x87x1130;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X87X1131", type="decimal", nullable=true)
     */
    private $451158x87x1131;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X87X1132", type="decimal", nullable=true)
     */
    private $451158x87x1132;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X87X1133", type="decimal", nullable=true)
     */
    private $451158x87x1133;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X87X1134", type="decimal", nullable=true)
     */
    private $451158x87x1134;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X87X1135", type="decimal", nullable=true)
     */
    private $451158x87x1135;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X88X1136", type="string", length=5, nullable=true)
     */
    private $451158x88x1136;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X88X1136other", type="text", nullable=true)
     */
    private $451158x88x1136other;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X88X11371", type="string", length=5, nullable=true)
     */
    private $451158x88x11371;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X88X11371comment", type="text", nullable=true)
     */
    private $451158x88x11371comment;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X88X11372", type="string", length=5, nullable=true)
     */
    private $451158x88x11372;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X88X11372comment", type="text", nullable=true)
     */
    private $451158x88x11372comment;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X88X11373", type="string", length=5, nullable=true)
     */
    private $451158x88x11373;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X88X11373comment", type="text", nullable=true)
     */
    private $451158x88x11373comment;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X88X1138", type="decimal", nullable=true)
     */
    private $451158x88x1138;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X88X1139", type="decimal", nullable=true)
     */
    private $451158x88x1139;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X88X1140", type="decimal", nullable=true)
     */
    private $451158x88x1140;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X88X1141", type="decimal", nullable=true)
     */
    private $451158x88x1141;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X88X1142", type="decimal", nullable=true)
     */
    private $451158x88x1142;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X88X1143", type="decimal", nullable=true)
     */
    private $451158x88x1143;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X88X1144", type="decimal", nullable=true)
     */
    private $451158x88x1144;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X88X1145", type="decimal", nullable=true)
     */
    private $451158x88x1145;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X88X1146", type="decimal", nullable=true)
     */
    private $451158x88x1146;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X88X1147", type="decimal", nullable=true)
     */
    private $451158x88x1147;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X88X1148", type="decimal", nullable=true)
     */
    private $451158x88x1148;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X88X1149", type="decimal", nullable=true)
     */
    private $451158x88x1149;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X88X1150", type="decimal", nullable=true)
     */
    private $451158x88x1150;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X88X1151", type="decimal", nullable=true)
     */
    private $451158x88x1151;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X88X1152", type="decimal", nullable=true)
     */
    private $451158x88x1152;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X88X1153", type="decimal", nullable=true)
     */
    private $451158x88x1153;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X88X1154", type="decimal", nullable=true)
     */
    private $451158x88x1154;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X88X1155", type="decimal", nullable=true)
     */
    private $451158x88x1155;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X88X1156", type="decimal", nullable=true)
     */
    private $451158x88x1156;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X89X1157", type="decimal", nullable=true)
     */
    private $451158x89x1157;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X89X1158", type="decimal", nullable=true)
     */
    private $451158x89x1158;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X89X1159", type="decimal", nullable=true)
     */
    private $451158x89x1159;

    /**
     * @var float
     *
     * @ORM\Column(name="451158X89X1160", type="decimal", nullable=true)
     */
    private $451158x89x1160;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X90X11611", type="string", length=5, nullable=true)
     */
    private $451158x90x11611;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X90X11621", type="string", length=5, nullable=true)
     */
    private $451158x90x11621;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X90X11631", type="string", length=5, nullable=true)
     */
    private $451158x90x11631;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X90X11632", type="string", length=5, nullable=true)
     */
    private $451158x90x11632;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X90X11633", type="string", length=5, nullable=true)
     */
    private $451158x90x11633;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X90X11641", type="string", length=5, nullable=true)
     */
    private $451158x90x11641;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X90X11642", type="string", length=5, nullable=true)
     */
    private $451158x90x11642;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X90X11643", type="string", length=5, nullable=true)
     */
    private $451158x90x11643;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X90X11651", type="string", length=5, nullable=true)
     */
    private $451158x90x11651;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X90X11652", type="string", length=5, nullable=true)
     */
    private $451158x90x11652;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X90X11661", type="string", length=5, nullable=true)
     */
    private $451158x90x11661;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X90X11662", type="string", length=5, nullable=true)
     */
    private $451158x90x11662;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X90X11663", type="string", length=5, nullable=true)
     */
    private $451158x90x11663;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X90X1167", type="text", nullable=true)
     */
    private $451158x90x1167;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X90X1168", type="text", nullable=true)
     */
    private $451158x90x1168;

    /**
     * @var string
     *
     * @ORM\Column(name="451158X90X1169", type="text", nullable=true)
     */
    private $451158x90x1169;


}
