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
 * StudyCriteria
 *
 * @ORM\Table(name="study_criteria")
 * @ORM\Entity(repositoryClass="Cyclogram\Bundle\ProofPilotBundle\Repository\StudyCriteriaRepository")
 */
class StudyCriteria
{
    /**
     * @var string
     *
     * @ORM\Column(name="study_criteria_json", type="blob", nullable=true)
     */
    protected $studyCriteriaJson;

    /**
     * @var \Study
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Study")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="study_id", referencedColumnName="study_id")
     * })
     */
    protected $study;



    /**
     * Set studyCriteriaJson
     *
     * @param string $studyCriteriaJson
     * @return StudyCriteria
     */
    public function setStudyCriteriaJson($studyCriteriaJson)
    {
        $this->studyCriteriaJson = $studyCriteriaJson;
    
        return $this;
    }

    /**
     * Get studyCriteriaJson
     *
     * @return string 
     */
    public function getStudyCriteriaJson()
    {
        return $this->studyCriteriaJson;
    }

    /**
     * Set study
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study
     * @return StudyCriteria
     */
    public function setStudy(\Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study)
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