<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cyclogram\Bundle\ProofPilotBundle\Entity\InterventionName
 *
 * @ORM\Table(name="intervention_name")
 * @ORM\Entity
 */
class InterventionName
{
    /**
     * @var integer $interventionNameId
     *
     * @ORM\Column(name="intervention_name_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $interventionNameId;

    /**
     * @var string $interventionNameName
     *
     * @ORM\Column(name="intervention_name_name", type="string", length=45, nullable=false)
     */
    private $interventionNameName;

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
     * Get interventionNameId
     *
     * @return integer 
     */
    public function getInterventionNameId()
    {
        return $this->interventionNameId;
    }

    /**
     * Set interventionNameName
     *
     * @param string $interventionNameName
     */
    public function setInterventionNameName($interventionNameName)
    {
        $this->interventionNameName = $interventionNameName;
    }

    /**
     * Get interventionNameName
     *
     * @return string 
     */
    public function getInterventionNameName()
    {
        return $this->interventionNameName;
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