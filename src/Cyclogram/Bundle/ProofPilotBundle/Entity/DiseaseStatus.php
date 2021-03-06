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
 * Cyclogram\Bundle\ProofPilotBundle\Entity\DiseaseStatus
 *
 * @ORM\Table(name="disease_status")
 * @ORM\Entity
 */
class DiseaseStatus
{
    /**
     * @var integer $diseaseStatusId
     *
     * @ORM\Column(name="disease_status_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $diseaseStatusId;

    /**
     * @var integer $languageId
     *
     * @ORM\Column(name="language_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $languageId;

    /**
     * @var string $diseaseStatusName
     *
     * @ORM\Column(name="disease_status_name", type="string", length=45, nullable=false)
     */
    private $diseaseStatusName;

    /**
     * @var Language
     *
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="language_id", referencedColumnName="language_id")
     * })
     */
    private $language;

    /**
     * @var Status
     *
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="status_id")
     * })
     */
    private $status;



    /**
     * Set diseaseStatusId
     *
     * @param integer $diseaseStatusId
     */
    public function setDiseaseStatusId($diseaseStatusId)
    {
        $this->diseaseStatusId = $diseaseStatusId;
    }

    /**
     * Get diseaseStatusId
     *
     * @return integer 
     */
    public function getDiseaseStatusId()
    {
        return $this->diseaseStatusId;
    }

    /**
     * Set languageId
     *
     * @param integer $languageId
     */
    public function setLanguageId($languageId)
    {
        $this->languageId = $languageId;
    }

    /**
     * Get languageId
     *
     * @return integer 
     */
    public function getLanguageId()
    {
        return $this->languageId;
    }

    /**
     * Set diseaseStatusName
     *
     * @param string $diseaseStatusName
     */
    public function setDiseaseStatusName($diseaseStatusName)
    {
        $this->diseaseStatusName = $diseaseStatusName;
    }

    /**
     * Get diseaseStatusName
     *
     * @return string 
     */
    public function getDiseaseStatusName()
    {
        return $this->diseaseStatusName;
    }

    /**
     * Set language
     *
     * @param Cyclogram\Bundle\ProofPilotBundle\Entity\Language $language
     */
    public function setLanguage(\Cyclogram\Bundle\ProofPilotBundle\Entity\Language $language)
    {
        $this->language = $language;
    }

    /**
     * Get language
     *
     * @return Cyclogram\Bundle\ProofPilotBundle\Entity\Language 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set status
     *
     * @param Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     */
    public function setStatus(\Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return Cyclogram\Bundle\ProofPilotBundle\Entity\Status 
     */
    public function getStatus()
    {
        return $this->status;
    }
}