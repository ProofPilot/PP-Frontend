<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PromoCodeContent
 *
 * @ORM\Table(name="promo_code_content")
 * @ORM\Entity
 */
class PromoCodeContent
{
    /**
     * @var integer
     *
     * @ORM\Column(name="language_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $languageId;

    /**
     * @var string
     *
     * @ORM\Column(name="promo_code_content_title", type="string", length=255, nullable=true)
     */
    private $promoCodeContentTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="promo_code_content_unlock_message", type="string", length=2000, nullable=true)
     */
    private $promoCodeContentUnlockMessage;

    /**
     * @var string
     *
     * @ORM\Column(name="promo_code_content_url_for_unlock", type="string", length=500, nullable=true)
     */
    private $promoCodeContentUrlForUnlock;

    /**
     * @var string
     *
     * @ORM\Column(name="promo_code_content_unlock_share_msg", type="string", length=2000, nullable=true)
     */
    private $promoCodeContentUnlockShareMsg;

    /**
     * @var \PromoCode
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="PromoCode")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="promo_code_id", referencedColumnName="promo_code_id")
     * })
     */
    private $promoCode;



    /**
     * Set languageId
     *
     * @param integer $languageId
     * @return PromoCodeContent
     */
    public function setLanguageId($languageId)
    {
        $this->languageId = $languageId;
    
        return $this;
    }

    /**
     * Get languageId
     *
     * @return integer 
     */
    public function getLanguageId()
    {
        return $this->languageId;
    }

    /**
     * Set promoCodeContentTitle
     *
     * @param string $promoCodeContentTitle
     * @return PromoCodeContent
     */
    public function setPromoCodeContentTitle($promoCodeContentTitle)
    {
        $this->promoCodeContentTitle = $promoCodeContentTitle;
    
        return $this;
    }

    /**
     * Get promoCodeContentTitle
     *
     * @return string 
     */
    public function getPromoCodeContentTitle()
    {
        return $this->promoCodeContentTitle;
    }

    /**
     * Set promoCodeContentUnlockMessage
     *
     * @param string $promoCodeContentUnlockMessage
     * @return PromoCodeContent
     */
    public function setPromoCodeContentUnlockMessage($promoCodeContentUnlockMessage)
    {
        $this->promoCodeContentUnlockMessage = $promoCodeContentUnlockMessage;
    
        return $this;
    }

    /**
     * Get promoCodeContentUnlockMessage
     *
     * @return string 
     */
    public function getPromoCodeContentUnlockMessage()
    {
        return $this->promoCodeContentUnlockMessage;
    }

    /**
     * Set promoCodeContentUrlForUnlock
     *
     * @param string $promoCodeContentUrlForUnlock
     * @return PromoCodeContent
     */
    public function setPromoCodeContentUrlForUnlock($promoCodeContentUrlForUnlock)
    {
        $this->promoCodeContentUrlForUnlock = $promoCodeContentUrlForUnlock;
    
        return $this;
    }

    /**
     * Get promoCodeContentUrlForUnlock
     *
     * @return string 
     */
    public function getPromoCodeContentUrlForUnlock()
    {
        return $this->promoCodeContentUrlForUnlock;
    }

    /**
     * Set promoCodeContentUnlockShareMsg
     *
     * @param string $promoCodeContentUnlockShareMsg
     * @return PromoCodeContent
     */
    public function setPromoCodeContentUnlockShareMsg($promoCodeContentUnlockShareMsg)
    {
        $this->promoCodeContentUnlockShareMsg = $promoCodeContentUnlockShareMsg;
    
        return $this;
    }

    /**
     * Get promoCodeContentUnlockShareMsg
     *
     * @return string 
     */
    public function getPromoCodeContentUnlockShareMsg()
    {
        return $this->promoCodeContentUnlockShareMsg;
    }

    /**
     * Set promoCode
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\PromoCode $promoCode
     * @return PromoCodeContent
     */
    public function setPromoCode(\Cyclogram\Bundle\ProofPilotBundle\Entity\PromoCode $promoCode)
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
}