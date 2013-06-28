<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Intervention
 *
 * @ORM\Table(name="intervention")
 * @ORM\Entity
 */
class Intervention
{
    /**
     * @var integer
     *
     * @ORM\Column(name="intervention_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
     * Set interventionType
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\InterventionType $interventionType
     * @return Intervention
     */
    public function setInterventionType(\Cyclogram\Bundle\ProofPilotBundle\Entity\InterventionType $interventionType = null)
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
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return Intervention
     */
    public function setStatus(\Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status = null)
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
}