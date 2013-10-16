<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TemporaryAccessCode
 *
 * @ORM\Table(name="temporary_access_code")
 * @ORM\Entity
 */
class TemporaryAccessCode
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="sms_code", type="string", length=4, nullable=false)
     */
    private $smsCode;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="temporary_access_code_timestamp", type="datetime", nullable=true)
     */
    private $temporaryAccessCodeTimestamp;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set smsCode
     *
     * @param string $smsCode
     * @return TemporaryAccessCode
     */
    public function setSmsCode($smsCode)
    {
        $this->smsCode = $smsCode;
    
        return $this;
    }

    /**
     * Get smsCode
     *
     * @return string 
     */
    public function getSmsCode()
    {
        return $this->smsCode;
    }

    /**
     * Set temporaryAccessCodeTimestamp
     *
     * @param \DateTime $temporaryAccessCodeTimestamp
     * @return TemporaryAccessCode
     */
    public function setTemporaryAccessCodeTimestamp($temporaryAccessCodeTimestamp)
    {
        $this->temporaryAccessCodeTimestamp = $temporaryAccessCodeTimestamp;
    
        return $this;
    }

    /**
     * Get temporaryAccessCodeTimestamp
     *
     * @return \DateTime 
     */
    public function getTemporaryAccessCodeTimestamp()
    {
        return $this->temporaryAccessCodeTimestamp;
    }
}