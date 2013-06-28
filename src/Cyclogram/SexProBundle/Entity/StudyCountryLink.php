<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StudyCountryLink
 *
 * @ORM\Table(name="study_country_link")
 * @ORM\Entity
 */
class StudyCountryLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="study_country_link_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $studyCountryLinkId;

    /**
     * @var \Study
     *
     * @ORM\ManyToOne(targetEntity="Study")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="study_study_id", referencedColumnName="study_id")
     * })
     */
    private $studyStudy;

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
     * Get studyCountryLinkId
     *
     * @return integer 
     */
    public function getStudyCountryLinkId()
    {
        return $this->studyCountryLinkId;
    }

    /**
     * Set studyStudy
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Study $studyStudy
     * @return StudyCountryLink
     */
    public function setStudyStudy(\Cyclogram\Bundle\ProofPilotBundle\Entity\Study $studyStudy = null)
    {
        $this->studyStudy = $studyStudy;
    
        return $this;
    }

    /**
     * Get studyStudy
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Study 
     */
    public function getStudyStudy()
    {
        return $this->studyStudy;
    }

    /**
     * Set country
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Country $country
     * @return StudyCountryLink
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
}