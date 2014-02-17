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
 * Study
 *
 * @ORM\Table(name="study")
 * @ORM\Entity(repositoryClass="Cyclogram\Bundle\ProofPilotBundle\Repository\StudyRepository")
 */
class Study
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;
    const STATUS_NEW = 6;
    CONST STATUS_PRELAUNCH = 31;
    /**
     * @var integer
     *
     * @ORM\Column(name="study_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $studyId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="study_recruitment_start", type="datetime", nullable=true)
     */
    protected $studyRecruitmentStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="study_recruitment_end", type="datetime", nullable=true)
     */
    protected $studyRecruitmentEnd;

    /**
     * @var boolean
     *
     * @ORM\Column(name="study_recruitment_extend_end", type="boolean", nullable=true)
     */
    protected $studyRecruitmentExtendEnd;

    /**
     * @var boolean
     *
     * @ORM\Column(name="study_allow_invites", type="boolean", nullable=false)
     */
    protected $studyAllowInvites;

    /**
     * @var boolean
     *
     * @ORM\Column(name="study_allow_sharing", type="boolean", nullable=false)
     */
    protected $studyAllowSharing;

    /**
     * @var boolean
     *
     * @ORM\Column(name="study_invite_only", type="boolean", nullable=false)
     */
    protected $studyInviteOnly;

    /**
     * @var string
     *
     * @ORM\Column(name="study_facebook_page", type="string", length=255, nullable=true)
     */
    protected $studyFacebookPage;

    /**
     * @var string
     *
     * @ORM\Column(name="study_twitter_page", type="string", length=255, nullable=true)
     */
    protected $studyTwitterPage;

    /**
     * @var boolean
     *
     * @ORM\Column(name="study_allow_mobile_devices_store_date", type="boolean", nullable=false)
     */
    protected $studyAllowMobileDevicesStoreDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="study_barcode_required", type="boolean", nullable=false)
     */
    protected $studyBarcodeRequired;

    /**
     * @var boolean
     *
     * @ORM\Column(name="email_verification_required", type="boolean", nullable=false)
     */
    protected $emailVerificationRequired;

    /**
     * @var integer
     *
     * @ORM\Column(name="participant_register_last", type="boolean", nullable=false)
     */
    protected $participantRegisterLast;

    /**
     * @var integer
     *
     * @ORM\Column(name="study_number_of_current_participants", type="integer", nullable=false)
     */
    protected $studyNumberOfCurrentParticipants;

    /**
     * @var integer
     *
     * @ORM\Column(name="study_participants_goal", type="integer", nullable=false)
     */
    protected $studyParticipantsGoal;

    /**
     * @var integer
     *
     * @ORM\Column(name="study_skip_consent", type="boolean", nullable=false)
     */
    protected $studySkipConsent;

    /**
     * @var integer
     *
     * @ORM\Column(name="study_skip_about_me", type="boolean", nullable=false)
     */
    protected $studySkipAboutMe;

    /**
     * @var boolean
     *
     * @ORM\Column(name="study_real_time_graphics", type="boolean", nullable=false)
     */
    protected $studyRealTimeGraphics;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Language", inversedBy="study")
     * @ORM\JoinTable(name="study_content",
     *   joinColumns={
     *     @ORM\JoinColumn(name="study_id", referencedColumnName="study_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="language_id", referencedColumnName="language_id")
     *   }
     * )
     */
    protected $language;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=false)
     */
    protected $status;

    /**
     * @var string
     *
     * @ORM\Column(name="study_code", type="string", length=45, nullable=true)
     */
    protected $studyCode;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->language = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get studyId
     *
     * @return integer 
     */
    public function getStudyId()
    {
        return $this->studyId;
    }

    /**
     * Set studyRecruitmentStart
     *
     * @param \DateTime $studyRecruitmentStart
     * @return Study
     */
    public function setStudyRecruitmentStart($studyRecruitmentStart)
    {
        $this->studyRecruitmentStart = $studyRecruitmentStart;

        return $this;
    }

    /**
     * Get studyRecruitmentStart
     *
     * @return \DateTime 
     */
    public function getStudyRecruitmentStart()
    {
        return $this->studyRecruitmentStart;
    }

    /**
     * Set studyRecruitmentEnd
     *
     * @param \DateTime $studyRecruitmentEnd
     * @return Study
     */
    public function setStudyRecruitmentEnd($studyRecruitmentEnd)
    {
        $this->studyRecruitmentEnd = $studyRecruitmentEnd;

        return $this;
    }

    /**
     * Get studyRecruitmentEnd
     *
     * @return \DateTime 
     */
    public function getStudyRecruitmentEnd()
    {
        return $this->studyRecruitmentEnd;
    }

    /**
     * Set studyRecruitmentExtendEnd
     *
     * @param boolean $studyRecruitmentExtendEnd
     * @return Study
     */
    public function setStudyRecruitmentExtendEnd($studyRecruitmentExtendEnd)
    {
        $this->studyRecruitmentExtendEnd = $studyRecruitmentExtendEnd;

        return $this;
    }

    /**
     * Get studyRecruitmentExtendEnd
     *
     * @return boolean 
     */
    public function getStudyRecruitmentExtendEnd()
    {
        return $this->studyRecruitmentExtendEnd;
    }

    /**
     * Set studyAllowInvites
     *
     * @param boolean $studyAllowInvites
     * @return Study
     */
    public function setStudyAllowInvites($studyAllowInvites)
    {
        $this->studyAllowInvites = $studyAllowInvites;

        return $this;
    }

    /**
     * Get studyAllowInvites
     *
     * @return boolean 
     */
    public function getStudyAllowInvites()
    {
        return $this->studyAllowInvites;
    }

    /**
     * Set studyAllowSharing
     *
     * @param boolean $studyAllowSharing
     * @return Study
     */
    public function setStudyAllowSharing($studyAllowSharing)
    {
        $this->studyAllowSharing = $studyAllowSharing;

        return $this;
    }

    /**
     * Get studyAllowSharing
     *
     * @return boolean 
     */
    public function getStudyAllowSharing()
    {
        return $this->studyAllowSharing;
    }

    /**
     * Set studyInviteOnly
     *
     * @param boolean $studyInviteOnly
     * @return Study
     */
    public function setStudyInviteOnly($studyInviteOnly)
    {
        $this->studyInviteOnly = $studyInviteOnly;

        return $this;
    }

    /**
     * Get studyInviteOnly
     *
     * @return boolean 
     */
    public function getStudyInviteOnly()
    {
        return $this->studyInviteOnly;
    }

    /**
     * Set studyFacebookPage
     *
     * @param string $studyFacebookPage
     * @return Study
     */
    public function setStudyFacebookPage($studyFacebookPage)
    {
        $this->studyFacebookPage = $studyFacebookPage;

        return $this;
    }

    /**
     * Get studyFacebookPage
     *
     * @return string 
     */
    public function getStudyFacebookPage()
    {
        return $this->studyFacebookPage;
    }

    /**
     * Set studyTwitterPage
     *
     * @param string $studyTwitterPage
     * @return Study
     */
    public function setStudyTwitterPage($studyTwitterPage)
    {
        $this->studyTwitterPage = $studyTwitterPage;

        return $this;
    }

    /**
     * Get studyTwitterPage
     *
     * @return string 
     */
    public function getStudyTwitterPage()
    {
        return $this->studyTwitterPage;
    }

    /**
     * Set studyAllowMobileDevicesStoreDate
     *
     * @param boolean $studyAllowMobileDevicesStoreDate
     * @return Study
     */
    public function setStudyAllowMobileDevicesStoreDate(
            $studyAllowMobileDevicesStoreDate)
    {
        $this->studyAllowMobileDevicesStoreDate = $studyAllowMobileDevicesStoreDate;

        return $this;
    }

    /**
     * Get studyAllowMobileDevicesStoreDate
     *
     * @return boolean 
     */
    public function getStudyAllowMobileDevicesStoreDate()
    {
        return $this->studyAllowMobileDevicesStoreDate;
    }

    /**
     * Set studyBarcodeRequired
     *
     * @param boolean $studyBarcodeRequired
     * @return Study
     */
    public function setStudyBarcodeRequired($studyBarcodeRequired)
    {
        $this->studyBarcodeRequired = $studyBarcodeRequired;

        return $this;
    }

    /**
     * Get studyBarcodeRequired
     *
     * @return boolean 
     */
    public function getStudyBarcodeRequired()
    {
        return $this->studyBarcodeRequired;
    }

    /**
     * Set studyRealTimeGraphics
     *
     * @param boolean $studyRealTimeGraphics
     * @return Study
     */
    public function setStudyRealTimeGraphics($studyRealTimeGraphics)
    {
        $this->studyRealTimeGraphics = $studyRealTimeGraphics;

        return $this;
    }

    /**
     * Get studyRealTimeGraphics
     *
     * @return boolean 
     */
    public function getStudyRealTimeGraphics()
    {
        return $this->studyRealTimeGraphics;
    }

    /**
     * Add language
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Language $language
     * @return Study
     */
    public function addLanguage(
            \Cyclogram\Bundle\ProofPilotBundle\Entity\Language $language)
    {
        $this->language[] = $language;

        return $this;
    }

    /**
     * Remove language
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Language $language
     */
    public function removeLanguage(
            \Cyclogram\Bundle\ProofPilotBundle\Entity\Language $language)
    {
        $this->language->removeElement($language);
    }

    /**
     * Get language
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return Study
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Status 
     */
    public function getStatus()
    {
        return $this->status;
    }

    public function __toString()
    {
        return $this->studyName;
    }

    public function getEmailVerificationRequired()
    {
        return $this->emailVerificationRequired;
    }

    public function setEmailVerificationRequired($emailVerificationRequired)
    {
        $this->emailVerificationRequired = $emailVerificationRequired;
    }

    public function getStudyCode()
    {
        return $this->studyCode;
    }

    public function setStudyCode($studyCode)
    {
        $this->studyCode = $studyCode;
    }

    public function getStudyNumberOfCurrentParticipants()
    {
        return $this->studyNumberOfCurrentParticipants;
    }

    public function setStudyNumberOfCurrentParticipants(
            $studyNumberOfCurrentParticipants)
    {
        $this->studyNumberOfCurrentParticipants = $studyNumberOfCurrentParticipants;
    }

    public function getStudyParticipantsGoal()
    {
        return $this->studyParticipantsGoal;
    }

    public function setStudyParticipantsGoal($studyParticipantsGoal)
    {
        $this->studyParticipantsGoal = $studyParticipantsGoal;
    }

    public function getParticipantRegisterLast()
    {
        return $this->participantRegisterLast;
    }

    public function setParticipantRegisterLast($participantRegisterLast)
    {
        $this->participantRegisterLast = $participantRegisterLast;
    }

    public function getStudySkipConsent()
    {
        return $this->studySkipConsent;
    }

    public function setStudySkipConsent($studySkipConsent)
    {
        $this->studySkipConsent = $studySkipConsent;
    }

    public function getStudySkipAboutMe()
    {
        return $this->studySkipAboutMe;
    }

    public function setStudySkipAboutMe($studySkipAboutMe)
    {
        $this->studySkipAboutMe = $studySkipAboutMe;
    }

}
