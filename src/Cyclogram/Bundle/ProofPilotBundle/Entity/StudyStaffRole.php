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
 * StudyStaffRole
 *
 * @ORM\Table(name="study_staff_role")
 * @ORM\Entity
 */
class StudyStaffRole
{
    /**
     * @var integer
     *
     * @ORM\Column(name="study_staff_role_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $studyStaffRoleId;

    /**
     * @var string
     *
     * @ORM\Column(name="study_staff_role_name", type="string", length=45, nullable=false)
     */
    private $studyStaffRoleName;



    /**
     * Get studyStaffRoleId
     *
     * @return integer 
     */
    public function getStudyStaffRoleId()
    {
        return $this->studyStaffRoleId;
    }

    /**
     * Set studyStaffRoleName
     *
     * @param string $studyStaffRoleName
     * @return StudyStaffRole
     */
    public function setStudyStaffRoleName($studyStaffRoleName)
    {
        $this->studyStaffRoleName = $studyStaffRoleName;
    
        return $this;
    }

    /**
     * Get studyStaffRoleName
     *
     * @return string 
     */
    public function getStudyStaffRoleName()
    {
        return $this->studyStaffRoleName;
    }
}