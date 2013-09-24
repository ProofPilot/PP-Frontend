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
 * StudyOrganizationLink
 *
 * @ORM\Table(name="study_organization_link")
 * @ORM\Entity
 */
class StudyOrganizationLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="study_organization_link_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $studyOrganizationLinkId;

    /**
     * @var \Organization
     *
     * @ORM\ManyToOne(targetEntity="Organization", inversedBy="studyOrganizationLinks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="organization_id", referencedColumnName="organization_id")
     * })
     */
    private $organization;

    /**
     * @var \Status
     *
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="status_id")
     * })
     */
    private $status;

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
     * @var \StudyOrganizationRole
     *
     * @ORM\ManyToOne(targetEntity="StudyOrganizationRole")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="study_organization_role_id", referencedColumnName="study_organization_role_id")
     * })
     */
    private $studyOrganizationRole;



    /**
     * Get studyOrganizationLinkId
     *
     * @return integer 
     */
    public function getStudyOrganizationLinkId()
    {
        return $this->studyOrganizationLinkId;
    }

    /**
     * Set organization
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Organization $organization
     * @return StudyOrganizationLink
     */
    public function setOrganization(\Cyclogram\Bundle\ProofPilotBundle\Entity\Organization $organization = null)
    {
        $this->organization = $organization;
    
        return $this;
    }

    /**
     * Get organization
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Organization 
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return StudyOrganizationLink
     */
    public function setStatus(\Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status = null)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Status 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set study
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study
     * @return StudyOrganizationLink
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
     * Set studyOrganizationRole
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\StudyOrganizationRole $studyOrganizationRole
     * @return StudyOrganizationLink
     */
    public function setStudyOrganizationRole(\Cyclogram\Bundle\ProofPilotBundle\Entity\StudyOrganizationRole $studyOrganizationRole = null)
    {
        $this->studyOrganizationRole = $studyOrganizationRole;
    
        return $this;
    }

    /**
     * Get studyOrganizationRole
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\StudyOrganizationRole 
     */
    public function getStudyOrganizationRole()
    {
        return $this->studyOrganizationRole;
    }
}