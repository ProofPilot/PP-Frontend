<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeSurveys
 *
 * @ORM\Table(name="lime_surveys")
 * @ORM\Entity
 */
class LimeSurveys
{
    /**
     * @var integer
     *
     * @ORM\Column(name="sid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $sid;

    /**
     * @var integer
     *
     * @ORM\Column(name="owner_id", type="integer", nullable=false)
     */
    private $ownerId;

    /**
     * @var string
     *
     * @ORM\Column(name="admin", type="string", length=50, nullable=true)
     */
    private $admin;

    /**
     * @var string
     *
     * @ORM\Column(name="active", type="string", length=1, nullable=false)
     */
    private $active;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expires", type="datetime", nullable=true)
     */
    private $expires;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startdate", type="datetime", nullable=true)
     */
    private $startdate;

    /**
     * @var string
     *
     * @ORM\Column(name="adminemail", type="string", length=320, nullable=true)
     */
    private $adminemail;

    /**
     * @var string
     *
     * @ORM\Column(name="anonymized", type="string", length=1, nullable=false)
     */
    private $anonymized;

    /**
     * @var string
     *
     * @ORM\Column(name="faxto", type="string", length=20, nullable=true)
     */
    private $faxto;

    /**
     * @var string
     *
     * @ORM\Column(name="format", type="string", length=1, nullable=true)
     */
    private $format;

    /**
     * @var string
     *
     * @ORM\Column(name="savetimings", type="string", length=1, nullable=false)
     */
    private $savetimings;

