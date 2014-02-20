<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Code
 *
 * @ORM\Table(name="code")
 * @ORM\Entity(repositoryClass="Cyclogram\Bundle\ProofPilotBundle\Repository\CodeRepository")
 */
class Code
{
    
    const STATUS_UNUSED = 33;
    const STATUS_USED = 32;
    /**
     * @var integer
     *
     * @ORM\Column(name="code_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeId;

    /**
     * @var string
     *
     * @ORM\Column(name="code_value", type="string", length=45, nullable=true)
     */
    private $codeValue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="code_redeemed_datetime", type="datetime", nullable=true)
     */
    private $codeRedeemedDatetime;

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
     * @var \Status
     *
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="status_id")
     * })
     */
    private $status;

    /**
     * @var \Participant
     *
     * @ORM\ManyToOne(targetEntity="Participant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_redeemed_by_participant_id", referencedColumnName="participant_id")
     * })
     */
    private $codeRedeemedByParticipant;



    /**
     * Get codeId
     *
     * @return integer 
     */
    public function getCodeId()
    {
        return $this->codeId;
    }

    /**
     * Set codeValue
     *
     * @param string $codeValue
     * @return Code
     */
    public function setCodeValue($codeValue)
    {
        $this->codeValue = $codeValue;
    
        return $this;
    }

    /**
     * Get codeValue
     *
     * @return string 
     */
    public function getCodeValue()
    {
        return $this->codeValue;
    }

    /**
     * Set codeRedeemedDatetime
     *
     * @param \DateTime $codeRedeemedDatetime
     * @return Code
     */
    public function setCodeRedeemedDatetime($codeRedeemedDatetime)
    {
        $this->codeRedeemedDatetime = $codeRedeemedDatetime;
    
        return $this;
    }

    /**
     * Get codeRedeemedDatetime
     *
     * @return \DateTime 
     */
    public function getCodeRedeemedDatetime()
    {
        return $this->codeRedeemedDatetime;
    }

    /**
     * Set promoCode
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\PromoCode $promoCode
     * @return Code
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
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return Code
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

    /**
     * Set codeRedeemedByParticipant
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $codeRedeemedByParticipant
     * @return Code
     */
    public function setCodeRedeemedByParticipant(\Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $codeRedeemedByParticipant = null)
    {
        $this->codeRedeemedByParticipant = $codeRedeemedByParticipant;
    
        return $this;
    }

    /**
     * Get codeRedeemedByParticipant
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Participant 
     */
    public function getCodeRedeemedByParticipant()
    {
        return $this->codeRedeemedByParticipant;
    }
}