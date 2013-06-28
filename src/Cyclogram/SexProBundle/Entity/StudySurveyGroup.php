<?php

namespace Cyclogram\SexProBundle\Entity;

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