    /**
     * @var string
     *
     * @ORM\Column(name="template", type="string", length=100, nullable=true)
     */
    private $template;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=50, nullable=true)
     */
    private $language;

    /**
     * @var string
     *
     * @ORM\Column(name="additional_languages", type="string", length=255, nullable=true)
     */
    private $additionalLanguages;

    /**
     * @var string
     *
     * @ORM\Column(name="datestamp", type="string", length=1, nullable=false)
     */
    private $datestamp;

    /**
     * @var string
     *
     * @ORM\Column(name="usecookie", type="string", length=1, nullable=false)
     */
    private $usecookie;

    /**
     * @var string
     *
     * @ORM\Column(name="allowregister", type="string", length=1, nullable=false)
     */
    private $allowregister;

    /**
     * @var string
     *
     * @ORM\Column(name="allowsave", type="string", length=1, nullable=false)
     */
    private $allowsave;

    /**
     * @var integer
     *
     * @ORM\Column(name="autonumber_start", type="integer", nullable=false)
     */
    private $autonumberStart;

    /**
     * @var string
     *
     * @ORM\Column(name="autoredirect", type="string", length=1, nullable=false)
     */
    private $autoredirect;

    /**
     * @var string
     *
     * @ORM\Column(name="allowprev", type="string", length=1, nullable=false)
     */
    private $allowprev;

    /**
     * @var string
     *
     * @ORM\Column(name="printanswers", type="string", length=1, nullable=false)
     */
    private $printanswers;

    /**
     * @var string
     *
     * @ORM\Column(name="ipaddr", type="string", length=1, nullable=false)
     */
    private $ipaddr;

    /**
     * @var string
     *
     * @ORM\Column(name="refurl", type="string", length=1, nullable=false)
     */
    private $refurl;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecreated", type="date", nullable=true)
     */
    private $datecreated;

    /**
     * @var string
     *
     * @ORM\Column(name="publicstatistics", type="string", length=1, nullable=false)
     */
    private $publicstatistics;

    /**
     * @var string
     *
     * @ORM\Column(name="publicgraphs", type="string", length=1, nullable=false)
     */
    private $publicgraphs;

    /**
     * @var string
     *
     * @ORM\Column(name="listpublic", type="string", length=1, nullable=false)
     */
    private $listpublic;

    /**
     * @var string
     *
     * @ORM\Column(name="htmlemail", type="string", length=1, nullable=false)
     */
    private $htmlemail;

    /**
     * @var string
     *
     * @ORM\Column(name="tokenanswerspersistence", type="string", length=1, nullable=false)
     */
    private $tokenanswerspersistence;

    /**
     * @var string
     *
     * @ORM\Column(name="assessments", type="string", length=1, nullable=false)
     */
    private $assessments;

    /**
     * @var string
     *
     * @ORM\Column(name="usecaptcha", type="string", length=1, nullable=false)
     */
    private $usecaptcha;

    /**
     * @var string
     *
     * @ORM\Column(name="usetokens", type="string", length=1, nullable=false)
     */
    private $usetokens;

    /**
     * @var string
     *
     * @ORM\Column(name="bounce_email", type="string", length=320, nullable=true)
     */
    private $bounceEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="attributedescriptions", type="text", nullable=true)
     */
    private $attributedescriptions;

    /**
     * @var string
     *
     * @ORM\Column(name="emailresponseto", type="text", nullable=true)
     */
    private $emailresponseto;

    /**
     * @var string
     *
     * @ORM\Column(name="emailnotificationto", type="text", nullable=true)
     */
    private $emailnotificationto;

    /**
     * @var integer
     *
     * @ORM\Column(name="tokenlength", type="integer", nullable=false)
     */
    private $tokenlength;

    /**
     * @var string
     *
     * @ORM\Column(name="showxquestions", type="string", length=1, nullable=true)
     */
    private $showxquestions;

    /**
     * @var string
     *
     * @ORM\Column(name="showgroupinfo", type="string", length=1, nullable=true)
     */
    private $showgroupinfo;

    /**
     * @var string
     *
     * @ORM\Column(name="shownoanswer", type="string", length=1, nullable=true)
     */
    private $shownoanswer;

    /**
     * @var string
     *
     * @ORM\Column(name="showqnumcode", type="string", length=1, nullable=true)
     */
    private $showqnumcode;

    /**
     * @var integer
     *
     * @ORM\Column(name="bouncetime", type="integer", nullable=true)
     */
    private $bouncetime;

    /**
     * @var string
     *
     * @ORM\Column(name="bounceprocessing", type="string", length=1, nullable=true)
     */
    private $bounceprocessing;

    /**
     * @var string
     *
     * @ORM\Column(name="bounceaccounttype", type="string", length=4, nullable=true)
     */
    private $bounceaccounttype;

    /**
     * @var string
     *
     * @ORM\Column(name="bounceaccounthost", type="string", length=200, nullable=true)
     */
    private $bounceaccounthost;

    /**
     * @var string
     *
     * @ORM\Column(name="bounceaccountpass", type="string", length=100, nullable=true)
     */
    private $bounceaccountpass;

    /**
     * @var string
     *
     * @ORM\Column(name="bounceaccountencryption", type="string", length=3, nullable=true)
     */
    private $bounceaccountencryption;

    /**
     * @var string
     *
     * @ORM\Column(name="bounceaccountuser", type="string", length=200, nullable=true)
     */
    private $bounceaccountuser;

    /**
     * @var string
     *
     * @ORM\Column(name="showwelcome", type="string", length=1, nullable=true)
     */
    private $showwelcome;

    /**
     * @var string
     *
     * @ORM\Column(name="showprogress", type="string", length=1, nullable=true)
     */
    private $showprogress;

    /**
     * @var string
     *
     * @ORM\Column(name="allowjumps", type="string", length=1, nullable=true)
     */
    private $allowjumps;

    /**
     * @var integer
     *
     * @ORM\Column(name="navigationdelay", type="integer", nullable=false)
     */
    private $navigationdelay;

    /**
     * @var string
     *
     * @ORM\Column(name="nokeyboard", type="string", length=1, nullable=true)
     */
    private $nokeyboard;

    /**
     * @var string
     *
     * @ORM\Column(name="alloweditaftercompletion", type="string", length=1, nullable=true)
     */
    private $alloweditaftercompletion;

    /**
     * @var string
     *
     * @ORM\Column(name="googleanalyticsstyle", type="string", length=1, nullable=true)
     */
    private $googleanalyticsstyle;

    /**
     * @var string
     *
     * @ORM\Column(name="googleanalyticsapikey", type="string", length=25, nullable=true)
     */
    private $googleanalyticsapikey;

    /**
     * @var string
     *
     * @ORM\Column(name="sendconfirmation", type="string", length=1, nullable=false)
     */
    private $sendconfirmation;


}
