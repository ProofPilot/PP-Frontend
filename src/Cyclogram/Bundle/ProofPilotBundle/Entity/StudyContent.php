<?php
/*
 * This is part of the ProofPilot package.
 *
 * (c)2012-2013 Cyclogram, Inc, West Hollywood, CA <crew@proofpilot.com>
 * ALL RIGHTS RESERVED
 *
 * This software is provided by the copyright holders to Manila Consulting for use on the
 * Center for Disease Control's Evaluation of Rapid HIV Self-Testing among MSM in High
 * Prevalence Cities until 2016 or the project is completed.
 *
 * Any unauthorized use, modification or resale is not permitted without expressed permission
 * from the copyright holders.
 *
 * KnowatHome branding, URL, study logic, survey instruments, and resulting data are not part
 * of this copyright and remain the property of the prime contractor.
 *
 */

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * StudyContent
 *
 * @ORM\Table(name="study_content")
 * @ORM\Entity(repositoryClass="Cyclogram\Bundle\ProofPilotBundle\Repository\StudyContentRepository")
 */
class StudyContent
{
    /**
     * @var integer
     *
     * @ORM\Column(name="study_id", type="integer", nullable=false)
     */
    private $studyId;

    /**
     * @var string
     *
     * @ORM\Column(name="study_name", type="string", length=255, nullable=true)
     */
    private $studyName;

    /**
     * @var string
     *
     * @ORM\Column(name="study_sponsor_by", type="string", length=2000, nullable=true)
     */
    private $studySponsorBy;

    /**
     * @var string
     *
     * @ORM\Column(name="study_vimeo_video", type="string", length=255, nullable=true)
     */
    protected $studyVimeoVideo;

    /**
     * @var string
     *
     * @ORM\Column(name="study_logo", type="string", length=255, nullable=true)
     */
    private $studyLogo;

    /**
     * @var string
     *
     * @ORM\Column(name="study_video", type="string", length=255, nullable=true)
     */
    private $studyVideo;

    /**
     * @var string
     *
     * @ORM\Column(name="study_graphic", type="string", length=255, nullable=true)
     */
    private $studyGraphic;

    /**
     * @var string
     *
     * @ORM\Column(name="study_about", type="string", length=2000, nullable=true)
     */
    private $studyAbout;

    /**
     * @var string
     *
     * @ORM\Column(name="study_whats_involved", type="string", length=2000, nullable=true)
     */
    private $studyWhatsInvolved;

    /**
     * @var string
     *
     * @ORM\Column(name="study_requirements", type="string", length=2000, nullable=true)
     */
    private $studyRequirements;

    /**
     * @var string
     *
     * @ORM\Column(name="study_privacy", type="string", length=2000, nullable=true)
     */
    private $studyPrivacy;

    /**
     * @var integer
     *
     * @ORM\Column(name="study_elegibility_survey", type="integer", nullable=true)
     */
    private $studyElegibilitySurvey;

    /**
     * @var string
     *
     * @ORM\Column(name="study_video_addition", type="string", length=255, nullable=true)
     */
    private $studyVideoAddition;

    /**
     * @var string
     *
     * @ORM\Column(name="study_consent_image", type="string", length=255, nullable=true)
     */
    private $studyConsentImage;

    /**
     * @var string
     *
     * @ORM\Column(name="study_consent_introduction", type="string", length=2000, nullable=true)
     */
    private $studyConsentIntroduction;

    /**
     * @var string
     *
     * @ORM\Column(name="study_consent", type="string", length=2000, nullable=true)
     */
    private $studyConsent;

    /**
     * @var string
     *
     * @ORM\Column(name="study_tagline", type="string", length=250, nullable=true)
     */
    private $studyTagline;

