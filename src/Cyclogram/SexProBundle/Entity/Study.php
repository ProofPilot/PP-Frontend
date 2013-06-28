<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Study
 *
 * @ORM\Table(name="study")
 * @ORM\Entity
 */
class Study
{
    /**
     * @var integer
     *
     * @ORM\Column(name="study_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $studyId;

    /**
     * @var string
     *
     * @ORM\Column(name="study_name", type="string", length=45, nullable=false)
     */
    private $studyName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="study_recruitment_start", type="datetime", nullable=true)
     */
    private $studyRecruitmentStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="study_recruitment_end", type="datetime", nullable=true)
     */
    private $studyRecruitmentEnd;

    /**
     * @var boolean
     *
     * @ORM\Column(name="study_recruitment_extend_end", type="boolean", nullable=true)
     */
    private $studyRecruitmentExtendEnd;

    /**
     * @var boolean
     *
     * @ORM\Column(name="study_allow_invites", type="boolean", nullable=false)
     */
    private $studyAllowInvites;

    /**
     * @var boolean
     *
     * @ORM\Column(name="study_allow_sharing", type="boolean", nullable=false)
     */
    private $studyAllowSharing;

    /**
     * @var boolean
     *
     * @ORM\Column(name="study_invite_only", type="boolean", nullable=false)
     */
    private $studyInviteOnly;

    /**
     * @var string
     *
     * @ORM\Column(name="study_facebook_page", type="string", length=255, nullable=true)
     */
    private $studyFacebookPage;

    /**
     * @var string
     *
     * @ORM\Column(name="study_twitter_page", type="string", length=255, nullable=true)
     */
    private $studyTwitterPage;

    /**
     * @var boolean
     *
     * @ORM\Column(name="study_allow_mobile_devices_store_date", type="boolean", nullable=false)
     */
    private $studyAllowMobileDevicesStoreDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="study_barcode_required", type="boolean", nullable=false)
     */
    private $studyBarcodeRequired;

    /**
     * @var boolean
     *
     * @ORM\Column(name="study_real_time_graphics", type="boolean", nullable=false)
     */
    private $studyRealTimeGraphics;

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
    private $language;

    /**
     * @var \Status
     *
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="status_id")
     * })
     */
    private $status;

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
     * Set studyName
     *
     * @param string $studyName
     * @return Study
     */
    public function setStudyName($studyName)
    {
        $this->studyName = $studyName;
    
        return $this;
    }

    /**
     * Get studyName
     *
     * @return string 
     */
    public function getStudyName()
    {
        return $this->studyName;
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
    public function setStudyAllowMobileDevicesStoreDate($studyAllowMobileDevicesStoreDate)
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
    public function addLanguage(\Cyclogram\Bundle\ProofPilotBundle\Entity\Language $language)
    {
        $this->language[] = $language;
    
        return $this;
    }

    /**
     * Remove language
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Language $language
     */
    public function removeLanguage(\Cyclogram\Bundle\ProofPilotBundle\Entity\Language $language)
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
    public function setStatus(\Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status = null)
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
}