<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PromoCodeInterventionLink
 *
 * @ORM\Table(name="promo_code_intervention_link")
 * @ORM\Entity
 */
class PromoCodeInterventionLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="promo_code_intervention_link_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $promoCodeInterventionLinkId;

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
     * @var \Intervention
     *
     * @ORM\ManyToOne(targetEntity="Intervention")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="intervention_id", referencedColumnName="intervention_id")
     * })
     */
    private $intervention;



    /**
     * Get promoCodeInterventionLinkId
     *
     * @return integer 
     */
    public function getPromoCodeInterventionLinkId()
    {
        return $this->promoCodeInterventionLinkId;
    }

    /**
     * Set promoCode
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\PromoCode $promoCode
     * @return PromoCodeInterventionLink
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
     * Set intervention
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Intervention $intervention
     * @return PromoCodeInterventionLink
     */
    public function setIntervention(\Cyclogram\Bundle\ProofPilotBundle\Entity\Intervention $intervention = null)
    {
        $this->intervention = $intervention;
    
        return $this;
    }

    /**
     * Get intervention
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Intervention 
     */
    public function getIntervention()
    {
        return $this->intervention;
    }
}