    /**
     * @var string
     *
     * @ORM\Column(name="study_description", type="string", length=2000, nullable=true)
     */
    private $studyDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="study_url", type="string", length=200, nullable=true)
     */
    private $studyUrl;

    /**
     * @var \Language
     * 
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="language_id", referencedColumnName="language_id")
     * })
     */
    private $language;

    /**
     * @var \Study
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Study")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="study_id", referencedColumnName="study_id")
     * })
     */
    private $study;

    /**
     * @var string
     *
     * @ORM\Column(name="study_specific_login_header", type="string", length=255, nullable=true)
     */
    private $studySpecificLoginHeader;

    /**
     * @var string
     *
     * @ORM\Column(name="study_join_button_name", type="string", length=255, nullable=true)
     */
    private $studyJoinButtonName;

    /**
     * @var string
     *
     * @ORM\Column(name="study_prelaunch_message", type="string", length=45, nullable=true)
     */
    private $studyPrelaunchMessage;

    /**
     * @var string
     *
     * @ORM\Column(name="study_join_google_button", type="string", length=45, nullable=true)
     */
    private $studyJoinGoogleButton;

    /**
     * @var string
     *
     * @ORM\Column(name="study_join_facebook_button", type="string", length=45, nullable=true)
     */
    private $studyJoinFacebookButton;

    /**
     * @var string
     *
     * @ORM\Column(name="study_about_it", type="string", length=45, nullable=true)
     */
    private $studyaboutit;

    public function getStudyLogo()
    {
        return $this->studyLogo;
    }

    public function setStudyLogo($studyLogo)
    {
        $this->studyLogo = $studyLogo;
    }

    public function getStudyVideo()
    {
        return $this->studyVideo;
    }

    public function setStudyVideo($studyVideo)
    {
        $this->studyVideo = $studyVideo;
    }

    public function getStudyGraphic()
    {
        return $this->studyGraphic;
    }

    public function setStudyGraphic($studyGraphic)
    {
        $this->studyGraphic = $studyGraphic;
    }

    public function getStudyAbout()
    {
        return $this->studyAbout;
    }

    public function setStudyAbout($studyAbout)
    {
        $this->studyAbout = $studyAbout;
    }

    public function getStudyWhatsInvolved()
    {
        return $this->studyWhatsInvolved;
    }

    public function setStudyWhatsInvolved($studyWhatsInvolved)
    {
        $this->studyWhatsInvolved = $studyWhatsInvolved;
    }

    public function getStudyRequirements()
    {
        return $this->studyRequirements;
    }

    public function setStudyRequirements($studyRequirements)
    {
        $this->studyRequirements = $studyRequirements;
    }

    public function getStudyPrivacy()
    {
        return $this->studyPrivacy;
    }

    public function setStudyPrivacy($studyPrivacy)
    {
        $this->studyPrivacy = $studyPrivacy;
    }

    public function getStudyElegibilitySurvey()
    {
        return $this->studyElegibilitySurvey;
    }

    public function setStudyElegibilitySurvey($studyElegibilitySurvey)
    {
        $this->studyElegibilitySurvey = $studyElegibilitySurvey;
    }

    public function getStudyVideoAddition()
    {
        return $this->studyVideoAddition;
    }

    public function setStudyVideoAddition($studyVideoAddition)
    {
        $this->studyVideoAddition = $studyVideoAddition;
    }

    public function getStudyConsentImage()
    {
        return $this->studyConsentImage;
    }

    public function setStudyConsentImage($studyConsentImage)
    {
        $this->studyConsentImage = $studyConsentImage;
    }

    public function getStudyConsentIntroduction()
    {
        return $this->studyConsentIntroduction;
    }

    public function setStudyConsentIntroduction($studyConsentIntroduction)
    {
        $this->studyConsentIntroduction = $studyConsentIntroduction;
    }

    public function getStudyConsent()
    {
        return $this->studyConsent;
    }

    public function setStudyConsent($studyConsent)
    {
        $this->studyConsent = $studyConsent;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
    }

    public function getStudy()
    {
        return $this->study;
    }

    public function setStudy($study)
    {
        $this->study = $study;
    }

    public function getStudyName()
    {
        return $this->studyName;
    }

    public function setStudyName($studyName)
    {
        $this->studyName = $studyName;
    }

    public function getStudyTagline()
    {
        return $this->studyTagline;
    }

    public function setStudyTagline($studyTagline)
    {
        $this->studyTagline = $studyTagline;
    }

    public function getStudyDescription()
    {
        return $this->studyDescription;
    }

    public function setStudyDescription($studyDescription)
    {
        $this->studyDescription = $studyDescription;
    }

    public function getStudyUrl()
    {
        return $this->studyUrl;
    }

    public function setStudyUrl($studyUrl)
    {
        $this->studyUrl = $studyUrl;
    }

    public function getStudyId()
    {
        return $this->studyId;
    }

    public function setStudyId($studyId)
    {
        $this->studyId = $studyId;
    }

    public function getStudySponsorBy()
    {
        return $this->studySponsorBy;
    }

    public function setStudySponsorBy($studySponsorBy)
    {
        $this->studySponsorBy = $studySponsorBy;
    }

    public function getStudySpecificLoginHeader()
    {
        return $this->studySpecificLoginHeader;
    }

    public function setStudySpecificLoginHeader($studySpecificLoginHeader)
    {
        $this->studySpecificLoginHeader = $studySpecificLoginHeader;
    }

    public function getStudyJoinButtonName()
    {
        return $this->studyJoinButtonName;
    }

    public function setStudyJoinButtonName($studyJoinButtonName)
    {
        $this->studyJoinButtonName = $studyJoinButtonName;
    }

    public function getStudyPrelaunchMessage()
    {
        return $this->studyPrelaunchMessage;
    }

    public function setStudyPrelaunchMessage($studyPrelaunchMessage)
    {
        $this->studyPrelaunchMessage = $studyPrelaunchMessage;
    }

    public function getStudyJoinGoogleButton()
    {
        return $this->studyJoinGoogleButton;
    }

    public function setStudyJoinGoogleButton($studyJoinGoogleButton)
    {
        $this->studyJoinGoogleButton = $studyJoinGoogleButton;
    }

    public function getStudyJoinFacebookButton()
    {
        return $this->studyJoinFacebookButton;
    }

    public function setStudyJoinFacebookButton($studyJoinFacebookButton)
    {
        $this->studyJoinFacebookButton = $studyJoinFacebookButton;
    }

    public function getStudyaboutit()
    {
        return $this->studyaboutit;
    }

    public function setStudyaboutit($studyaboutit)
    {
        $this->studyaboutit = $studyaboutit;
    }

    public function getStudyVimeoVideo()
    {
        return $this->studyVimeoVideo;
    }

    public function setStudyVimeoVideo(string $studyVimeoVideo)
    {
        $this->studyVimeoVideo = $studyVimeoVideo;
    }

}
