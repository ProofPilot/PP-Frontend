<?php

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
     * @ORM\Column(name="studyLanguageId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $studyLanguageId;

    /**
     * @var \Study
     *
     * @ORM\ManyToOne(targetEntity="Study)
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
