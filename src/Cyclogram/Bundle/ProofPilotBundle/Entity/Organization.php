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

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

use Cyclogram\Bundle\ProofPilotBundle\Entity\StudyOrganizationLink;

/**
 * Organization
 *
 * @ORM\Table(name="organization")
 * @ORM\Entity
 */
class Organization
{
    const STATUS_ACTIVE =1;
    /**
     * @var integer
     *
     * @ORM\Column(name="organization_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $organizationId;

    /**
     * @var string
     *
     * @ORM\Column(name="organization_name", type="string", length=45, nullable=false)
     */
    private $organizationName;

    /**
     * @var string
     *
     * @ORM\Column(name="organization_address1", type="string", length=100, nullable=true)
     */
    private $organizationAddress1;

    /**
     * @var string
     *
     * @ORM\Column(name="organization_address2", type="string", length=100, nullable=true)
     */
    private $organizationAddress2;

    /**
     * @var string
     *
     * @ORM\Column(name="organization_zipcode", type="string", length=10, nullable=false)
     */
    private $organizationZipcode;

    /**
     * @var string
     *
     * @ORM\Column(name="organization_contact_firstname", type="string", length=45, nullable=true)
     */
    private $organizationContactFirstname;

    /**
     * @var string
     *
     * @ORM\Column(name="organization_contact_lastname", type="string", length=45, nullable=true)
     */
    private $organizationContactLastname;

    /**
     * @var string
     *
     * @ORM\Column(name="organization_contact_email", type="string", length=255, nullable=true)
     */
    private $organizationContactEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="organization_contact_phone1", type="string", length=15, nullable=true)
     */
    private $organizationContactPhone1;

    /**
     * @var string
     *
     * @ORM\Column(name="organization_contact_phone2", type="string", length=15, nullable=true)
     */
    private $organizationContactPhone2;

    /**
     * @var \City
     *
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="city_city_id", referencedColumnName="city_id")
     * })
     */
    private $cityCity;

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
     * @ORM\OneToMany(targetEntity="Site", mappedBy="organization")
     * @var unknown_type
     * @var unknown_type
     */
    private $sites;
    
    
    
    /**
     * @ORM\OneToMany(targetEntity="StudyOrganizationLink", mappedBy="organization")
     * @var unknown_type
     */
    private $studyOrganizationLinks;
    
    
    public function __construct() {
        $this->studyOrganizationLinks = new ArrayCollection();
    }


    /**
     * Get organizationId
     *
     * @return integer 
     */
    public function getOrganizationId()
    {
        return $this->organizationId;
    }

    /**
     * Set organizationName
     *
     * @param string $organizationName
     * @return Organization
     */
    public function setOrganizationName($organizationName)
    {
        $this->organizationName = $organizationName;
    
        return $this;
    }

    /**
     * Get organizationName
     *
     * @return string 
     */
    public function getOrganizationName()
    {
        return $this->organizationName;
    }

    /**
     * Set organizationAddress1
     *
     * @param string $organizationAddress1
     * @return Organization
     */
    public function setOrganizationAddress1($organizationAddress1)
    {
        $this->organizationAddress1 = $organizationAddress1;
    
        return $this;
    }

    /**
     * Get organizationAddress1
     *
     * @return string 
     */
    public function getOrganizationAddress1()
    {
        return $this->organizationAddress1;
    }

    /**
     * Set organizationAddress2
     *
     * @param string $organizationAddress2
     * @return Organization
     */
    public function setOrganizationAddress2($organizationAddress2)
    {
        $this->organizationAddress2 = $organizationAddress2;
    
        return $this;
    }

    /**
     * Get organizationAddress2
     *
     * @return string 
     */
    public function getOrganizationAddress2()
    {
        return $this->organizationAddress2;
    }

    /**
     * Set organizationZipcode
     *
     * @param string $organizationZipcode
     * @return Organization
     */
    public function setOrganizationZipcode($organizationZipcode)
    {
        $this->organizationZipcode = $organizationZipcode;
    
        return $this;
    }

    /**
     * Get organizationZipcode
     *
     * @return string 
     */
    public function getOrganizationZipcode()
    {
        return $this->organizationZipcode;
    }

    /**
     * Set organizationContactFirstname
     *
     * @param string $organizationContactFirstname
     * @return Organization
     */
    public function setOrganizationContactFirstname($organizationContactFirstname)
    {
        $this->organizationContactFirstname = $organizationContactFirstname;
    
        return $this;
    }

    /**
     * Get organizationContactFirstname
     *
     * @return string 
     */
    public function getOrganizationContactFirstname()
    {
        return $this->organizationContactFirstname;
    }

    /**
     * Set organizationContactLastname
     *
     * @param string $organizationContactLastname
     * @return Organization
     */
    public function setOrganizationContactLastname($organizationContactLastname)
    {
        $this->organizationContactLastname = $organizationContactLastname;
    
        return $this;
    }

    /**
     * Get organizationContactLastname
     *
     * @return string 
     */
    public function getOrganizationContactLastname()
    {
        return $this->organizationContactLastname;
    }

    /**
     * Set organizationContactEmail
     *
     * @param string $organizationContactEmail
     * @return Organization
     */
    public function setOrganizationContactEmail($organizationContactEmail)
    {
        $this->organizationContactEmail = $organizationContactEmail;
    
        return $this;
    }

    /**
     * Get organizationContactEmail
     *
     * @return string 
     */
    public function getOrganizationContactEmail()
    {
        return $this->organizationContactEmail;
    }

    /**
     * Set organizationContactPhone1
     *
     * @param string $organizationContactPhone1
     * @return Organization
     */
    public function setOrganizationContactPhone1($organizationContactPhone1)
    {
        $this->organizationContactPhone1 = $organizationContactPhone1;
    
        return $this;
    }

    /**
     * Get organizationContactPhone1
     *
     * @return string 
     */
    public function getOrganizationContactPhone1()
    {
        return $this->organizationContactPhone1;
    }

    /**
     * Set organizationContactPhone2
     *
     * @param string $organizationContactPhone2
     * @return Organization
     */
    public function setOrganizationContactPhone2($organizationContactPhone2)
    {
        $this->organizationContactPhone2 = $organizationContactPhone2;
    
        return $this;
    }

    /**
     * Get organizationContactPhone2
     *
     * @return string 
     */
    public function getOrganizationContactPhone2()
    {
        return $this->organizationContactPhone2;
    }

    /**
     * Set cityCity
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\City $cityCity
     * @return Organization
     */
    public function setCityCity(\Cyclogram\Bundle\ProofPilotBundle\Entity\City $cityCity = null)
    {
        $this->cityCity = $cityCity;
    
        return $this;
    }

    /**
     * Get cityCity
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\City 
     */
    public function getCityCity()
    {
        return $this->cityCity;
    }

    /**
     * Set country
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Country $country
     * @return Organization
     */
    public function setCountry(\Cyclogram\Bundle\ProofPilotBundle\Entity\Country $country = null)
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
     * Set state
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\State $state
     * @return Organization
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
     * @return Organization
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
    	return $this->organizationName;
    }

    public function getStudyOrganizationLinks()
    {
        return $this->studyOrganizationLinks;
    }

    public function setStudyOrganizationLinks($studyOrganizationLinks)
    {
        $this->studyOrganizationLinks = $studyOrganizationLinks;
    }

    public function getSites()
    {
        return $this->sites;
    }

    public function setSites($sites)
    {
        $this->sites = $sites;
    }
}