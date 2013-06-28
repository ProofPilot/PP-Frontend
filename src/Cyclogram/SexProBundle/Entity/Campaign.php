<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campaign
 *
 * @ORM\Table(name="campaign")
 * @ORM\Entity
 */
class Campaign
{
    /**
     * @var integer
     *
     * @ORM\Column(name="campaign_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $campaignId;

    /**
     * @var string
     *
     * @ORM\Column(name="campaign_name", type="string", length=45, nullable=false)
     */
    private $campaignName;

    /**
     * @var string
     *
     * @ORM\Column(name="campaign_desc", type="string", length=500, nullable=true)
     */
    private $campaignDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="campaign_target", type="string", length=500, nullable=true)
     */
    private $campaignTarget;

    /**
     * @var string
     *
     * @ORM\Column(name="campaign_url", type="string", length=400, nullable=true)
     */
    private $campaignUrl;

    /**
     * @var float
     *
     * @ORM\Column(name="campaign_budget", type="float", nullable=true)
     */
    private $campaignBudget;

    /**
     * @var float
     *
     * @ORM\Column(name="campaign_budget_spend", type="float", nullable=true)
     */
    private $campaignBudgetSpend;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="campaign_date_start", type="datetime", nullable=true)
     */
    private $campaignDateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="campaign_date_end", type="datetime", nullable=true)
     */
    private $campaignDateEnd;

    /**
     * @var \Affinity
     *
     * @ORM\ManyToOne(targetEntity="Affinity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="affinity_id", referencedColumnName="affinity_id")
     * })
     */
    private $affinity;

    /**
     * @var \CampaignType
     *
     * @ORM\ManyToOne(targetEntity="CampaignType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="campaign_type_id", referencedColumnName="campaign_type_id")
     * })
     */
    private $campaignType;

    /**
     * @var \Placement
     *
     * @ORM\ManyToOne(targetEntity="Placement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="placement_id", referencedColumnName="placement_id")
     * })
     */
    private $placement;

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
     * Get campaignId
     *
     * @return integer 
     */
    public function getCampaignId()
    {
        return $this->campaignId;
    }

    /**
     * Set campaignName
     *
     * @param string $campaignName
     * @return Campaign
     */
    public function setCampaignName($campaignName)
    {
        $this->campaignName = $campaignName;
    
        return $this;
    }

    /**
     * Get campaignName
     *
     * @return string 
     */
    public function getCampaignName()
    {
        return $this->campaignName;
    }

    /**
     * Set campaignDesc
     *
     * @param string $campaignDesc
     * @return Campaign
     */
    public function setCampaignDesc($campaignDesc)
    {
        $this->campaignDesc = $campaignDesc;
    
        return $this;
    }

    /**
     * Get campaignDesc
     *
     * @return string 
     */
    public function getCampaignDesc()
    {
        return $this->campaignDesc;
    }

    /**
     * Set campaignTarget
     *
     * @param string $campaignTarget
     * @return Campaign
     */
    public function setCampaignTarget($campaignTarget)
    {
        $this->campaignTarget = $campaignTarget;
    
        return $this;
    }

    /**
     * Get campaignTarget
     *
     * @return string 
     */
    public function getCampaignTarget()
    {
        return $this->campaignTarget;
    }

    /**
     * Set campaignUrl
     *
     * @param string $campaignUrl
     * @return Campaign
     */
    public function setCampaignUrl($campaignUrl)
    {
        $this->campaignUrl = $campaignUrl;
    
        return $this;
    }

    /**
     * Get campaignUrl
     *
     * @return string 
     */
    public function getCampaignUrl()
    {
        return $this->campaignUrl;
    }

    /**
     * Set campaignBudget
     *
     * @param float $campaignBudget
     * @return Campaign
     */
    public function setCampaignBudget($campaignBudget)
    {
        $this->campaignBudget = $campaignBudget;
    
        return $this;
    }

    /**
     * Get campaignBudget
     *
     * @return float 
     */
    public function getCampaignBudget()
    {
        return $this->campaignBudget;
    }

    /**
     * Set campaignBudgetSpend
     *
     * @param float $campaignBudgetSpend
     * @return Campaign
     */
    public function setCampaignBudgetSpend($campaignBudgetSpend)
    {
        $this->campaignBudgetSpend = $campaignBudgetSpend;
    
        return $this;
    }

    /**
     * Get campaignBudgetSpend
     *
     * @return float 
     */
    public function getCampaignBudgetSpend()
    {
        return $this->campaignBudgetSpend;
    }

    /**
     * Set campaignDateStart
     *
     * @param \DateTime $campaignDateStart
     * @return Campaign
     */
    public function setCampaignDateStart($campaignDateStart)
    {
        $this->campaignDateStart = $campaignDateStart;
    
        return $this;
    }

    /**
     * Get campaignDateStart
     *
     * @return \DateTime 
     */
    public function getCampaignDateStart()
    {
        return $this->campaignDateStart;
    }

    /**
     * Set campaignDateEnd
     *
     * @param \DateTime $campaignDateEnd
     * @return Campaign
     */
    public function setCampaignDateEnd($campaignDateEnd)
    {
        $this->campaignDateEnd = $campaignDateEnd;
    
        return $this;
    }

    /**
     * Get campaignDateEnd
     *
     * @return \DateTime 
     */
    public function getCampaignDateEnd()
    {
        return $this->campaignDateEnd;
    }

    /**
     * Set affinity
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Affinity $affinity
     * @return Campaign
     */
    public function setAffinity(\Cyclogram\Bundle\ProofPilotBundle\Entity\Affinity $affinity = null)
    {
        $this->affinity = $affinity;
    
        return $this;
    }

    /**
     * Get affinity
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Affinity 
     */
    public function getAffinity()
    {
        return $this->affinity;
    }

    /**
     * Set campaignType
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\CampaignType $campaignType
     * @return Campaign
     */
    public function setCampaignType(\Cyclogram\Bundle\ProofPilotBundle\Entity\CampaignType $campaignType = null)
    {
        $this->campaignType = $campaignType;
    
        return $this;
    }

    /**
     * Get campaignType
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\CampaignType 
     */
    public function getCampaignType()
    {
        return $this->campaignType;
    }

    /**
     * Set placement
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Placement $placement
     * @return Campaign
     */
    public function setPlacement(\Cyclogram\Bundle\ProofPilotBundle\Entity\Placement $placement = null)
    {
        $this->placement = $placement;
    
        return $this;
    }

    /**
     * Get placement
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Placement 
     */
    public function getPlacement()
    {
        return $this->placement;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return Campaign
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