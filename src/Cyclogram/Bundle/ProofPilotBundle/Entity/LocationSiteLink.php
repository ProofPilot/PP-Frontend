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
 * LocationSiteLink
 *
 * @ORM\Table(name="location_site_link")
 * @ORM\Entity
 */
class LocationSiteLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="location_site_link_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $locationSiteLinkId;

    /**
     * @var \Location
     *
     * @ORM\ManyToOne(targetEntity="Location")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="location_id", referencedColumnName="location_id")
     * })
     */
    private $location;

    /**
     * @var \Organization
     *
     * @ORM\ManyToOne(targetEntity="Site")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="site_id", referencedColumnName="site_id")
     * })
     */
    private $site;



    /**
     * Get locationSiteLinkId
     *
     * @return integer 
     */
    public function getLocationSiteLinkId()
    {
        return $this->locationSiteLinkId;
    }

    /**
     * Set location
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Location $location
     * @return LocationSiteLink
     */
    public function setLocation(\Cyclogram\Bundle\ProofPilotBundle\Entity\Location $location = null)
    {
        $this->location = $location;
    
        return $this;
    }

    /**
     * Get location
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Location 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set site
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Site $site
     * @return LocationSiteLink
     */
    public function setSite(\Cyclogram\Bundle\ProofPilotBundle\Entity\Site $site = null)
    {
        $this->site = $site;
    
        return $this;
    }

    /**
     * Get organization
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Site 
     */
    public function getSite()
    {
        return $this->site;
    }
}