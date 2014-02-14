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
 * Location
 *
 * @ORM\Table(name="location")
 * @ORM\Entity
 */
class Location
{
    const STATUS_ACTIVE = 1;
    /**
     * @var integer
     *
     * @ORM\Column(name="location_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $locationId;

    /**
     * @var string
     *
     * @ORM\Column(name="location_name", type="string", length=45, nullable=false)
     */
    private $locationName;

    /**
     * @var float
     *
     * @ORM\Column(name="location_latitude", type="float", nullable=true)
     */
    private $locationLatitude;

    /**
     * @var float
     *
     * @ORM\Column(name="location_longitude", type="float", nullable=true)
     */
    private $locationLongitude;

    /**
     * @var string
     *
     * @ORM\Column(name="location_zipcode", type="string", length=10, nullable=false)
     */
    private $locationZipcode;

    /**
     * @var string
     *
     * @ORM\Column(name="location_address1", type="string", length=100, nullable=false)
     */
    private $locationAddress1;

    /**
     * @var string
     *
     * @ORM\Column(name="location_address2", type="string", length=100, nullable=true)
     */
    private $locationAddress2;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $locationUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="operation_hours", type="string", length=255, nullable=true)
     */
    private $operationHours;

    /**
     * @var string
     *
     * @ORM\Column(name="services", type="text",nullable=true)
     */
    private $locationService;
    /**
     * @var \Country
     *
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="country_id", referencedColumnName="country_id")
     * })
     */
    private $country;

    /**
     * @var \LocationType
     *
     * @ORM\ManyToOne(targetEntity="LocationType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="location_type_id", referencedColumnName="location_type_id")
     * })
     */
    private $locationType;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=false)
     */
    private $status;

    /**
     * Get locationId
     *
     * @return integer 
     */
    public function getLocationId()
    {
        return $this->locationId;
    }

    /**
     * Set locationName
     *
     * @param string $locationName
     * @return Location
     */
    public function setLocationName($locationName)
    {
        $this->locationName = $locationName;

        return $this;
    }

    /**
     * Get locationName
     *
     * @return string 
     */
    public function getLocationName()
    {
        return $this->locationName;
    }

    /**
     * Set locationLatitude
     *
     * @param float $locationLatitude
     * @return Location
     */
    public function setLocationLatitude($locationLatitude)
    {
        $this->locationLatitude = $locationLatitude;

        return $this;
    }

    /**
     * Get locationLatitude
     *
     * @return float 
     */
    public function getLocationLatitude()
    {
        return $this->locationLatitude;
    }

    /**
     * Set locationLongitude
     *
     * @param float $locationLongitude
     * @return Location
     */
    public function setLocationLongitude($locationLongitude)
    {
        $this->locationLongitude = $locationLongitude;

        return $this;
    }

    /**
     * Get locationLongitude
     *
     * @return float 
     */
    public function getLocationLongitude()
    {
        return $this->locationLongitude;
    }

    /**
     * Set locationZipcode
     *
     * @param string $locationZipcode
     * @return Location
     */
    public function setLocationZipcode($locationZipcode)
    {
        $this->locationZipcode = $locationZipcode;

        return $this;
    }

    /**
     * Get locationZipcode
     *
     * @return string 
     */
    public function getLocationZipcode()
    {
        return $this->locationZipcode;
    }

    /**
     * Set locationAddress1
     *
     * @param string $locationAddress1
     * @return Location
     */
    public function setLocationAddress1($locationAddress1)
    {
        $this->locationAddress1 = $locationAddress1;

        return $this;
    }

    /**
     * Get locationAddress1
     *
     * @return string 
     */
    public function getLocationAddress1()
    {
        return $this->locationAddress1;
    }

    /**
     * Set locationAddress2
     *
     * @param string $locationAddress2
     * @return Location
     */
    public function setLocationAddress2($locationAddress2)
    {
        $this->locationAddress2 = $locationAddress2;

        return $this;
    }

    /**
     * Get locationAddress2
     *
     * @return string 
     */
    public function getLocationAddress2()
    {
        return $this->locationAddress2;
    }

    /**
     * Set country
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Country $country
     * @return Location
     */
    public function setCountry(
            \Cyclogram\Bundle\ProofPilotBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set locationType
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\LocationType $locationType
     * @return Location
     */
    public function setLocationType(
            \Cyclogram\Bundle\ProofPilotBundle\Entity\LocationType $locationType = null)
    {
        $this->locationType = $locationType;

        return $this;
    }

    /**
     * Get locationType
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\LocationType 
     */
    public function getLocationType()
    {
        return $this->locationType;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return Location
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
        return $this->locationName;
    }

    public function getLocationUrl()
    {
        return $this->locationUrl;
    }

    public function setLocationUrl($locationUrl)
    {
        $this->locationUrl = $locationUrl;
    }

    public function getOperationHours()
    {
        return $this->operationHours;
    }

    public function setOperationHours($operationHours)
    {
        $this->operationHours = $operationHours;
    }

    public function getLocationService()
    {
        return $this->locationService;
    }

    public function setLocationService($locationService)
    {
        $this->locationService = $locationService;
    }

}
