<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeSurveys
 *
 * @ORM\Table(name ="lime_surveys")
 * @ORM\Entity
 */
class LimeSurveys
{
    /**
     * @var integer
     *
     * @ORM\Column(name="sid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $sid;

    /**
     * @var integer
     *
     * @ORM\Column(name="owner_id", type="integer")
     */
    private $ownerId;

    /**
     * @var string
     *
     * @ORM\Column(name="admin", type="string", length=50)
     */
    private $admin;

    /**
     * @var string
     *
     * @ORM\Column(name="active", type="string", length=1)
     */
    private $active;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expires", type="datetime")
     */
    private $expires;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startdate", type="datetime")
     */
    private $startdate;

    /**
     * @var string
     *
     * @ORM\Column(name="adminemail", type="string", length=320)
     */
    private $adminemail;

    /**
     * @var string
     *
     * @ORM\Column(name="anonymized", type="string", length=1)
     */
    private $anonymized;

    /**
     * @var string
     *
     * @ORM\Column(name="faxto", type="string", length=20)
     */
    private $faxto;

    /**
     * @var string
     *
     * @ORM\Column(name="format", type="string", length=1)
     */
    private $format;

    /**
     * @var string
     *
     * @ORM\Column(name="savetimings", type="string", length=1)
     */
    private $savetimings;

