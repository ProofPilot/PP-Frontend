<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParticipantCampaignLink
 *
 * @ORM\Table(name="participant_campaign_link")
 * @ORM\Entity
 */
class ParticipantCampaignLink
{
    /**
     * @var string
     *
     * @ORM\Column(name="participant_campaign_link_id", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $participantCampaignLinkId;

    /**
     * @var string
     *
     * @ORM\Column(name="participant_campaign_link_participant_email", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $participantCampaignLinkParticipantEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="participant_campaign_link_ip_address", type="string", length=45, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $participantCampaignLinkIpAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="participant_campaign_link_referral_code", type="string", length=45, nullable=true)
     */
    private $participantCampaignLinkReferralCode;

    /**
     * @var string
     *
     * @ORM\Column(name="participant_campaign_link_site", type="string", length=100, nullable=true)
     */
    private $participantCampaignLinkSite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="participant_campaign_link_datetime", type="datetime", nullable=true)
     */
    private $participantCampaignLinkDatetime;

    /**
     * @var string
     *
     * @ORM\Column(name="participant_survey_link_uniqid", type="string", length=45, nullable=false)
     */
    private $participantSurveyLinkUniqid;

    /**
     * @var \Campaign
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Campaign")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="campaign_id", referencedColumnName="campaign_id")
     * })
     */
    private $campaign;

    /**
     * @var \Participant
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Participant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="participant_id", referencedColumnName="participant_id")
     * })
     */
    private $participant;

    /**
     * @var \ParticipantLevel
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="ParticipantLevel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="participant_level_id", referencedColumnName="participant_level_id")
     * })
     */
    private $participantLevel;



    /**
     * Set participantCampaignLinkId
     *
     * @param string $participantCampaignLinkId
     * @return ParticipantCampaignLink
     */
    public function setParticipantCampaignLinkId($participantCampaignLinkId)
    {
        $this->participantCampaignLinkId = $participantCampaignLinkId;
    
        return $this;
    }

    /**
     * Get participantCampaignLinkId
     *
     * @return string 
     */
    public function getParticipantCampaignLinkId()
    {
        return $this->participantCampaignLinkId;
    }

    /**
     * Set participantCampaignLinkParticipantEmail
     *
     * @param string $participantCampaignLinkParticipantEmail
     * @return ParticipantCampaignLink
     */
    public function setParticipantCampaignLinkParticipantEmail($participantCampaignLinkParticipantEmail)
    {
        $this->participantCampaignLinkParticipantEmail = $participantCampaignLinkParticipantEmail;
    
        return $this;
    }

    /**
     * Get participantCampaignLinkParticipantEmail
     *
     * @return string 
     */
    public function getParticipantCampaignLinkParticipantEmail()
    {
        return $this->participantCampaignLinkParticipantEmail;
    }

    /**
     * Set participantCampaignLinkIpAddress
     *
     * @param string $participantCampaignLinkIpAddress
     * @return ParticipantCampaignLink
     */
    public function setParticipantCampaignLinkIpAddress($participantCampaignLinkIpAddress)
    {
        $this->participantCampaignLinkIpAddress = $participantCampaignLinkIpAddress;
    
        return $this;
    }

    /**
     * Get participantCampaignLinkIpAddress
     *
     * @return string 
     */
    public function getParticipantCampaignLinkIpAddress()
    {
        return $this->participantCampaignLinkIpAddress;
    }

    /**
     * Set participantCampaignLinkReferralCode
     *
     * @param string $participantCampaignLinkReferralCode
     * @return ParticipantCampaignLink
     */
    public function setParticipantCampaignLinkReferralCode($participantCampaignLinkReferralCode)
    {
        $this->participantCampaignLinkReferralCode = $participantCampaignLinkReferralCode;
    
        return $this;
    }

    /**
     * Get participantCampaignLinkReferralCode
     *
     * @return string 
     */
    public function getParticipantCampaignLinkReferralCode()
    {
        return $this->participantCampaignLinkReferralCode;
    }

    /**
     * Set participantCampaignLinkSite
     *
     * @param string $participantCampaignLinkSite
     * @return ParticipantCampaignLink
     */
    public function setParticipantCampaignLinkSite($participantCampaignLinkSite)
    {
        $this->participantCampaignLinkSite = $participantCampaignLinkSite;
    
        return $this;
    }

    /**
     * Get participantCampaignLinkSite
     *
     * @return string 
     */
    public function getParticipantCampaignLinkSite()
    {
        return $this->participantCampaignLinkSite;
    }

    /**
     * Set participantCampaignLinkDatetime
     *
     * @param \DateTime $participantCampaignLinkDatetime
     * @return ParticipantCampaignLink
     */
    public function setParticipantCampaignLinkDatetime($participantCampaignLinkDatetime)
    {
        $this->participantCampaignLinkDatetime = $participantCampaignLinkDatetime;
    
        return $this;
    }

    /**
     * Get participantCampaignLinkDatetime
     *
     * @return \DateTime 
     */
    public function getParticipantCampaignLinkDatetime()
    {
        return $this->participantCampaignLinkDatetime;
    }

    /**
     * Set participantSurveyLinkUniqid
     *
     * @param string $participantSurveyLinkUniqid
     * @return ParticipantCampaignLink
     */
    public function setParticipantSurveyLinkUniqid($participantSurveyLinkUniqid)
    {
        $this->participantSurveyLinkUniqid = $participantSurveyLinkUniqid;
    
        return $this;
    }

    /**
     * Get participantSurveyLinkUniqid
     *
     * @return string 
     */
    public function getParticipantSurveyLinkUniqid()
    {
        return $this->participantSurveyLinkUniqid;
    }

    /**
     * Set campaign
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Campaign $campaign
     * @return ParticipantCampaignLink
     */
    public function setCampaign(\Cyclogram\Bundle\ProofPilotBundle\Entity\Campaign $campaign)
    {
        $this->campaign = $campaign;
    
        return $this;
    }

    /**
     * Get campaign
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Campaign 
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    /**
     * Set participant
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participant
     * @return ParticipantCampaignLink
     */
    public function setParticipant(\Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participant)
    {
        $this->participant = $participant;
    
        return $this;
    }

    /**
     * Get participant
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Participant 
     */
    public function getParticipant()
    {
        return $this->participant;
    }

    /**
     * Set participantLevel
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantLevel $participantLevel
     * @return ParticipantCampaignLink
     */
    public function setParticipantLevel(\Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantLevel $participantLevel)
    {
        $this->participantLevel = $participantLevel;
    
        return $this;
    }

    /**
     * Get participantLevel
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantLevel 
     */
    public function getParticipantLevel()
    {
        return $this->participantLevel;
    }
}