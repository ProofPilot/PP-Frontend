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
 * Individual
 *
 * @ORM\Table(name="individual")
 * @ORM\Entity
 */
class Individual
{
    const STATUS_ACTIVE = 1;
    /**
     * @var integer
     *
     * @ORM\Column(name="individual_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $individualId;

    /**
     * @var string
     *
     * @ORM\Column(name="individual_firstname", type="string", length=45, nullable=true)
     */
    private $individualFirstname;

    /**
     * @var string
     *
     * @ORM\Column(name="individual_lastname", type="string", length=45, nullable=true)
     */
    private $individualLastname;

    /**
     * @var string
     *
     * @ORM\Column(name="individual_address1", type="string", length=100, nullable=true)
     */
    private $individualAddress1;

    /**
     * @var string
     *
     * @ORM\Column(name="individual_address2", type="string", length=100, nullable=true)
     */
    private $individualAddress2;

    /**
     * @var string
     *
     * @ORM\Column(name="individual_zipcode", type="string", length=10, nullable=true)
     */
    private $individualZipcode;

    /**
     * @var string
     *
     * @ORM\Column(name="individual_contact_firstname", type="string", length=45, nullable=true)
     */
    private $individualContactFirstname;

    /**
     * @var string
     *
     * @ORM\Column(name="individual_contact_lastname", type="string", length=45, nullable=true)
     */
    private $individualContactLastname;

