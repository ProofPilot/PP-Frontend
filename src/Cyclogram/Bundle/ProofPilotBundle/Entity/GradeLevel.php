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
 * GradeEntity
 *
 * @ORM\Table(name="grade_level")
 * @ORM\Entity
 */
class GradeLevel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="grade_level_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $gradeLevelId;

    /**
     * @var string
     *
     * @ORM\Column(name="grade_level_name", type="string", length=50, nullable=false)
     */
    private $gradeLevelName;

    public function getGradeLevelId()
    {
        return $this->gradeLevelId;
    }

    public function setGradeLevelId($gradeLevelId)
    {
        $this->gradeLevelId = $gradeLevelId;
    }

    public function getGradeLevelName()
    {
        return $this->gradeLevelName;
    }

    public function setGradeLevelName($gradeLevelName)
    {
        $this->gradeLevelName = $gradeLevelName;
    }

}
