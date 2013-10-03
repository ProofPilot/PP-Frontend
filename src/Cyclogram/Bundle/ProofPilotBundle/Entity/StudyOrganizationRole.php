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
 * StudyOrganizationRole
 *
 * @ORM\Table(name="study_organization_role")
 * @ORM\Entity
 */
class StudyOrganizationRole
{
    /**
     * @var integer
     *
     * @ORM\Column(name="study_organization_role_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $studyOrganizationRoleId;

    /**
     * @var string
     *
     * @ORM\Column(name="study_organization_role_name", type="string", length=45, nullable=false)
     */
    private $studyOrganizationRoleName;



    /**
     * Get studyOrganizationRoleId
     *
     * @return integer 
     */
    public function getStudyOrganizationRoleId()
    {
        return $this->studyOrganizationRoleId;
    }

    /**
     * Set studyOrganizationRoleName
     *
     * @param string $studyOrganizationRoleName
     * @return StudyOrganizationRole
     */
    public function setStudyOrganizationRoleName($studyOrganizationRoleName)
    {
        $this->studyOrganizationRoleName = $studyOrganizationRoleName;
    
        return $this;
    }

    /**
     * Get studyOrganizationRoleName
     *
     * @return string 
     */
    public function getStudyOrganizationRoleName()
    {
        return $this->studyOrganizationRoleName;
    }
    
    public function __toString()
    {
    	return $this->studyOrganizationRoleName;
    }
}