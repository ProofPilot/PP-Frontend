<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeOldSurvey76395420130415132453
 *
 * @ORM\Table(name="lime_old_survey_763954_20130415132453")
 * @ORM\Entity
 */
class LimeOldSurvey76395420130415132453
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
     * @ORM\Column(name="763954X49X562", type="string", length=5, nullable=true)
     */
    private $763954x49x562;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X562other", type="text", nullable=true)
     */
    private $763954x49x562other;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X555", type="string", length=5, nullable=true)
     */
    private $763954x49x555;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X555other", type="text", nullable=true)
     */
    private $763954x49x555other;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X588", type="string", length=5, nullable=true)
     */
    private $763954x49x588;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X589", type="string", length=5, nullable=true)
     */
    private $763954x49x589;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="763954X49X545", type="datetime", nullable=true)
     */
    private $763954x49x545;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X570SQ001", type="string", length=5, nullable=true)
     */
    private $763954x49x570sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X570SQ002", type="string", length=5, nullable=true)
     */
    private $763954x49x570sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X570SQ003", type="string", length=5, nullable=true)
     */
    private $763954x49x570sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X570SQ004", type="string", length=5, nullable=true)
     */
    private $763954x49x570sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X574SQ001", type="string", length=5, nullable=true)
     */
    private $763954x49x574sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X574SQ004", type="string", length=5, nullable=true)
     */
    private $763954x49x574sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X574SQ002", type="string", length=5, nullable=true)
     */
    private $763954x49x574sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X574SQ003", type="string", length=5, nullable=true)
     */
    private $763954x49x574sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X579SQ001", type="string", length=5, nullable=true)
     */
    private $763954x49x579sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X579SQ002", type="string", length=5, nullable=true)
     */
    private $763954x49x579sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X579SQ003", type="string", length=5, nullable=true)
     */
    private $763954x49x579sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X579SQ004", type="string", length=5, nullable=true)
     */
    private $763954x49x579sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X579SQ005", type="string", length=5, nullable=true)
     */
    private $763954x49x579sq005;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X579SQ006", type="string", length=5, nullable=true)
     */
    private $763954x49x579sq006;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X579SQ007", type="string", length=5, nullable=true)
     */
    private $763954x49x579sq007;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X587", type="string", length=5, nullable=true)
     */
    private $763954x49x587;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X5944_1", type="text", nullable=true)
     */
    private $763954x49x59441;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X5944_2", type="text", nullable=true)
     */
    private $763954x49x59442;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X5944_3", type="text", nullable=true)
     */
    private $763954x49x59443;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X5945_1", type="text", nullable=true)
     */
    private $763954x49x59451;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X5945_2", type="text", nullable=true)
     */
    private $763954x49x59452;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X5945_3", type="text", nullable=true)
     */
    private $763954x49x59453;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X5942_1", type="text", nullable=true)
     */
    private $763954x49x59421;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X5942_2", type="text", nullable=true)
     */
    private $763954x49x59422;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X5942_3", type="text", nullable=true)
     */
    private $763954x49x59423;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X5943_1", type="text", nullable=true)
     */
    private $763954x49x59431;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X5943_2", type="text", nullable=true)
     */
    private $763954x49x59432;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X5943_3", type="text", nullable=true)
     */
    private $763954x49x59433;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X5946_1", type="text", nullable=true)
     */
    private $763954x49x59461;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X5946_2", type="text", nullable=true)
     */
    private $763954x49x59462;

    /**
     * @var string
     *
     * @ORM\Column(name="763954X49X5946_3", type="text", nullable=true)
     */
    private $763954x49x59463;


}
