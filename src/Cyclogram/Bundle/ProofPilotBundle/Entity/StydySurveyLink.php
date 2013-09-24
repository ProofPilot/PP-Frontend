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
 * StydySurveyLink
 *
 * @ORM\Table(name="stydy_survey_link")
 * @ORM\Entity
 */
class StydySurveyLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="stydy_survey_link_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $stydySurveyLinkId;

    /**
     * @var integer
     *
     * @ORM\Column(name="survey_id", type="integer", nullable=false)
     */
    private $surveyId;

    /**
     * @var string
     *
     * @ORM\Column(name="survey_name", type="string", length=145, nullable=false)
     */
    private $surveyName;

    /**
     * @var integer
     *
     * @ORM\Column(name="survey_qid", type="integer", nullable=true)
     */
    private $surveyQid;

    /**
     * @var string
     *
     * @ORM\Column(name="survey_qid_name", type="string", length=155, nullable=true)
     */
    private $surveyQidName;

    /**
     * @var \Arm
     *
     * @ORM\ManyToOne(targetEntity="Arm")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="arm_id", referencedColumnName="arm_id")
     * })
     */
    private $arm;

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
     * Get stydySurveyLinkId
     *
     * @return integer 
     */
    public function getStydySurveyLinkId()
    {
        return $this->stydySurveyLinkId;
    }

    /**
     * Set surveyId
     *
     * @param integer $surveyId
     * @return StydySurveyLink
     */
    public function setSurveyId($surveyId)
    {
        $this->surveyId = $surveyId;
    
        return $this;
    }

    /**
     * Get surveyId
     *
     * @return integer 
     */
    public function getSurveyId()
    {
        return $this->surveyId;
    }

    /**
     * Set surveyName
     *
     * @param string $surveyName
     * @return StydySurveyLink
     */
    public function setSurveyName($surveyName)
    {
        $this->surveyName = $surveyName;
    
        return $this;
    }

    /**
     * Get surveyName
     *
     * @return string 
     */
    public function getSurveyName()
    {
        return $this->surveyName;
    }

    /**
     * Set surveyQid
     *
     * @param integer $surveyQid
     * @return StydySurveyLink
     */
    public function setSurveyQid($surveyQid)
    {
        $this->surveyQid = $surveyQid;
    
        return $this;
    }

    /**
     * Get surveyQid
     *
     * @return integer 
     */
    public function getSurveyQid()
    {
        return $this->surveyQid;
    }

    /**
     * Set surveyQidName
     *
     * @param string $surveyQidName
     * @return StydySurveyLink
     */
    public function setSurveyQidName($surveyQidName)
    {
        $this->surveyQidName = $surveyQidName;
    
        return $this;
    }

    /**
     * Get surveyQidName
     *
     * @return string 
     */
    public function getSurveyQidName()
    {
        return $this->surveyQidName;
    }

    /**
     * Set arm
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Arm $arm
     * @return StydySurveyLink
     */
    public function setArm(\Cyclogram\Bundle\ProofPilotBundle\Entity\Arm $arm = null)
    {
        $this->arm = $arm;
    
        return $this;
    }

    /**
     * Get arm
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Arm 
     */
    public function getArm()
    {
        return $this->arm;
    }

    /**
     * Set study
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study
     * @return StydySurveyLink
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