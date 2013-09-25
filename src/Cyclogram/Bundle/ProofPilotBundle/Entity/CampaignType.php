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
 * CampaignType
 *
 * @ORM\Table(name="campaign_type")
 * @ORM\Entity
 */
class CampaignType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="campaign_type_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $campaignTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="campaign_type_name", type="string", length=45, nullable=false)
     */
    private $campaignTypeName;

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
     * Get campaignTypeId
     *
     * @return integer 
     */
    public function getCampaignTypeId()
    {
        return $this->campaignTypeId;
    }

    /**
     * Set campaignTypeName
     *
     * @param string $campaignTypeName
     * @return CampaignType
     */
    public function setCampaignTypeName($campaignTypeName)
    {
        $this->campaignTypeName = $campaignTypeName;
    
        return $this;
    }

    /**
     * Get campaignTypeName
     *
     * @return string 
     */
    public function getCampaignTypeName()
    {
        return $this->campaignTypeName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return CampaignType
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