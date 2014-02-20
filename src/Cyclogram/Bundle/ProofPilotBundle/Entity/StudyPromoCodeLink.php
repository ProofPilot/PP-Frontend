<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StudyPromoCodeLink
 *
 * @ORM\Table(name="study_promo_code_link")
 * @ORM\Entity
 */
class StudyPromoCodeLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="study_promo_code_link_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $studyPromoCodeLinkId;

    /**
     * @var \PromoCode
     *
     * @ORM\ManyToOne(targetEntity="PromoCode")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="promo_code_id", referencedColumnName="promo_code_id")
     * })
     */
    private $promoCode;

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
     * Get studyPromoCodeLinkId
     *
     * @return integer 
     */
    public function getStudyPromoCodeLinkId()
    {
        return $this->studyPromoCodeLinkId;
    }

    /**
     * Set promoCode
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\PromoCode $promoCode
     * @return StudyPromoCodeLink
     */
    public function setPromoCode(\Cyclogram\Bundle\ProofPilotBundle\Entity\PromoCode $promoCode = null)
    {
        $this->promoCode = $promoCode;
    
        return $this;
    }

    /**
     * Get promoCode
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\PromoCode 
     */
    public function getPromoCode()
    {
        return $this->promoCode;
    }

    /**
     * Set study
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study
     * @return StudyPromoCodeLink
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