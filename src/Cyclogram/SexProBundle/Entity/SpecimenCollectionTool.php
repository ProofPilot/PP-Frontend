<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SpecimenCollectionTool
 *
 * @ORM\Table(name="specimen_collection_tool")
 * @ORM\Entity
 */
class SpecimenCollectionTool
{
    /**
     * @var integer
     *
     * @ORM\Column(name="specimen_collection_tool_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $specimenCollectionToolId;

    /**
     * @var string
     *
     * @ORM\Column(name="specimen_collection_tool_name", type="string", length=45, nullable=false)
     */
    private $specimenCollectionToolName;

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
     * Get specimenCollectionToolId
     *
     * @return integer 
     */
    public function getSpecimenCollectionToolId()
    {
        return $this->specimenCollectionToolId;
    }

    /**
     * Set specimenCollectionToolName
     *
     * @param string $specimenCollectionToolName
     * @return SpecimenCollectionTool
     */
    public function setSpecimenCollectionToolName($specimenCollectionToolName)
    {
        $this->specimenCollectionToolName = $specimenCollectionToolName;
    
        return $this;
    }

    /**
     * Get specimenCollectionToolName
     *
     * @return string 
     */
    public function getSpecimenCollectionToolName()
    {
        return $this->specimenCollectionToolName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return SpecimenCollectionTool
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
    	return $this->specimenCollectionToolName;
    }
}