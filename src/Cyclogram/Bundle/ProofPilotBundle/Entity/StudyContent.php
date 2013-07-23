<?php

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
     * @var string
     *
     * @ORM\Column(name="study_name", type="string", length=255, nullable=true)
     */
    private $studyName;

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

}
