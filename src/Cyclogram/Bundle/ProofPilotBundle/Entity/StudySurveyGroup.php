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
 * StudySurveyGroup
 *
 * @ORM\Table(name="study_survey_group")
 * @ORM\Entity
 */
class StudySurveyGroup
{
    /**
     * @var integer
     *
     * @ORM\Column(name="study_survey_group_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $studySurveyGroupId;

    /**
     * @var string
     *
     * @ORM\Column(name="study_survey_group_name", type="string", length=45, nullable=true)
     */
    private $studySurveyGroupName;



    /**
     * Get studySurveyGroupId
     *
     * @return integer 
     */
    public function getStudySurveyGroupId()
    {
        return $this->studySurveyGroupId;
    }

    /**
     * Set studySurveyGroupName
     *
     * @param string $studySurveyGroupName
     * @return StudySurveyGroup
     */
    public function setStudySurveyGroupName($studySurveyGroupName)
    {
        $this->studySurveyGroupName = $studySurveyGroupName;
    
        return $this;
    }

    /**
     * Get studySurveyGroupName
     *
     * @return string 
     */
    public function getStudySurveyGroupName()
    {
        return $this->studySurveyGroupName;
    }
}