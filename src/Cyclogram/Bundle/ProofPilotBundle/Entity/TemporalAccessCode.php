<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TemporalAccessCode
 *
 * @ORM\Table(name="temporal_access_code")
 * @ORM\Entity
 */
class TemporalAccessCode
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
     * @ORM\Column(name="temporal_access_code", type="datetime", nullable=true)
     */
    private $temporalAccessCode;



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
     * @return TemporalAccessCode
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
     * Set temporalAccessCode
     *
     * @param \DateTime $temporalAccessCode
     * @return TemporalAccessCode
     */
    public function setTemporalAccessCode($temporalAccessCode)
    {
        $this->temporalAccessCode = $temporalAccessCode;
    
        return $this;
    }

    /**
     * Get temporalAccessCode
     *
     * @return \DateTime 
     */
    public function getTemporalAccessCode()
    {
        return $this->temporalAccessCode;
    }
}