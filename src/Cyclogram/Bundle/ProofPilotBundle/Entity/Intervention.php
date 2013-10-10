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
 * Intervention
 *
 * @ORM\Table(name="intervention")
 * @ORM\Entity(repositoryClass="Cyclogram\Bundle\ProofPilotBundle\Repository\InterventionRepository")
 */
class Intervention
{
    const STATUS_ACTIVE = 1;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="intervention_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $interventionId;

    /**
     * @var string
     *
     * @ORM\Column(name="intervention_name", type="string", length=100, nullable=true)
     */
    private $interventionName;

    /**
     * @var string
     *
     * @ORM\Column(name="intervention_url", type="string", length=300, nullable=true)
     */
    private $interventionUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="sid_id", type="string", length=45, nullable=true)
     */
    private $sidId;

    /**
     * @var string
     *
     * @ORM\Column(name="intervention_response_url", type="string", length=500, nullable=true)
     */
    private $interventionResponseUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="intervention_title", type="string", length=255, nullable=true)
     */
    private $interventionTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="intervention_descripton", type="string", length=750, nullable=true)
     */
    private $interventionDescripton;

    /**
     * @var float
     *
     * @ORM\Column(name="intervention_incentive_amount", type="float", nullable=null)
     */
    private $interventionIncentiveAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="intervention_code", type="string", length=45, nullable=false)
     */
    private $interventionCode;

    /**
     * @var \InterventionType
     *
     * @ORM\ManyToOne(targetEntity="InterventionType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="intervention_type_id", referencedColumnName="intervention_type_id")
     * })
     */
    private $interventionType;

    /**
     * @var \Language
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Language")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="language_id", referencedColumnName="language_id")
     * })
     */
    private $language;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=false)
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
     * Set interventionId
     *
     * @param integer $interventionId
     * @return Intervention
     */
    public function setInterventionId($interventionId)
    {
        $this->interventionId = $interventionId;

        return $this;
    }

    /**
     * Get interventionId
     *
     * @return integer 
     */
    public function getInterventionId()
    {
        return $this->interventionId;
    }

    /**
     * Set interventionName
     *
     * @param string $interventionName
     * @return Intervention
     */
    public function setInterventionName($interventionName)
    {
        $this->interventionName = $interventionName;

        return $this;
    }

    /**
     * Get interventionName
     *
     * @return string 
     */
    public function getInterventionName()
    {
        return $this->interventionName;
    }

    /**
     * Set interventionUrl
     *
     * @param string $interventionUrl
     * @return Intervention
     */
    public function setInterventionUrl($interventionUrl)
    {
        $this->interventionUrl = $interventionUrl;

        return $this;
    }

    /**
     * Get interventionUrl
     *
     * @return string 
     */
    public function getInterventionUrl()
    {
        return $this->interventionUrl;
    }

    /**
     * Set sidId
     *
     * @param string $sidId
     * @return Intervention
     */
    public function setSidId($sidId)
    {
        $this->sidId = $sidId;

        return $this;
    }

    /**
     * Get sidId
     *
     * @return string 
     */
    public function getSidId()
    {
        return $this->sidId;
    }

    /**
     * Set interventionResponseUrl
     *
     * @param string $interventionResponseUrl
     * @return Intervention
     */
    public function setInterventionResponseUrl($interventionResponseUrl)
    {
        $this->interventionResponseUrl = $interventionResponseUrl;

        return $this;
    }

    /**
     * Get interventionResponseUrl
     *
     * @return string 
     */
    public function getInterventionResponseUrl()
    {
        return $this->interventionResponseUrl;
    }

    /**
     * Set interventionTitle
     *
     * @param string $interventionTitle
     * @return Intervention
     */
    public function setInterventionTitle($interventionTitle)
    {
        $this->interventionTitle = $interventionTitle;

        return $this;
    }

    /**
     * Get interventionTitle
     *
     * @return string 
     */
    public function getInterventionTitle()
    {
        return $this->interventionTitle;
    }

    /**
     * Set interventionDescripton
     *
     * @param string $interventionDescripton
     * @return Intervention
     */
    public function setInterventionDescripton($interventionDescripton)
    {
        $this->interventionDescripton = $interventionDescripton;

        return $this;
    }

    /**
     * Get interventionDescripton
     *
     * @return string 
     */
    public function getInterventionDescripton()
    {
        return $this->interventionDescripton;
    }

    /**
     * Set interventionCode
     *
     * @param string $interventionCode
     * @return Intervention
     */
    public function setInterventionCode($interventionCode)
    {
        $this->interventionCode = $interventionCode;

        return $this;
    }

    /**
     * Get interventionCode
     *
     * @return string 
     */
    public function getInterventionCode()
    {
        return $this->interventionCode;
    }

    /**
     * Set interventionType
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\InterventionType $interventionType
     * @return Intervention
     */
    public function setInterventionType(
            \Cyclogram\Bundle\ProofPilotBundle\Entity\InterventionType $interventionType = null)
    {
        $this->interventionType = $interventionType;

        return $this;
    }

    /**
     * Get interventionType
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\InterventionType 
     */
    public function getInterventionType()
    {
        return $this->interventionType;
    }

    /**
     * Set language
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Language $language
     * @return Intervention
     */
    public function setLanguage(
            \Cyclogram\Bundle\ProofPilotBundle\Entity\Language $language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Language 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return Intervention
     */
    public function setStatus($status)
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
     * @return Intervention
     */
    public function setStudy(
            \Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study = null)
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

    public function getInterventionIncentiveAmount()
    {
        return $this->interventionIncentiveAmount;
    }

    public function setInterventionIncentiveAmount(
            $interventionIncentiveAmount)
    {
        $this->interventionIncentiveAmount = $interventionIncentiveAmount;
    }

}
