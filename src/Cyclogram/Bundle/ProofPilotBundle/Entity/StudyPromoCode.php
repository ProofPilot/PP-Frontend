<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StudyPromoCode
 *
 * @ORM\Table(name="study_promo_code")
 * @ORM\Entity
 */
class StudyPromoCode
{
    /**
     * @var integer
     *
     * @ORM\Column(name="study_promo_code_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $studyPromoCodeId;

    /**
     * @var string
     *
     * @ORM\Column(name="study_promo_code_value", type="string", length=45, nullable=false)
     */
    private $studyPromoCodeValue;

    /**
     * @var integer
     *
     * @ORM\Column(name="study_promo_code_amount", type="integer", nullable=false)
     */
    private $studyPromoCodeAmount;

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
     * Get studyPromoCodeId
     *
     * @return integer 
     */
    public function getStudyPromoCodeId()
    {
        return $this->studyPromoCodeId;
    }

    /**
     * Set studyPromoCodeValue
     *
     * @param string $studyPromoCodeValue
     * @return StudyPromoCode
     */
    public function setStudyPromoCodeValue($studyPromoCodeValue)
    {
        $this->studyPromoCodeValue = $studyPromoCodeValue;
    
        return $this;
    }

    /**
     * Get studyPromoCodeValue
     *
     * @return string 
     */
    public function getStudyPromoCodeValue()
    {
        return $this->studyPromoCodeValue;
    }

    /**
     * Set studyPromoCodeAmount
     *
     * @param integer $studyPromoCodeAmount
     * @return StudyPromoCode
     */
    public function setStudyPromoCodeAmount($studyPromoCodeAmount)
    {
        $this->studyPromoCodeAmount = $studyPromoCodeAmount;
    
        return $this;
    }

    /**
     * Get studyPromoCodeAmount
     *
     * @return integer 
     */
    public function getStudyPromoCodeAmount()
    {
        return $this->studyPromoCodeAmount;
    }

    /**
     * Set study
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study
     * @return StudyPromoCode
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
}