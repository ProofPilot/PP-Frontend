<?php

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