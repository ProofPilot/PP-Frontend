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
 * StudyStudyCategoryLink
 *
 * @ORM\Table(name="study_study_category_link")
 * @ORM\Entity
 */
class StudyStudyCategoryLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="study_study_category_link_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $studyStudyCategoryLinkId;

    /**
     * @var \StudyCategory
     *
     * @ORM\ManyToOne(targetEntity="StudyCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="study_category_id", referencedColumnName="study_category_id")
     * })
     */
    private $studyCategory;

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
     * Get studyStudyCategoryLinkId
     *
     * @return integer 
     */
    public function getStudyStudyCategoryLinkId()
    {
        return $this->studyStudyCategoryLinkId;
    }

    /**
     * Set studyCategory
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\StudyCategory $studyCategory
     * @return StudyStudyCategoryLink
     */
    public function setStudyCategory(\Cyclogram\Bundle\ProofPilotBundle\Entity\StudyCategory $studyCategory = null)
    {
        $this->studyCategory = $studyCategory;
    
        return $this;
    }

    /**
     * Get studyCategory
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\StudyCategory 
     */
    public function getStudyCategory()
    {
        return $this->studyCategory;
    }

    /**
     * Set study
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study
     * @return StudyStudyCategoryLink
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
}