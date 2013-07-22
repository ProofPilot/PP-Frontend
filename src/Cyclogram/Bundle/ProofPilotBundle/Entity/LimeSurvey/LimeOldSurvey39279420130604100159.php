<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeOldSurvey39279420130604100159
 *
 * @ORM\Table(name="lime_old_survey_392794_20130604100159")
 * @ORM\Entity
 */
class LimeOldSurvey39279420130604100159
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
     * @ORM\Column(name="392794X58X732SQ001", type="text", nullable=true)
     */
    private $392794x58x732sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X58X732SQ002", type="text", nullable=true)
     */
    private $392794x58x732sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X58X733", type="string", length=1, nullable=true)
     */
    private $392794x58x733;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X58X734", type="text", nullable=true)
     */
    private $392794x58x734;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X58X735SQ001", type="string", length=5, nullable=true)
     */
    private $392794x58x735sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X58X735SQ002", type="string", length=5, nullable=true)
     */
    private $392794x58x735sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X58X735SQ003", type="string", length=5, nullable=true)
     */
    private $392794x58x735sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X58X735SQ004", type="string", length=5, nullable=true)
     */
    private $392794x58x735sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X58X735other", type="text", nullable=true)
     */
    private $392794x58x735other;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X58X736SQ001", type="string", length=5, nullable=true)
     */
    private $392794x58x736sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X58X736SQ002", type="string", length=5, nullable=true)
     */
    private $392794x58x736sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X58X736SQ003", type="string", length=5, nullable=true)
     */
    private $392794x58x736sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X58X736SQ004", type="string", length=5, nullable=true)
     */
    private $392794x58x736sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X58X736other", type="text", nullable=true)
     */
    private $392794x58x736other;

    /**
     * @var float
     *
     * @ORM\Column(name="392794X59X737", type="decimal", nullable=true)
     */
    private $392794x59x737;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="392794X59X738", type="datetime", nullable=true)
     */
    private $392794x59x738;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X7391", type="string", length=5, nullable=true)
     */
    private $392794x59x7391;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X7391comment", type="text", nullable=true)
     */
    private $392794x59x7391comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X7392", type="string", length=5, nullable=true)
     */
    private $392794x59x7392;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X7392comment", type="text", nullable=true)
     */
    private $392794x59x7392comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X7393", type="string", length=5, nullable=true)
     */
    private $392794x59x7393;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X7393comment", type="text", nullable=true)
     */
    private $392794x59x7393comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X7394", type="string", length=5, nullable=true)
     */
    private $392794x59x7394;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X7394comment", type="text", nullable=true)
     */
    private $392794x59x7394comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X7395", type="string", length=5, nullable=true)
     */
    private $392794x59x7395;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X7395comment", type="text", nullable=true)
     */
    private $392794x59x7395comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X7396", type="string", length=5, nullable=true)
     */
    private $392794x59x7396;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X7396comment", type="text", nullable=true)
     */
    private $392794x59x7396comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X7397", type="string", length=5, nullable=true)
     */
    private $392794x59x7397;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X7397comment", type="text", nullable=true)
     */
    private $392794x59x7397comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X7398", type="string", length=5, nullable=true)
     */
    private $392794x59x7398;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X7398comment", type="text", nullable=true)
     */
    private $392794x59x7398comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X7399", type="string", length=5, nullable=true)
     */
    private $392794x59x7399;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X7399comment", type="text", nullable=true)
     */
    private $392794x59x7399comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X73910", type="string", length=5, nullable=true)
     */
    private $392794x59x73910;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X73910comment", type="text", nullable=true)
     */
    private $392794x59x73910comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X73911", type="string", length=5, nullable=true)
     */
    private $392794x59x73911;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X73911comment", type="text", nullable=true)
     */
    private $392794x59x73911comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X73912", type="string", length=5, nullable=true)
     */
    private $392794x59x73912;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X73912comment", type="text", nullable=true)
     */
    private $392794x59x73912comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X73913", type="string", length=5, nullable=true)
     */
    private $392794x59x73913;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X73913comment", type="text", nullable=true)
     */
    private $392794x59x73913comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X73914", type="string", length=5, nullable=true)
     */
    private $392794x59x73914;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X73914comment", type="text", nullable=true)
     */
    private $392794x59x73914comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X73915", type="string", length=5, nullable=true)
     */
    private $392794x59x73915;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X73915comment", type="text", nullable=true)
     */
    private $392794x59x73915comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X740", type="string", length=1, nullable=true)
     */
    private $392794x59x740;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X59X741", type="text", nullable=true)
     */
    private $392794x59x741;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X65X7511", type="string", length=5, nullable=true)
     */
    private $392794x65x7511;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X65X7511comment", type="text", nullable=true)
     */
    private $392794x65x7511comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X65X7512", type="string", length=5, nullable=true)
     */
    private $392794x65x7512;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X65X7512comment", type="text", nullable=true)
     */
    private $392794x65x7512comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X65X7513", type="string", length=5, nullable=true)
     */
    private $392794x65x7513;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X65X7513comment", type="text", nullable=true)
     */
    private $392794x65x7513comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X65X7514", type="string", length=5, nullable=true)
     */
    private $392794x65x7514;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X65X7514comment", type="text", nullable=true)
     */
    private $392794x65x7514comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X65X7515", type="string", length=5, nullable=true)
     */
    private $392794x65x7515;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X65X7515comment", type="text", nullable=true)
     */
    private $392794x65x7515comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X65X7516", type="string", length=5, nullable=true)
     */
    private $392794x65x7516;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X65X7516comment", type="text", nullable=true)
     */
    private $392794x65x7516comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X65X7517", type="string", length=5, nullable=true)
     */
    private $392794x65x7517;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X65X7517comment", type="text", nullable=true)
     */
    private $392794x65x7517comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X65X7518", type="string", length=5, nullable=true)
     */
    private $392794x65x7518;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X65X7518comment", type="text", nullable=true)
     */
    private $392794x65x7518comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X65X752", type="string", length=1, nullable=true)
     */
    private $392794x65x752;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X65X753", type="text", nullable=true)
     */
    private $392794x65x753;

    /**
     * @var float
     *
     * @ORM\Column(name="392794X66X757SQ001", type="float", nullable=true)
     */
    private $392794x66x757sq001;

    /**
     * @var float
     *
     * @ORM\Column(name="392794X66X757SQ002", type="float", nullable=true)
     */
    private $392794x66x757sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X66X758", type="string", length=5, nullable=true)
     */
    private $392794x66x758;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X66X759", type="string", length=5, nullable=true)
     */
    private $392794x66x759;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X67X760", type="text", nullable=true)
     */
    private $392794x67x760;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X67X761", type="text", nullable=true)
     */
    private $392794x67x761;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X67X762", type="text", nullable=true)
     */
    private $392794x67x762;

    /**
     * @var float
     *
     * @ORM\Column(name="392794X61X746", type="decimal", nullable=true)
     */
    private $392794x61x746;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="392794X61X747", type="datetime", nullable=true)
     */
    private $392794x61x747;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X7481", type="string", length=5, nullable=true)
     */
    private $392794x61x7481;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X7481comment", type="text", nullable=true)
     */
    private $392794x61x7481comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X7482", type="string", length=5, nullable=true)
     */
    private $392794x61x7482;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X7482comment", type="text", nullable=true)
     */
    private $392794x61x7482comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X7483", type="string", length=5, nullable=true)
     */
    private $392794x61x7483;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X7483comment", type="text", nullable=true)
     */
    private $392794x61x7483comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X7484", type="string", length=5, nullable=true)
     */
    private $392794x61x7484;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X7484comment", type="text", nullable=true)
     */
    private $392794x61x7484comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X7485", type="string", length=5, nullable=true)
     */
    private $392794x61x7485;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X7485comment", type="text", nullable=true)
     */
    private $392794x61x7485comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X7486", type="string", length=5, nullable=true)
     */
    private $392794x61x7486;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X7486comment", type="text", nullable=true)
     */
    private $392794x61x7486comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X7487", type="string", length=5, nullable=true)
     */
    private $392794x61x7487;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X7487comment", type="text", nullable=true)
     */
    private $392794x61x7487comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X7488", type="string", length=5, nullable=true)
     */
    private $392794x61x7488;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X7488comment", type="text", nullable=true)
     */
    private $392794x61x7488comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X7489", type="string", length=5, nullable=true)
     */
    private $392794x61x7489;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X7489comment", type="text", nullable=true)
     */
    private $392794x61x7489comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X74810", type="string", length=5, nullable=true)
     */
    private $392794x61x74810;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X74810comment", type="text", nullable=true)
     */
    private $392794x61x74810comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X74811", type="string", length=5, nullable=true)
     */
    private $392794x61x74811;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X74811comment", type="text", nullable=true)
     */
    private $392794x61x74811comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X74812", type="string", length=5, nullable=true)
     */
    private $392794x61x74812;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X74812comment", type="text", nullable=true)
     */
    private $392794x61x74812comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X74813", type="string", length=5, nullable=true)
     */
    private $392794x61x74813;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X74813comment", type="text", nullable=true)
     */
    private $392794x61x74813comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X74814", type="string", length=5, nullable=true)
     */
    private $392794x61x74814;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X74814comment", type="text", nullable=true)
     */
    private $392794x61x74814comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X74815", type="string", length=5, nullable=true)
     */
    private $392794x61x74815;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X74815comment", type="text", nullable=true)
     */
    private $392794x61x74815comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X74816", type="string", length=5, nullable=true)
     */
    private $392794x61x74816;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X74816comment", type="text", nullable=true)
     */
    private $392794x61x74816comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X74817", type="string", length=5, nullable=true)
     */
    private $392794x61x74817;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X74817comment", type="text", nullable=true)
     */
    private $392794x61x74817comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X74818", type="string", length=5, nullable=true)
     */
    private $392794x61x74818;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X74818comment", type="text", nullable=true)
     */
    private $392794x61x74818comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X74819", type="string", length=5, nullable=true)
     */
    private $392794x61x74819;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X74819comment", type="text", nullable=true)
     */
    private $392794x61x74819comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X749", type="string", length=1, nullable=true)
     */
    private $392794x61x749;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X61X750", type="text", nullable=true)
     */
    private $392794x61x750;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X62X7541", type="string", length=5, nullable=true)
     */
    private $392794x62x7541;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X62X7541comment", type="text", nullable=true)
     */
    private $392794x62x7541comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X62X7542", type="string", length=5, nullable=true)
     */
    private $392794x62x7542;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X62X7542comment", type="text", nullable=true)
     */
    private $392794x62x7542comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X62X7543", type="string", length=5, nullable=true)
     */
    private $392794x62x7543;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X62X7543comment", type="text", nullable=true)
     */
    private $392794x62x7543comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X62X7544", type="string", length=5, nullable=true)
     */
    private $392794x62x7544;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X62X7544comment", type="text", nullable=true)
     */
    private $392794x62x7544comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X62X7545", type="string", length=5, nullable=true)
     */
    private $392794x62x7545;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X62X7545comment", type="text", nullable=true)
     */
    private $392794x62x7545comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X62X7546", type="string", length=5, nullable=true)
     */
    private $392794x62x7546;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X62X7546comment", type="text", nullable=true)
     */
    private $392794x62x7546comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X62X7547", type="string", length=5, nullable=true)
     */
    private $392794x62x7547;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X62X7547comment", type="text", nullable=true)
     */
    private $392794x62x7547comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X62X7548", type="string", length=5, nullable=true)
     */
    private $392794x62x7548;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X62X7548comment", type="text", nullable=true)
     */
    private $392794x62x7548comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X62X7549", type="string", length=5, nullable=true)
     */
    private $392794x62x7549;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X62X7549comment", type="text", nullable=true)
     */
    private $392794x62x7549comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X62X75410", type="string", length=5, nullable=true)
     */
    private $392794x62x75410;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X62X75410comment", type="text", nullable=true)
     */
    private $392794x62x75410comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X62X755", type="string", length=1, nullable=true)
     */
    private $392794x62x755;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X62X756", type="text", nullable=true)
     */
    private $392794x62x756;

    /**
     * @var float
     *
     * @ORM\Column(name="392794X63X763SQ001", type="float", nullable=true)
     */
    private $392794x63x763sq001;

    /**
     * @var float
     *
     * @ORM\Column(name="392794X63X763SQ002", type="float", nullable=true)
     */
    private $392794x63x763sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X63X764", type="string", length=5, nullable=true)
     */
    private $392794x63x764;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X63X765", type="string", length=5, nullable=true)
     */
    private $392794x63x765;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X68X766", type="text", nullable=true)
     */
    private $392794x68x766;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X68X767", type="text", nullable=true)
     */
    private $392794x68x767;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X68X768", type="text", nullable=true)
     */
    private $392794x68x768;

    /**
     * @var float
     *
     * @ORM\Column(name="392794X60X742", type="decimal", nullable=true)
     */
    private $392794x60x742;

    /**
     * @var float
     *
     * @ORM\Column(name="392794X60X743", type="decimal", nullable=true)
     */
    private $392794x60x743;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="392794X60X744", type="datetime", nullable=true)
     */
    private $392794x60x744;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X7451", type="string", length=5, nullable=true)
     */
    private $392794x60x7451;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X7451comment", type="text", nullable=true)
     */
    private $392794x60x7451comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X7452", type="string", length=5, nullable=true)
     */
    private $392794x60x7452;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X7452comment", type="text", nullable=true)
     */
    private $392794x60x7452comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X7453", type="string", length=5, nullable=true)
     */
    private $392794x60x7453;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X7453comment", type="text", nullable=true)
     */
    private $392794x60x7453comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X7454", type="string", length=5, nullable=true)
     */
    private $392794x60x7454;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X7454comment", type="text", nullable=true)
     */
    private $392794x60x7454comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X7455", type="string", length=5, nullable=true)
     */
    private $392794x60x7455;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X7455comment", type="text", nullable=true)
     */
    private $392794x60x7455comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X7456", type="string", length=5, nullable=true)
     */
    private $392794x60x7456;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X7456comment", type="text", nullable=true)
     */
    private $392794x60x7456comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X7457", type="string", length=5, nullable=true)
     */
    private $392794x60x7457;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X7457comment", type="text", nullable=true)
     */
    private $392794x60x7457comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X7458", type="string", length=5, nullable=true)
     */
    private $392794x60x7458;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X7458comment", type="text", nullable=true)
     */
    private $392794x60x7458comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X7459", type="string", length=5, nullable=true)
     */
    private $392794x60x7459;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X7459comment", type="text", nullable=true)
     */
    private $392794x60x7459comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74510", type="string", length=5, nullable=true)
     */
    private $392794x60x74510;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74510comment", type="text", nullable=true)
     */
    private $392794x60x74510comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74511", type="string", length=5, nullable=true)
     */
    private $392794x60x74511;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74511comment", type="text", nullable=true)
     */
    private $392794x60x74511comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74512", type="string", length=5, nullable=true)
     */
    private $392794x60x74512;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74512comment", type="text", nullable=true)
     */
    private $392794x60x74512comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74513", type="string", length=5, nullable=true)
     */
    private $392794x60x74513;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74513comment", type="text", nullable=true)
     */
    private $392794x60x74513comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74514", type="string", length=5, nullable=true)
     */
    private $392794x60x74514;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74514comment", type="text", nullable=true)
     */
    private $392794x60x74514comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74515", type="string", length=5, nullable=true)
     */
    private $392794x60x74515;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74515comment", type="text", nullable=true)
     */
    private $392794x60x74515comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74516", type="string", length=5, nullable=true)
     */
    private $392794x60x74516;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74516comment", type="text", nullable=true)
     */
    private $392794x60x74516comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74517", type="string", length=5, nullable=true)
     */
    private $392794x60x74517;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74517comment", type="text", nullable=true)
     */
    private $392794x60x74517comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74518", type="string", length=5, nullable=true)
     */
    private $392794x60x74518;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74518comment", type="text", nullable=true)
     */
    private $392794x60x74518comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74519", type="string", length=5, nullable=true)
     */
    private $392794x60x74519;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74519comment", type="text", nullable=true)
     */
    private $392794x60x74519comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74520", type="string", length=5, nullable=true)
     */
    private $392794x60x74520;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74520comment", type="text", nullable=true)
     */
    private $392794x60x74520comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74521", type="string", length=5, nullable=true)
     */
    private $392794x60x74521;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74521comment", type="text", nullable=true)
     */
    private $392794x60x74521comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74522", type="string", length=5, nullable=true)
     */
    private $392794x60x74522;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74522comment", type="text", nullable=true)
     */
    private $392794x60x74522comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74523", type="string", length=5, nullable=true)
     */
    private $392794x60x74523;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74523comment", type="text", nullable=true)
     */
    private $392794x60x74523comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74524", type="string", length=5, nullable=true)
     */
    private $392794x60x74524;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74524comment", type="text", nullable=true)
     */
    private $392794x60x74524comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74525", type="string", length=5, nullable=true)
     */
    private $392794x60x74525;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74525comment", type="text", nullable=true)
     */
    private $392794x60x74525comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74526", type="string", length=5, nullable=true)
     */
    private $392794x60x74526;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74526comment", type="text", nullable=true)
     */
    private $392794x60x74526comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74527", type="string", length=5, nullable=true)
     */
    private $392794x60x74527;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74527comment", type="text", nullable=true)
     */
    private $392794x60x74527comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74528", type="string", length=5, nullable=true)
     */
    private $392794x60x74528;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74528comment", type="text", nullable=true)
     */
    private $392794x60x74528comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74529", type="string", length=5, nullable=true)
     */
    private $392794x60x74529;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74529comment", type="text", nullable=true)
     */
    private $392794x60x74529comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74530", type="string", length=5, nullable=true)
     */
    private $392794x60x74530;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74530comment", type="text", nullable=true)
     */
    private $392794x60x74530comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74531", type="string", length=5, nullable=true)
     */
    private $392794x60x74531;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X60X74531comment", type="text", nullable=true)
     */
    private $392794x60x74531comment;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X64X769", type="string", length=1, nullable=true)
     */
    private $392794x64x769;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X64X770", type="string", length=5, nullable=true)
     */
    private $392794x64x770;

    /**
     * @var string
     *
     * @ORM\Column(name="392794X64X771", type="string", length=5, nullable=true)
     */
    private $392794x64x771;


}
