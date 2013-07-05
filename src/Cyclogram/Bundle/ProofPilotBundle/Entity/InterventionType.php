<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InterventionType
 *
 * @ORM\Table(name="intervention_type")
 * @ORM\Entity
 */
class InterventionType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="intervention_type_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $interventionTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="intervention_type_name", type="string", length=45, nullable=false)
     */
    private $interventionTypeName;

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
     * Get interventionTypeId
     *
     * @return integer 
     */
    public function getInterventionTypeId()
    {
        return $this->interventionTypeId;
    }

    /**
     * Set interventionTypeName
     *
     * @param string $interventionTypeName
     * @return InterventionType
     */
    public function setInterventionTypeName($interventionTypeName)
    {
        $this->interventionTypeName = $interventionTypeName;
    
        return $this;
    }

    /**
     * Get interventionTypeName
     *
     * @return string 
     */
    public function getInterventionTypeName()
    {
        return $this->interventionTypeName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return InterventionType
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
    
    public function __toString()
    {
    	return $this->interventionTypeName;
    }
}