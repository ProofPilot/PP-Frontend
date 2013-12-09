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
 * MaritalStatus
 *
 * @ORM\Table(name="marital_status")
 * @ORM\Entity
 */
class MaritalStatus
{
    /**
     * @var integer
     *
     * @ORM\Column(name="marital_status_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $maritalStatusId;

    /**
     * @var string
     *
     * @ORM\Column(name="marital_status_name", type="string", length=50, nullable=false)
     */
    private $maritalStatusName;

    public function getMaritalStatusId()
    {
        return $this->maritalStatusId;
    }

    public function setMaritalStatusId($maritalStatusId)
    {
        $this->maritalStatusId = $maritalStatusId;
    }

    public function getMaritalStatusName()
    {
        return $this->maritalStatusName;
    }

    public function setMaritalStatusName($maritalStatusName)
    {
        $this->maritalStatusName = $maritalStatusName;
    }

}
