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
 * Industry
 *
 * @ORM\Table(name="industry")
 * @ORM\Entity
 */
class Industry
{
    /**
     * @var integer
     *
     * @ORM\Column(name="industry_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $industryId;

    /**
     * @var string
     *
     * @ORM\Column(name="industry_name", type="string", length=50, nullable=false)
     */
    protected $industryName;

    public function getIndustryId()
    {
        return $this->industryId;
    }

    public function setIndustryId($industryId)
    {
        $this->industryId = $industryId;
    }

    public function getIndustryName()
    {
        return $this->industryName;
    }

    public function setIndustryName($industryName)
    {
        $this->industryName = $industryName;
    }

}