    /**
     * @var string
     *
     * @ORM\Column(name="template", type="string", length=100)
     */
    private $template;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=50)
     */
    private $language;

    /**
     * @var string
     *
     * @ORM\Column(name="additional_languages", type="string", length=1)
     */
    private $additionalLanguages;

    /**
     * @var string
     *
     * @ORM\Column(name="datestamp", type="string", length=1)
     */
    private $datestamp;

    /**
     * @var string
     *
     * @ORM\Column(name="usecookie", type="string", length=1)
     */
    private $usecookie;

    /**
     * @var string
     *
     * @ORM\Column(name="allowregister", type="string", length=1)
     */
    private $allowregister;

    /**
     * @var string
     *
     * @ORM\Column(name="allowsave", type="string", length=1)
     */
    private $allowsave;

    /**
     * @var integer
     *
     * @ORM\Column(name="autonumber_start", type="integer")
     */
    private $autonumberStart;

    /**
     * @var string
     *
     * @ORM\Column(name="autoredirect", type="string", length=1)
     */
    private $autoredirect;

    /**
     * @var string
     *
     * @ORM\Column(name="allowprev", type="string", length=1)
     */
    private $allowprev;

    /**
     * @var string
     *
     * @ORM\Column(name="printanswers", type="string", length=1)
     */
    private $printanswers;

    /**
     * @var string
     *
     * @ORM\Column(name="ipaddr", type="string", length=1)
     */
    private $ipaddr;

    /**
     * @var string
     *
     * @ORM\Column(name="refurl", type="string", length=1)
     */
    private $refurl;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecreated", type="date")
     */
    private $datecreated;

    /**
     * @var string
     *
     * @ORM\Column(name="publicstatistics", type="string", length=1)
     */
    private $publicstatistics;

    /**
     * @var string
     *
     * @ORM\Column(name="publicgraphs", type="string", length=1)
     */
    private $publicgraphs;

    /**
     * @var string
     *
     * @ORM\Column(name="listpublic", type="string", length=1)
     */
    private $listpublic;

    /**
     * @var string
     *
     * @ORM\Column(name="htmlemail", type="string", length=1)
     */
    private $htmlemail;

    /**
     * @var string
     *
     * @ORM\Column(name="tokenanswerspersistence", type="string", length=1)
     */
    private $tokenanswerspersistence;

    /**
     * @var string
     *
     * @ORM\Column(name="assessments", type="string", length=1)
     */
    private $assessments;

    /**
     * @var string
     *
     * @ORM\Column(name="usecaptcha", type="string", length=1)
     */
    private $usecaptcha;

    /**
     * @var string
     *
     * @ORM\Column(name="usetokens", type="string", length=1)
     */
    private $usetokens;

    /**
     * @var string
     *
     * @ORM\Column(name="bounce_email", type="string", length=320)
     */
    private $bounceEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="attributedescriptions", type="string", length=0)
     */
    private $attributedescriptions;

    /**
     * @var string
     *
     * @ORM\Column(name="emailresponseto", type="string", length=0)
     */
    private $emailresponseto;

    /**
     * @var string
     *
     * @ORM\Column(name="emailnotificationto", type="string", length=0)
     */
    private $emailnotificationto;

    /**
     * @var integer
     *
     * @ORM\Column(name="tokenlength", type="integer")
     */
    private $tokenlength;

    /**
     * @var string
     *
     * @ORM\Column(name="showxquestions", type="string", length=1)
     */
    private $showxquestions;

    /**
     * @var string
     *
     * @ORM\Column(name="showgroupinfo", type="string", length=1)
     */
    private $showgroupinfo;

    /**
     * @var string
     *
     * @ORM\Column(name="shownoanswer", type="string", length=1)
     */
    private $shownoanswer;

    /**
     * @var string
     *
     * @ORM\Column(name="showqnumcode", type="string", length=1)
     */
    private $showqnumcode;

    /**
     * @var integer
     *
     * @ORM\Column(name="bouncetime", type="integer")
     */
    private $bouncetime;

    /**
     * @var string
     *
     * @ORM\Column(name="bounceprocessing", type="string", length=1)
     */
    private $bounceprocessing;

    /**
     * @var string
     *
     * @ORM\Column(name="bounceaccounttype", type="string", length=4)
     */
    private $bounceaccounttype;

    /**
     * @var string
     *
     * @ORM\Column(name="bounceaccounthost", type="string", length=200)
     */
    private $bounceaccounthost;

    /**
     * @var string
     *
     * @ORM\Column(name="bounceaccountpass", type="string", length=100)
     */
    private $bounceaccountpass;

    /**
     * @var string
     *
     * @ORM\Column(name="bounceaccountencryption", type="string", length=3)
     */
    private $bounceaccountencryption;

    /**
     * @var string
     *
     * @ORM\Column(name="bounceaccountuser", type="string", length=200)
     */
    private $bounceaccountuser;

    /**
     * @var string
     *
     * @ORM\Column(name="showwelcome", type="string", length=1)
     */
    private $showwelcome;

    /**
     * @var string
     *
     * @ORM\Column(name="showprogress", type="string", length=1)
     */
    private $showprogress;

    /**
     * @var string
     *
     * @ORM\Column(name="allowjumps", type="string", length=1)
     */
    private $allowjumps;

    /**
     * @var integer
     *
     * @ORM\Column(name="navigationdelay", type="integer")
     */
    private $navigationdelay;

    /**
     * @var string
     *
     * @ORM\Column(name="nokeyboard", type="string", length=1)
     */
    private $nokeyboard;

    /**
     * @var string
     *
     * @ORM\Column(name="alloweditaftercompletion", type="string", length=1)
     */
    private $alloweditaftercompletion;

    /**
     * @var string
     *
     * @ORM\Column(name="googleanalyticsstyle", type="string", length=1)
     */
    private $googleanalyticsstyle;

    /**
     * @var string
     *
     * @ORM\Column(name="googleanalyticsapikey", type="string", length=25)
     */
    private $googleanalyticsapikey;

    /**
     * @var string
     *
     * @ORM\Column(name="sendconfirmation", type="string", length=1)
     */
    private $sendconfirmation;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set sid
     *
     * @param integer $sid
     * @return LimeSurveys
     */
    public function setSid($sid)
    {
        $this->sid = $sid;
    
        return $this;
    }

    /**
     * Get sid
     *
     * @return integer 
     */
    public function getSid()
    {
        return $this->sid;
    }

    /**
     * Set ownerId
     *
     * @param integer $ownerId
     * @return LimeSurveys
     */
    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;
    
        return $this;
    }

    /**
     * Get ownerId
     *
     * @return integer 
     */
    public function getOwnerId()
    {
        return $this->ownerId;
    }

    /**
     * Set admin
     *
     * @param string $admin
     * @return LimeSurveys
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    
        return $this;
    }

    /**
     * Get admin
     *
     * @return string 
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set active
     *
     * @param string $active
     * @return LimeSurveys
     */
    public function setActive($active)
    {
        $this->active = $active;
    
        return $this;
    }

    /**
     * Get active
     *
     * @return string 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set expires
     *
     * @param \DateTime $expires
     * @return LimeSurveys
     */
    public function setExpires($expires)
    {
        $this->expires = $expires;
    
        return $this;
    }

    /**
     * Get expires
     *
     * @return \DateTime 
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * Set startdate
     *
     * @param \DateTime $startdate
     * @return LimeSurveys
     */
    public function setStartdate($startdate)
    {
        $this->startdate = $startdate;
    
        return $this;
    }

    /**
     * Get startdate
     *
     * @return \DateTime 
     */
    public function getStartdate()
    {
        return $this->startdate;
    }

    /**
     * Set adminemail
     *
     * @param string $adminemail
     * @return LimeSurveys
     */
    public function setAdminemail($adminemail)
    {
        $this->adminemail = $adminemail;
    
        return $this;
    }

    /**
     * Get adminemail
     *
     * @return string 
     */
    public function getAdminemail()
    {
        return $this->adminemail;
    }

    /**
     * Set anonymized
     *
     * @param string $anonymized
     * @return LimeSurveys
     */
    public function setAnonymized($anonymized)
    {
        $this->anonymized = $anonymized;
    
        return $this;
    }

    /**
     * Get anonymized
     *
     * @return string 
     */
    public function getAnonymized()
    {
        return $this->anonymized;
    }

    /**
     * Set faxto
     *
     * @param string $faxto
     * @return LimeSurveys
     */
    public function setFaxto($faxto)
    {
        $this->faxto = $faxto;
    
        return $this;
    }

    /**
     * Get faxto
     *
     * @return string 
     */
    public function getFaxto()
    {
        return $this->faxto;
    }

    /**
     * Set format
     *
     * @param string $format
     * @return LimeSurveys
     */
    public function setFormat($format)
    {
        $this->format = $format;
    
        return $this;
    }

    /**
     * Get format
     *
     * @return string 
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set savetimings
     *
     * @param string $savetimings
     * @return LimeSurveys
     */
    public function setSavetimings($savetimings)
    {
        $this->savetimings = $savetimings;
    
        return $this;
    }

    /**
     * Get savetimings
     *
     * @return string 
     */
    public function getSavetimings()
    {
        return $this->savetimings;
    }

    /**
     * Set template
     *
     * @param string $template
     * @return LimeSurveys
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    
        return $this;
    }

    /**
     * Get template
     *
     * @return string 
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return LimeSurveys
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    
        return $this;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set additionalLanguages
     *
     * @param string $additionalLanguages
     * @return LimeSurveys
     */
    public function setAdditionalLanguages($additionalLanguages)
    {
        $this->additionalLanguages = $additionalLanguages;
    
        return $this;
    }

    /**
     * Get additionalLanguages
     *
     * @return string 
     */
    public function getAdditionalLanguages()
    {
        return $this->additionalLanguages;
    }

    /**
     * Set datestamp
     *
     * @param string $datestamp
     * @return LimeSurveys
     */
    public function setDatestamp($datestamp)
    {
        $this->datestamp = $datestamp;
    
        return $this;
    }

    /**
     * Get datestamp
     *
     * @return string 
     */
    public function getDatestamp()
    {
        return $this->datestamp;
    }

    /**
     * Set usecookie
     *
     * @param string $usecookie
     * @return LimeSurveys
     */
    public function setUsecookie($usecookie)
    {
        $this->usecookie = $usecookie;
    
        return $this;
    }

    /**
     * Get usecookie
     *
     * @return string 
     */
    public function getUsecookie()
    {
        return $this->usecookie;
    }

    /**
     * Set allowregister
     *
     * @param string $allowregister
     * @return LimeSurveys
     */
    public function setAllowregister($allowregister)
    {
        $this->allowregister = $allowregister;
    
        return $this;
    }

    /**
     * Get allowregister
     *
     * @return string 
     */
    public function getAllowregister()
    {
        return $this->allowregister;
    }

    /**
     * Set allowsave
     *
     * @param string $allowsave
     * @return LimeSurveys
     */
    public function setAllowsave($allowsave)
    {
        $this->allowsave = $allowsave;
    
        return $this;
    }

    /**
     * Get allowsave
     *
     * @return string 
     */
    public function getAllowsave()
    {
        return $this->allowsave;
    }

    /**
     * Set autonumberStart
     *
     * @param integer $autonumberStart
     * @return LimeSurveys
     */
    public function setAutonumberStart($autonumberStart)
    {
        $this->autonumberStart = $autonumberStart;
    
        return $this;
    }

    /**
     * Get autonumberStart
     *
     * @return integer 
     */
    public function getAutonumberStart()
    {
        return $this->autonumberStart;
    }

    /**
     * Set autoredirect
     *
     * @param string $autoredirect
     * @return LimeSurveys
     */
    public function setAutoredirect($autoredirect)
    {
        $this->autoredirect = $autoredirect;
    
        return $this;
    }

    /**
     * Get autoredirect
     *
     * @return string 
     */
    public function getAutoredirect()
    {
        return $this->autoredirect;
    }

    /**
     * Set allowprev
     *
     * @param string $allowprev
     * @return LimeSurveys
     */
    public function setAllowprev($allowprev)
    {
        $this->allowprev = $allowprev;
    
        return $this;
    }

    /**
     * Get allowprev
     *
     * @return string 
     */
    public function getAllowprev()
    {
        return $this->allowprev;
    }

    /**
     * Set printanswers
     *
     * @param string $printanswers
     * @return LimeSurveys
     */
    public function setPrintanswers($printanswers)
    {
        $this->printanswers = $printanswers;
    
        return $this;
    }

    /**
     * Get printanswers
     *
     * @return string 
     */
    public function getPrintanswers()
    {
        return $this->printanswers;
    }

    /**
     * Set ipaddr
     *
     * @param string $ipaddr
     * @return LimeSurveys
     */
    public function setIpaddr($ipaddr)
    {
        $this->ipaddr = $ipaddr;
    
        return $this;
    }

    /**
     * Get ipaddr
     *
     * @return string 
     */
    public function getIpaddr()
    {
        return $this->ipaddr;
    }

    /**
     * Set refurl
     *
     * @param string $refurl
     * @return LimeSurveys
     */
    public function setRefurl($refurl)
    {
        $this->refurl = $refurl;
    
        return $this;
    }

    /**
     * Get refurl
     *
     * @return string 
     */
    public function getRefurl()
    {
        return $this->refurl;
    }

    /**
     * Set datecreated
     *
     * @param \DateTime $datecreated
     * @return LimeSurveys
     */
    public function setDatecreated($datecreated)
    {
        $this->datecreated = $datecreated;
    
        return $this;
    }

    /**
     * Get datecreated
     *
     * @return \DateTime 
     */
    public function getDatecreated()
    {
        return $this->datecreated;
    }

    /**
     * Set publicstatistics
     *
     * @param string $publicstatistics
     * @return LimeSurveys
     */
    public function setPublicstatistics($publicstatistics)
    {
        $this->publicstatistics = $publicstatistics;
    
        return $this;
    }

    /**
     * Get publicstatistics
     *
     * @return string 
     */
    public function getPublicstatistics()
    {
        return $this->publicstatistics;
    }

    /**
     * Set publicgraphs
     *
     * @param string $publicgraphs
     * @return LimeSurveys
     */
    public function setPublicgraphs($publicgraphs)
    {
        $this->publicgraphs = $publicgraphs;
    
        return $this;
    }

    /**
     * Get publicgraphs
     *
     * @return string 
     */
    public function getPublicgraphs()
    {
        return $this->publicgraphs;
    }

    /**
     * Set listpublic
     *
     * @param string $listpublic
     * @return LimeSurveys
     */
    public function setListpublic($listpublic)
    {
        $this->listpublic = $listpublic;
    
        return $this;
    }

    /**
     * Get listpublic
     *
     * @return string 
     */
    public function getListpublic()
    {
        return $this->listpublic;
    }

    /**
     * Set htmlemail
     *
     * @param string $htmlemail
     * @return LimeSurveys
     */
    public function setHtmlemail($htmlemail)
    {
        $this->htmlemail = $htmlemail;
    
        return $this;
    }

    /**
     * Get htmlemail
     *
     * @return string 
     */
    public function getHtmlemail()
    {
        return $this->htmlemail;
    }

    /**
     * Set tokenanswerspersistence
     *
     * @param string $tokenanswerspersistence
     * @return LimeSurveys
     */
    public function setTokenanswerspersistence($tokenanswerspersistence)
    {
        $this->tokenanswerspersistence = $tokenanswerspersistence;
    
        return $this;
    }

    /**
     * Get tokenanswerspersistence
     *
     * @return string 
     */
    public function getTokenanswerspersistence()
    {
        return $this->tokenanswerspersistence;
    }

    /**
     * Set assessments
     *
     * @param string $assessments
     * @return LimeSurveys
     */
    public function setAssessments($assessments)
    {
        $this->assessments = $assessments;
    
        return $this;
    }

    /**
     * Get assessments
     *
     * @return string 
     */
    public function getAssessments()
    {
        return $this->assessments;
    }

    /**
     * Set usecaptcha
     *
     * @param string $usecaptcha
     * @return LimeSurveys
     */
    public function setUsecaptcha($usecaptcha)
    {
        $this->usecaptcha = $usecaptcha;
    
        return $this;
    }

    /**
     * Get usecaptcha
     *
     * @return string 
     */
    public function getUsecaptcha()
    {
        return $this->usecaptcha;
    }

    /**
     * Set usetokens
     *
     * @param string $usetokens
     * @return LimeSurveys
     */
    public function setUsetokens($usetokens)
    {
        $this->usetokens = $usetokens;
    
        return $this;
    }

    /**
     * Get usetokens
     *
     * @return string 
     */
    public function getUsetokens()
    {
        return $this->usetokens;
    }

    /**
     * Set bounceEmail
     *
     * @param string $bounceEmail
     * @return LimeSurveys
     */
    public function setBounceEmail($bounceEmail)
    {
        $this->bounceEmail = $bounceEmail;
    
        return $this;
    }

    /**
     * Get bounceEmail
     *
     * @return string 
     */
    public function getBounceEmail()
    {
        return $this->bounceEmail;
    }

    /**
     * Set attributedescriptions
     *
     * @param string $attributedescriptions
     * @return LimeSurveys
     */
    public function setAttributedescriptions($attributedescriptions)
    {
        $this->attributedescriptions = $attributedescriptions;
    
        return $this;
    }

    /**
     * Get attributedescriptions
     *
     * @return string 
     */
    public function getAttributedescriptions()
    {
        return $this->attributedescriptions;
    }

    /**
     * Set emailresponseto
     *
     * @param string $emailresponseto
     * @return LimeSurveys
     */
    public function setEmailresponseto($emailresponseto)
    {
        $this->emailresponseto = $emailresponseto;
    
        return $this;
    }

    /**
     * Get emailresponseto
     *
     * @return string 
     */
    public function getEmailresponseto()
    {
        return $this->emailresponseto;
    }

    /**
     * Set emailnotificationto
     *
     * @param string $emailnotificationto
     * @return LimeSurveys
     */
    public function setEmailnotificationto($emailnotificationto)
    {
        $this->emailnotificationto = $emailnotificationto;
    
        return $this;
    }

    /**
     * Get emailnotificationto
     *
     * @return string 
     */
    public function getEmailnotificationto()
    {
        return $this->emailnotificationto;
    }

    /**
     * Set tokenlength
     *
     * @param integer $tokenlength
     * @return LimeSurveys
     */
    public function setTokenlength($tokenlength)
    {
        $this->tokenlength = $tokenlength;
    
        return $this;
    }

    /**
     * Get tokenlength
     *
     * @return integer 
     */
    public function getTokenlength()
    {
        return $this->tokenlength;
    }

    /**
     * Set showxquestions
     *
     * @param string $showxquestions
     * @return LimeSurveys
     */
    public function setShowxquestions($showxquestions)
    {
        $this->showxquestions = $showxquestions;
    
        return $this;
    }

    /**
     * Get showxquestions
     *
     * @return string 
     */
    public function getShowxquestions()
    {
        return $this->showxquestions;
    }

    /**
     * Set showgroupinfo
     *
     * @param string $showgroupinfo
     * @return LimeSurveys
     */
    public function setShowgroupinfo($showgroupinfo)
    {
        $this->showgroupinfo = $showgroupinfo;
    
        return $this;
    }

    /**
     * Get showgroupinfo
     *
     * @return string 
     */
    public function getShowgroupinfo()
    {
        return $this->showgroupinfo;
    }

    /**
     * Set shownoanswer
     *
     * @param string $shownoanswer
     * @return LimeSurveys
     */
    public function setShownoanswer($shownoanswer)
    {
        $this->shownoanswer = $shownoanswer;
    
        return $this;
    }

    /**
     * Get shownoanswer
     *
     * @return string 
     */
    public function getShownoanswer()
    {
        return $this->shownoanswer;
    }

    /**
     * Set showqnumcode
     *
     * @param string $showqnumcode
     * @return LimeSurveys
     */
    public function setShowqnumcode($showqnumcode)
    {
        $this->showqnumcode = $showqnumcode;
    
        return $this;
    }

    /**
     * Get showqnumcode
     *
     * @return string 
     */
    public function getShowqnumcode()
    {
        return $this->showqnumcode;
    }

    /**
     * Set bouncetime
     *
     * @param integer $bouncetime
     * @return LimeSurveys
     */
    public function setBouncetime($bouncetime)
    {
        $this->bouncetime = $bouncetime;
    
        return $this;
    }

    /**
     * Get bouncetime
     *
     * @return integer 
     */
    public function getBouncetime()
    {
        return $this->bouncetime;
    }

    /**
     * Set bounceprocessing
     *
     * @param string $bounceprocessing
     * @return LimeSurveys
     */
    public function setBounceprocessing($bounceprocessing)
    {
        $this->bounceprocessing = $bounceprocessing;
    
        return $this;
    }

    /**
     * Get bounceprocessing
     *
     * @return string 
     */
    public function getBounceprocessing()
    {
        return $this->bounceprocessing;
    }

    /**
     * Set bounceaccounttype
     *
     * @param string $bounceaccounttype
     * @return LimeSurveys
     */
    public function setBounceaccounttype($bounceaccounttype)
    {
        $this->bounceaccounttype = $bounceaccounttype;
    
        return $this;
    }

    /**
     * Get bounceaccounttype
     *
     * @return string 
     */
    public function getBounceaccounttype()
    {
        return $this->bounceaccounttype;
    }

    /**
     * Set bounceaccounthost
     *
     * @param string $bounceaccounthost
     * @return LimeSurveys
     */
    public function setBounceaccounthost($bounceaccounthost)
    {
        $this->bounceaccounthost = $bounceaccounthost;
    
        return $this;
    }

    /**
     * Get bounceaccounthost
     *
     * @return string 
     */
    public function getBounceaccounthost()
    {
        return $this->bounceaccounthost;
    }

    /**
     * Set bounceaccountpass
     *
     * @param string $bounceaccountpass
     * @return LimeSurveys
     */
    public function setBounceaccountpass($bounceaccountpass)
    {
        $this->bounceaccountpass = $bounceaccountpass;
    
        return $this;
    }

    /**
     * Get bounceaccountpass
     *
     * @return string 
     */
    public function getBounceaccountpass()
    {
        return $this->bounceaccountpass;
    }

    /**
     * Set bounceaccountencryption
     *
     * @param string $bounceaccountencryption
     * @return LimeSurveys
     */
    public function setBounceaccountencryption($bounceaccountencryption)
    {
        $this->bounceaccountencryption = $bounceaccountencryption;
    
        return $this;
    }

    /**
     * Get bounceaccountencryption
     *
     * @return string 
     */
    public function getBounceaccountencryption()
    {
        return $this->bounceaccountencryption;
    }

    /**
     * Set bounceaccountuser
     *
     * @param string $bounceaccountuser
     * @return LimeSurveys
     */
    public function setBounceaccountuser($bounceaccountuser)
    {
        $this->bounceaccountuser = $bounceaccountuser;
    
        return $this;
    }

    /**
     * Get bounceaccountuser
     *
     * @return string 
     */
    public function getBounceaccountuser()
    {
        return $this->bounceaccountuser;
    }

    /**
     * Set showwelcome
     *
     * @param string $showwelcome
     * @return LimeSurveys
     */
    public function setShowwelcome($showwelcome)
    {
        $this->showwelcome = $showwelcome;
    
        return $this;
    }

    /**
     * Get showwelcome
     *
     * @return string 
     */
    public function getShowwelcome()
    {
        return $this->showwelcome;
    }

    /**
     * Set showprogress
     *
     * @param string $showprogress
     * @return LimeSurveys
     */
    public function setShowprogress($showprogress)
    {
        $this->showprogress = $showprogress;
    
        return $this;
    }

    /**
     * Get showprogress
     *
     * @return string 
     */
    public function getShowprogress()
    {
        return $this->showprogress;
    }

    /**
     * Set allowjumps
     *
     * @param string $allowjumps
     * @return LimeSurveys
     */
    public function setAllowjumps($allowjumps)
    {
        $this->allowjumps = $allowjumps;
    
        return $this;
    }

    /**
     * Get allowjumps
     *
     * @return string 
     */
    public function getAllowjumps()
    {
        return $this->allowjumps;
    }

    /**
     * Set navigationdelay
     *
     * @param integer $navigationdelay
     * @return LimeSurveys
     */
    public function setNavigationdelay($navigationdelay)
    {
        $this->navigationdelay = $navigationdelay;
    
        return $this;
    }

    /**
     * Get navigationdelay
     *
     * @return integer 
     */
    public function getNavigationdelay()
    {
        return $this->navigationdelay;
    }

    /**
     * Set nokeyboard
     *
     * @param string $nokeyboard
     * @return LimeSurveys
     */
    public function setNokeyboard($nokeyboard)
    {
        $this->nokeyboard = $nokeyboard;
    
        return $this;
    }

    /**
     * Get nokeyboard
     *
     * @return string 
     */
    public function getNokeyboard()
    {
        return $this->nokeyboard;
    }

    /**
     * Set alloweditaftercompletion
     *
     * @param string $alloweditaftercompletion
     * @return LimeSurveys
     */
    public function setAlloweditaftercompletion($alloweditaftercompletion)
    {
        $this->alloweditaftercompletion = $alloweditaftercompletion;
    
        return $this;
    }

    /**
     * Get alloweditaftercompletion
     *
     * @return string 
     */
    public function getAlloweditaftercompletion()
    {
        return $this->alloweditaftercompletion;
    }

    /**
     * Set googleanalyticsstyle
     *
     * @param string $googleanalyticsstyle
     * @return LimeSurveys
     */
    public function setGoogleanalyticsstyle($googleanalyticsstyle)
    {
        $this->googleanalyticsstyle = $googleanalyticsstyle;
    
        return $this;
    }

    /**
     * Get googleanalyticsstyle
     *
     * @return string 
     */
    public function getGoogleanalyticsstyle()
    {
        return $this->googleanalyticsstyle;
    }

    /**
     * Set googleanalyticsapikey
     *
     * @param string $googleanalyticsapikey
     * @return LimeSurveys
     */
    public function setGoogleanalyticsapikey($googleanalyticsapikey)
    {
        $this->googleanalyticsapikey = $googleanalyticsapikey;
    
        return $this;
    }

    /**
     * Get googleanalyticsapikey
     *
     * @return string 
     */
    public function getGoogleanalyticsapikey()
    {
        return $this->googleanalyticsapikey;
    }

    /**
     * Set sendconfirmation
     *
     * @param string $sendconfirmation
     * @return LimeSurveys
     */
    public function setSendconfirmation($sendconfirmation)
    {
        $this->sendconfirmation = $sendconfirmation;
    
        return $this;
    }

    /**
     * Get sendconfirmation
     *
     * @return string 
     */
    public function getSendconfirmation()
    {
        return $this->sendconfirmation;
    }
}