    /**
     * @var string
     *
     * @ORM\Column(name="individual_contact_email", type="string", length=45, nullable=true)
     */
    private $individualContactEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="individual_contact_phone1", type="string", length=45, nullable=true)
     */
    private $individualContactPhone1;

    /**
     * @var string
     *
     * @ORM\Column(name="individual_contact_phone2", type="string", length=45, nullable=true)
     */
    private $individualContactPhone2;

    /**
     * @var \City
     *
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="city_id", referencedColumnName="city_id")
     * })
     */
    private $city;

    /**
     * @var \Country
     *
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="country_country_id", referencedColumnName="country_id")
     * })
     */
    private $countryCountry;

    /**
     * @var \IndividualTitle
     *
     * @ORM\ManyToOne(targetEntity="IndividualTitle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="individual_title_id", referencedColumnName="individual_title_id")
     * })
     */
    private $individualTitle;

    /**
     * @var \State
     *
     * @ORM\ManyToOne(targetEntity="State")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="state_id", referencedColumnName="state_id")
     * })
     */
    private $state;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=false)
     */
    private $status;



    /**
     * Get individualId
     *
     * @return integer 
     */
    public function getIndividualId()
    {
        return $this->individualId;
    }

    /**
     * Set individualFirstname
     *
     * @param string $individualFirstname
     * @return Individual
     */
    public function setIndividualFirstname($individualFirstname)
    {
        $this->individualFirstname = $individualFirstname;
    
        return $this;
    }

    /**
     * Get individualFirstname
     *
     * @return string 
     */
    public function getIndividualFirstname()
    {
        return $this->individualFirstname;
    }

    /**
     * Set individualLastname
     *
     * @param string $individualLastname
     * @return Individual
     */
    public function setIndividualLastname($individualLastname)
    {
        $this->individualLastname = $individualLastname;
    
        return $this;
    }

    /**
     * Get individualLastname
     *
     * @return string 
     */
    public function getIndividualLastname()
    {
        return $this->individualLastname;
    }

    /**
     * Set individualAddress1
     *
     * @param string $individualAddress1
     * @return Individual
     */
    public function setIndividualAddress1($individualAddress1)
    {
        $this->individualAddress1 = $individualAddress1;
    
        return $this;
    }

    /**
     * Get individualAddress1
     *
     * @return string 
     */
    public function getIndividualAddress1()
    {
        return $this->individualAddress1;
    }

    /**
     * Set individualAddress2
     *
     * @param string $individualAddress2
     * @return Individual
     */
    public function setIndividualAddress2($individualAddress2)
    {
        $this->individualAddress2 = $individualAddress2;
    
        return $this;
    }

    /**
     * Get individualAddress2
     *
     * @return string 
     */
    public function getIndividualAddress2()
    {
        return $this->individualAddress2;
    }

    /**
     * Set individualZipcode
     *
     * @param string $individualZipcode
     * @return Individual
     */
    public function setIndividualZipcode($individualZipcode)
    {
        $this->individualZipcode = $individualZipcode;
    
        return $this;
    }

    /**
     * Get individualZipcode
     *
     * @return string 
     */
    public function getIndividualZipcode()
    {
        return $this->individualZipcode;
    }

    /**
     * Set individualContactFirstname
     *
     * @param string $individualContactFirstname
     * @return Individual
     */
    public function setIndividualContactFirstname($individualContactFirstname)
    {
        $this->individualContactFirstname = $individualContactFirstname;
    
        return $this;
    }

    /**
     * Get individualContactFirstname
     *
     * @return string 
     */
    public function getIndividualContactFirstname()
    {
        return $this->individualContactFirstname;
    }

    /**
     * Set individualContactLastname
     *
     * @param string $individualContactLastname
     * @return Individual
     */
    public function setIndividualContactLastname($individualContactLastname)
    {
        $this->individualContactLastname = $individualContactLastname;
    
        return $this;
    }

    /**
     * Get individualContactLastname
     *
     * @return string 
     */
    public function getIndividualContactLastname()
    {
        return $this->individualContactLastname;
    }

    /**
     * Set individualContactEmail
     *
     * @param string $individualContactEmail
     * @return Individual
     */
    public function setIndividualContactEmail($individualContactEmail)
    {
        $this->individualContactEmail = $individualContactEmail;
    
        return $this;
    }

    /**
     * Get individualContactEmail
     *
     * @return string 
     */
    public function getIndividualContactEmail()
    {
        return $this->individualContactEmail;
    }

    /**
     * Set individualContactPhone1
     *
     * @param string $individualContactPhone1
     * @return Individual
     */
    public function setIndividualContactPhone1($individualContactPhone1)
    {
        $this->individualContactPhone1 = $individualContactPhone1;
    
        return $this;
    }

    /**
     * Get individualContactPhone1
     *
     * @return string 
     */
    public function getIndividualContactPhone1()
    {
        return $this->individualContactPhone1;
    }

    /**
     * Set individualContactPhone2
     *
     * @param string $individualContactPhone2
     * @return Individual
     */
    public function setIndividualContactPhone2($individualContactPhone2)
    {
        $this->individualContactPhone2 = $individualContactPhone2;
    
        return $this;
    }

    /**
     * Get individualContactPhone2
     *
     * @return string 
     */
    public function getIndividualContactPhone2()
    {
        return $this->individualContactPhone2;
    }

    /**
     * Set city
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\City $city
     * @return Individual
     */
    public function setCity(\Cyclogram\Bundle\ProofPilotBundle\Entity\City $city = null)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\City 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set countryCountry
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Country $countryCountry
     * @return Individual
     */
    public function setCountryCountry(\Cyclogram\Bundle\ProofPilotBundle\Entity\Country $countryCountry = null)
    {
        $this->countryCountry = $countryCountry;
    
        return $this;
    }

    /**
     * Get countryCountry
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Country 
     */
    public function getCountryCountry()
    {
        return $this->countryCountry;
    }

    /**
     * Set individualTitle
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\IndividualTitle $individualTitle
     * @return Individual
     */
    public function setIndividualTitle(\Cyclogram\Bundle\ProofPilotBundle\Entity\IndividualTitle $individualTitle = null)
    {
        $this->individualTitle = $individualTitle;
    
        return $this;
    }

    /**
     * Get individualTitle
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\IndividualTitle 
     */
    public function getIndividualTitle()
    {
        return $this->individualTitle;
    }

    /**
     * Set state
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\State $state
     * @return Individual
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

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return Individual
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
    
    public function __toString() {
    	return $this->individualFirstname . ' ' . $this->individualLastname;
    }
}