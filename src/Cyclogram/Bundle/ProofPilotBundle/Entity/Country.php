<?php
/*
 * This is part of the ProofPilot package.
 *
 * (c)2012-2013 Cyclogram, Inc, West Hollywood, CA <crew@proofpilot.com>
 * ALL RIGHTS RESERVED
 *
 * This software is provided by the copyright holders to Manila Consulting for use on the
 * Center for Disease Control's Evaluation of Rapid HIV Self-Testing among MSM in High
 * Prevalence Cities until 2016 or the project is completed.
 *
 * Any unauthorized use, modification or resale is not permitted without expressed permission
 * from the copyright holders.
 *
 * KnowatHome branding, URL, study logic, survey instruments, and resulting data are not part
 * of this copyright and remain the property of the prime contractor.
 *
 */

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 *
 * @ORM\Table(name="country")
 * @ORM\Entity
 */
class Country
{
    /**
     * @var integer
     *
     * @ORM\Column(name="country_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $countryId;

    /**
     * @var string
     *
     * @ORM\Column(name="country_name", type="string", length=100, nullable=false)
     */
    protected $countryName;

    /**
     * @var string
     *
     * @ORM\Column(name="country_code", type="string", length=3, nullable=false)
     */
    protected $countryCode;

    /**
     * @var string
     *
     * @ORM\Column(name="dialing_code", type="string", length=255, nullable=false)
     */
    protected $dailingCode;

    /**
     * @var \Currency
     *
     * @ORM\ManyToOne(targetEntity="Currency")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="currency_code", referencedColumnName="currency_code", nullable=true)
     * })
     */
    protected $currency;

    /**
     * Get countryId
     *
     * @return integer 
     */
    public function getCountryId()
    {
        return $this->countryId;
    }

    /**
     * Set countryName
     *
     * @param string $countryName
     * @return Country
     */
    public function setCountryName($countryName)
    {
        $this->countryName = $countryName;

        return $this;
    }

    /**
     * Get countryName
     *
     * @return string 
     */
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * Set countryCode
     *
     * @param string $countryCode
     * @return Country
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * Get countryCode
     *
     * @return string 
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    public function __toString()
    {
        return $this->countryName;
    }

    public function getDailingCode()
    {
        return $this->dailingCode;
    }

    public function setDailingCode($dailingCode)
    {
        $this->dailingCode = $dailingCode;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency( \Cyclogram\Bundle\ProofPilotBundle\Entity\Currency $currency = null)
    {
        $this->currency = $currency;
    }

}
