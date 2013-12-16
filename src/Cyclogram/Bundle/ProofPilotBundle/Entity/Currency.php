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
 * @ORM\Table(name="currency")
 * @ORM\Entity
 */
class Currency
{
    /**
     * @var string
     *
     * @ORM\Column(name="currency_code", type="string", nullable=false)
     * @ORM\Id
     */
    protected $currencyCode;

    /**
     * @var string
     *
     * @ORM\Column(name="currency_name", type="string", length=100, nullable=false)
     */
    protected $currencyName;

    /**
     * @var string
     *
     * @ORM\Column(name="currency_symbol", type="string", length=100, nullable=false)
     */
    protected $currencySymbol;

    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;
    }

    public function getCurrencyName()
    {
        return $this->currencyName;
    }

    public function setCurrencyName($currencyName)
    {
        $this->currencyName = $currencyName;
    }

    public function getCurrencySymbol()
    {
        return $this->currencySymbol;
    }

    public function setCurrencySymbol($currencySymbol)
    {
        $this->currencySymbol = $currencySymbol;
    }

}
