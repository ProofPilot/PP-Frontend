<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StudyStaffRoleLink
 *
 * @ORM\Table(name="study_staff_role_link")
 * @ORM\Entity
 */
class StudyStaffRoleLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="study_staff_role_link_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $studyStaffRoleLinkId;

    /**
     * @var \Representative
     *
     * @ORM\ManyToOne(targetEntity="Representative")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="representative_id", referencedColumnName="representative_id")
     * })
     */
    private $representative;

    /**
     * @var \Study
     *
     * @ORM\ManyToOne(targetEntity="Study")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="study_id", referencedColumnName="study_id")
     * })
     */
    private $study;

    /**
     * @var \StudyStaffRole
     *
     * @ORM\ManyToOne(targetEntity="StudyStaffRole")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="study_staff_role_id", referencedColumnName="study_staff_role_id")
     * })
     */
    private $studyStaffRole;



    /**
     * Get studyStaffRoleLinkId
     *
     * @return integer 
     */
    public function getStudyStaffRoleLinkId()
    {
        return $this->studyStaffRoleLinkId;
    }

    /**
     * Set representative
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Representative $representative
     * @return StudyStaffRoleLink
     */
    public function setRepresentative(\Cyclogram\Bundle\ProofPilotBundle\Entity\Representative $representative = null)
    {
        $this->representative = $representative;
    
        return $this;
    }

    /**
     * Get representative
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Representative 
     */
    public function getRepresentative()
    {
        return $this->representative;
    }

    /**
     * Set study
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study
     * @return StudyStaffRoleLink
     */
    public function setStudy(\Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study = null)
    {
        $this->study = $study;
    
        return $this;
    }

    /**
     * Get study
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Study 
     */
    public function getStudy()
    {
        return $this->study;
    }

    /**
     * Set studyStaffRole
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\StudyStaffRole $studyStaffRole
     * @return StudyStaffRoleLink
     */
    public function setStudyStaffRole(\Cyclogram\Bundle\ProofPilotBundle\Entity\StudyStaffRole $studyStaffRole = null)
    {
        $this->studyStaffRole = $studyStaffRole;
    
        return $this;
    }

    /**
     * Get studyStaffRole
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\StudyStaffRole 
     */
    public function getStudyStaffRole()
    {
        return $this->studyStaffRole;
    }
}