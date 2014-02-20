<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PromoCode
 *
 * @ORM\Table(name="promo_code")
 * @ORM\Entity
 */
class PromoCode
{
    /**
     * @var integer
     *
     * @ORM\Column(name="promo_code_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $promoCodeId;

    /**
     * @var string
     *
     * @ORM\Column(name="promo_code_retailer", type="string", length=500, nullable=false)
     */
    protected $promoCodeRetailer;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="promo_code_expiration", type="datetime", nullable=true)
     */
    protected $promoCodeExpiration;

    /**
     * @var integer
     *
     * @ORM\Column(name="promo_code_issued", type="integer", nullable=true)
     */
    protected $promoCodeIssued;

    /**
     * @var integer
     *
     * @ORM\Column(name="promo_code_unused", type="integer", nullable=true)
     */
    protected $promoCodeUnused;

    /**
     * @var string
     *
     * @ORM\Column(name="promo_code_logo", type="string", length=255, nullable=true)
     */
    protected $promoCodeLogo;
    
    /**
     * @ORM\OneToMany(targetEntity="Code", mappedBy="promoCode")
     */
    protected $code;
    
    /**
     * @ORM\OneToMany(targetEntity="PromoCodeContent", mappedBy="promoCode")
     */
    protected $promoCodeContent;



    /**
     * Get promoCodeId
     *
     * @return integer 
     */
    public function getPromoCodeId()
    {
        return $this->promoCodeId;
    }

    /**
     * Set promoCodeRetailer
     *
     * @param string $promoCodeRetailer
     * @return PromoCode
     */
    public function setPromoCodeRetailer($promoCodeRetailer)
    {
        $this->promoCodeRetailer = $promoCodeRetailer;
    
        return $this;
    }

    /**
     * Get promoCodeRetailer
     *
     * @return string 
     */
    public function getPromoCodeRetailer()
    {
        return $this->promoCodeRetailer;
    }

    /**
     * Set promoCodeExpiration
     *
     * @param \DateTime $promoCodeExpiration
     * @return PromoCode
     */
    public function setPromoCodeExpiration($promoCodeExpiration)
    {
        $this->promoCodeExpiration = $promoCodeExpiration;
    
        return $this;
    }

    /**
     * Get promoCodeExpiration
     *
     * @return \DateTime 
     */
    public function getPromoCodeExpiration()
    {
        return $this->promoCodeExpiration;
    }

    /**
     * Set promoCodeIssued
     *
     * @param integer $promoCodeIssued
     * @return PromoCode
     */
    public function setPromoCodeIssued($promoCodeIssued)
    {
        $this->promoCodeIssued = $promoCodeIssued;
    
        return $this;
    }

    /**
     * Get promoCodeIssued
     *
     * @return integer 
     */
    public function getPromoCodeIssued()
    {
        return $this->promoCodeIssued;
    }

    /**
     * Set promoCodeUnused
     *
     * @param integer $promoCodeUnused
     * @return PromoCode
     */
    public function setPromoCodeUnused($promoCodeUnused)
    {
        $this->promoCodeUnused = $promoCodeUnused;
    
        return $this;
    }

    /**
     * Get promoCodeUnused
     *
     * @return integer 
     */
    public function getPromoCodeUnused()
    {
        return $this->promoCodeUnused;
    }

    /**
     * Set promoCodeLogo
     *
     * @param string $promoCodeLogo
     * @return PromoCode
     */
    public function setPromoCodeLogo($promoCodeLogo)
    {
        $this->promoCodeLogo = $promoCodeLogo;
    
        return $this;
    }

    /**
     * Get promoCodeLogo
     *
     * @return string 
     */
    public function getPromoCodeLogo()
    {
        return $this->promoCodeLogo;
    }
}