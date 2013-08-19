<?php

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
     * @ORM\Column(name="intervention_name", type="string", length=45, nullable=false)
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
     * @var \InterventionType
     *
     * @ORM\ManyToOne(targetEntity="InterventionType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="intervention_type_id", referencedColumnName="intervention_type_id")
     * })
     */
    private $interventionType;

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

    public function getInterventionName()
    {
        return $this->interventionName;
    }

    public function setInterventionName($interventionName)
    {
        $this->interventionName = $interventionName;
    }
    
    


    public function getInterventionType()
    {
        return $this->interventionType;
    }

    public function setInterventionType($interventionType)
    {
        $this->interventionType = $interventionType;
    }

    public function getSidId()
    {
        return $this->sidId;
    }

    public function setSidId($sidId)
    {
        $this->sidId = $sidId;
    }

    public function getInterventionId()
    {
        return $this->interventionId;
    }

    public function setInterventionId($interventionId)
    {
        $this->interventionId = $interventionId;
    }

    public function getInterventionUrl()
    {
        return $this->interventionUrl;
    }

    public function setInterventionUrl($interventionUrl)
    {
        $this->interventionUrl = $interventionUrl;
    }

    public function getInterventionResponseUrl()
    {
        return $this->interventionResponseUrl;
    }

    public function setInterventionResponseUrl($interventionResponseUrl)
    {
        $this->interventionResponseUrl = $interventionResponseUrl;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getInterventionTitle()
    {
        return $this->interventionTitle;
    }

    public function setInterventionTitle($interventionTitle)
    {
        $this->interventionTitle = $interventionTitle;
    }

    public function getInterventionDescripton()
    {
        return $this->interventionDescripton;
    }

    public function setInterventionDescripton($interventionDescripton)
    {
        $this->interventionDescripton = $interventionDescripton;
    }
}
