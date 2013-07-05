<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StudyCityLink
 *
 * @ORM\Table(name="study_city_link")
 * @ORM\Entity
 */
class StudyCityLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="study_city_link_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $studyCityLinkId;

    /**
     * @var \Study
     *
     * @ORM\ManyToOne(targetEntity="Study")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="study_id", referencedColumnName="study_id")
     * })
     */
    private $study;

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
     * Get studyCityLinkId
     *
     * @return integer 
     */
    public function getStudyCityLinkId()
    {
        return $this->studyCityLinkId;
    }

    /**
     * Set study
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study
     * @return StudyCityLink
     */
    public function setStudy(\Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study = null)
    {
        $this->study = $study;
    
        return $this;
    }

    /**
     * Get study
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Study 
     */
    public function getStudy()
    {
        return $this->study;
    }

    /**
     * Set city
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\City $city
     * @return StudyCityLink
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
}