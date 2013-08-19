<?php
namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CampaignSiteLink
 *
 * @ORM\Table(name="campaign_site_link")
 * @ORM\Entity(repositoryClass="Cyclogram\Bundle\ProofPilotBundle\Repository\CampaignSiteLinkRepository")
 */
class CampaignSiteLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="campaign_site_link_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $campaignSiteLinkId;

    /**
     * @var \Campaign
     *
     * @ORM\ManyToOne(targetEntity="Campaign")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="campaign_id", referencedColumnName="campaign_id")
     * })
     */
    private $campaign;

    /**
     * @var \Site
     *
     * @ORM\ManyToOne(targetEntity="Site")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="site_id", referencedColumnName="site_id")
     * })
     */
    private $site;

    public function getCampaignSiteLinkId()
    {
        return $this->campaignSiteLinkId;
    }

    public function setCampaignSiteLinkId($campaignSiteLinkId)
    {
        $this->campaignSiteLinkId = $campaignSiteLinkId;
    }

    /**
     * Set campaign
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Campaign $campaign
     * @return Campaign
     */
    public function setCampaign(\Cyclogram\Bundle\ProofPilotBundle\Entity\Campaign $campaign = null)
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
     * Set site
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Site $site
     * @return Site
     */
    public function setSite(\Cyclogram\Bundle\ProofPilotBundle\Entity\Site $site = null)
    {
        $this->site = $site;
    
        return $this;
    }
    
    /**
     * Get site
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Site
     */
    public function getSite()
    {
        return $this->site;
    }
}
