<?php

namespace Cyclogram\SexProBundle\Entity;

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