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
 * StudyLanguage
 *
 * @ORM\Table(name="study_language")
 * @ORM\Entity(repositoryClass="Cyclogram\Bundle\ProofPilotBundle\Repository\StudyLanguageRepository")
 */
class StudyLanguage
{

    /**
     * @var integer
     *
     * @ORM\Column(name="study_language_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $studyLanguageId;

    /**
     * @var \Study
     *
     * @ORM\ManyToOne(targetEntity="Study")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="study_id", referencedColumnName="study_id")
     * })
     */
    private $study;

    /**
     * @var \Language
     *
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="language_id", referencedColumnName="language_id")
     * })
     */
    private $language;


    /**
     * Set studyLanguageId
     *
     * @param integer $studyLanguageId
     * @return StudyLanguage
     */
    public function setStudyLanguageId($studyLanguageId)
    {
        $this->studyLanguageId = $studyLanguageId;
    
        return $this;
    }

    /**
     * Get studyLanguageId
     *
     * @return integer 
     */
    public function getStudyLanguageId()
    {
        return $this->studyLanguageId;
    }

    /**
     * Set study
     *
     * @param integer $study
     * @return StudyLanguage
     */
    public function setStudy(\Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study)
    {
        $this->study = $study;
    
        return $this;
    }

    /**
     * Get study
     *
     * @return integer 
     */
    public function getStudy()
    {
        return $this->study;
    }

    /**
     * Set language
     *
     * @param integer $language
     * @return StudyLanguage
     */
    public function setLanguage(\Cyclogram\Bundle\ProofPilotBundle\Entity\Language $language=null)
    {
        $this->language = $language;
    
        return $this;
    }

    /**
     * Get language
     *
     * @return integer 
     */
    public function getLanguage()
    {
        return $this->language;
    }
}
