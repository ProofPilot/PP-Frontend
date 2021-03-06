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
 * City
 *
 * @ORM\Table(name="city")
 * @ORM\Entity
 */
class City
{
    /**
     * @var integer
     *
     * @ORM\Column(name="city_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $cityId;

    /**
     * @var string
     *
     * @ORM\Column(name="city_name", type="string", length=45, nullable=false)
     */
    protected $cityName;

    /**
     * @var string
     *
     * @ORM\Column(name="city_zipcode", type="string", length=10, nullable=false)
     */
    protected $cityZipcode;

    /**
     * @var float
     *
     * @ORM\Column(name="city_latitude", type="float", nullable=false)
     */
    protected $cityLatitude;

    /**
     * @var float
     *
     * @ORM\Column(name="city_longitude", type="float", nullable=false)
     */
    protected $cityLongitude;

    /**
     * @var string
     *
     * @ORM\Column(name="city_county", type="string", length=50, nullable=false)
     */
    protected $cityCounty;

    /**
     * @var \State
     *
     * @ORM\ManyToOne(targetEntity="State")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="state_id", referencedColumnName="state_id")
     * })
     */
    protected $state;



    /**
     * Get cityId
     *
     * @return integer 
     */
    public function getCityId()
    {
        return $this->cityId;
    }

    /**
     * Set cityName
     *
     * @param string $cityName
     * @return City
     */
    public function setCityName($cityName)
    {
        $this->cityName = $cityName;
    
        return $this;
    }

    /**
     * Get cityName
     *
     * @return string 
     */
    public function getCityName()
    {
        return $this->cityName;
    }

    /**
     * Set cityZipcode
     *
     * @param string $cityZipcode
     * @return City
     */
    public function setCityZipcode($cityZipcode)
    {
        $this->cityZipcode = $cityZipcode;
    
        return $this;
    }

    /**
     * Get cityZipcode
     *
     * @return string 
     */
    public function getCityZipcode()
    {
        return $this->cityZipcode;
    }

    /**
     * Set cityLatitude
     *
     * @param float $cityLatitude
     * @return City
     */
    public function setCityLatitude($cityLatitude)
    {
        $this->cityLatitude = $cityLatitude;
    
        return $this;
    }

    /**
     * Get cityLatitude
     *
     * @return float 
     */
    public function getCityLatitude()
    {
        return $this->cityLatitude;
    }

    /**
     * Set cityLongitude
     *
     * @param float $cityLongitude
     * @return City
     */
    public function setCityLongitude($cityLongitude)
    {
        $this->cityLongitude = $cityLongitude;
    
        return $this;
    }

    /**
     * Get cityLongitude
     *
     * @return float 
     */
    public function getCityLongitude()
    {
        return $this->cityLongitude;
    }

    /**
     * Set cityCounty
     *
     * @param string $cityCounty
     * @return City
     */
    public function setCityCounty($cityCounty)
    {
        $this->cityCounty = $cityCounty;
    
        return $this;
    }

    /**
     * Get cityCounty
     *
     * @return string 
     */
    public function getCityCounty()
    {
        return $this->cityCounty;
    }

    /**
     * Set state
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\State $state
     * @return City
     */
    public function setState(\Cyclogram\Bundle\ProofPilotBundle\Entity\State $state = null)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get state
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\State 
     */
    public function getState()
    {
        return $this->state;
    }
    
    public function __toString()
    {
    	return $this->cityName;
    }
}