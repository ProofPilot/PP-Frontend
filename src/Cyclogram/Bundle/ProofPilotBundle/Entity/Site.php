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
 * Site
 *
 * @ORM\Table(name="site")
 * @ORM\Entity
 */
class Site
{
    const STATUS_ACTIVE =1;
    /**
     * @var integer
     *
     * @ORM\Column(name="site_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $siteId;

    /**
     * @var string
     *
     * @ORM\Column(name="site_name", type="string", length=45, nullable=false)
     */
    private $siteName;

    /**
     * @var string
     *
     * @ORM\Column(name="site_url", type="string", length=255, nullable=true)
     */
    private $siteUrl;

    /**
     * @var boolean
     *
     * @ORM\Column(name="site_default", type="boolean", nullable=false)
     */
    private $siteDefault;

    /**
     * @var \Organization
     *
     * @ORM\ManyToOne(targetEntity="Organization", inversedBy="sites")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="organization_id", referencedColumnName="organization_id")
     * })
     */
    private $organization;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=false)
     */
    private $status;



    /**
     * Get siteId
     *
     * @return integer 
     */
    public function getSiteId()
    {
        return $this->siteId;
    }

    /**
     * Set siteName
     *
     * @param string $siteName
     * @return Site
     */
    public function setSiteName($siteName)
    {
        $this->siteName = $siteName;
    
        return $this;
    }

    /**
     * Get siteName
     *
     * @return string 
     */
    public function getSiteName()
    {
        return $this->siteName;
    }

    /**
     * Set siteUrl
     *
     * @param string $siteUrl
     * @return Site
     */
    public function setSiteUrl($siteUrl)
    {
        $this->siteUrl = $siteUrl;
    
        return $this;
    }

    /**
     * Get siteUrl
     *
     * @return string 
     */
    public function getSiteUrl()
    {
        return $this->siteUrl;
    }

    /**
     * Set siteDefault
     *
     * @param boolean $siteDefault
     * @return Site
     */
    public function setSiteDefault($siteDefault)
    {
        $this->siteDefault = $siteDefault;
    
        return $this;
    }

    /**
     * Get siteDefault
     *
     * @return boolean 
     */
    public function getSiteDefault()
    {
        return $this->siteDefault;
    }

    /**
     * Set organization
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Organization $organization
     * @return Site
     */
    public function setOrganization(\Cyclogram\Bundle\ProofPilotBundle\Entity\Organization $organization = null)
    {
        $this->organization = $organization;
    
        return $this;
    }

    /**
     * Get organization
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Organization 
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return Site
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
}