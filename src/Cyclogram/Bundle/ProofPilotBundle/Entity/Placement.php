<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Placement
 *
 * @ORM\Table(name="placement")
 * @ORM\Entity
 */
class Placement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="placement_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $placementId;

    /**
     * @var string
     *
     * @ORM\Column(name="placement_name", type="string", length=45, nullable=false)
     */
    private $placementName;

    /**
     * @var string
     *
     * @ORM\Column(name="placement_description", type="string", length=45, nullable=true)
     */
    private $placementDescription;

    /**
     * @var float
     *
     * @ORM\Column(name="placement_cost_per_placement", type="float", nullable=true)
     */
    private $placementCostPerPlacement;

    /**
     * @var float
     *
     * @ORM\Column(name="placement_cost_per_impression", type="float", nullable=true)
     */
    private $placementCostPerImpression;

    /**
     * @var float
     *
     * @ORM\Column(name="placement_budget", type="float", nullable=true)
     */
    private $placementBudget;

    /**
     * @var float
     *
     * @ORM\Column(name="placement_budget_spent", type="float", nullable=true)
     */
    private $placementBudgetSpent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="placement_date_start", type="datetime", nullable=true)
     */
    private $placementDateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="placement_date_stop", type="datetime", nullable=true)
     */
    private $placementDateStop;

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
     * @var \Study
     *
     * @ORM\ManyToOne(targetEntity="Study")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="study_id", referencedColumnName="study_id")
     * })
     */
    private $study;



    /**
     * Get placementId
     *
     * @return integer 
     */
    public function getPlacementId()
    {
        return $this->placementId;
    }

    /**
     * Set placementName
     *
     * @param string $placementName
     * @return Placement
     */
    public function setPlacementName($placementName)
    {
        $this->placementName = $placementName;
    
        return $this;
    }

    /**
     * Get placementName
     *
     * @return string 
     */
    public function getPlacementName()
    {
        return $this->placementName;
    }

    /**
     * Set placementDescription
     *
     * @param string $placementDescription
     * @return Placement
     */
    public function setPlacementDescription($placementDescription)
    {
        $this->placementDescription = $placementDescription;
    
        return $this;
    }

    /**
     * Get placementDescription
     *
     * @return string 
     */
    public function getPlacementDescription()
    {
        return $this->placementDescription;
    }

    /**
     * Set placementCostPerPlacement
     *
     * @param float $placementCostPerPlacement
     * @return Placement
     */
    public function setPlacementCostPerPlacement($placementCostPerPlacement)
    {
        $this->placementCostPerPlacement = $placementCostPerPlacement;
    
        return $this;
    }

    /**
     * Get placementCostPerPlacement
     *
     * @return float 
     */
    public function getPlacementCostPerPlacement()
    {
        return $this->placementCostPerPlacement;
    }

    /**
     * Set placementCostPerImpression
     *
     * @param float $placementCostPerImpression
     * @return Placement
     */
    public function setPlacementCostPerImpression($placementCostPerImpression)
    {
        $this->placementCostPerImpression = $placementCostPerImpression;
    
        return $this;
    }

    /**
     * Get placementCostPerImpression
     *
     * @return float 
     */
    public function getPlacementCostPerImpression()
    {
        return $this->placementCostPerImpression;
    }

    /**
     * Set placementBudget
     *
     * @param float $placementBudget
     * @return Placement
     */
    public function setPlacementBudget($placementBudget)
    {
        $this->placementBudget = $placementBudget;
    
        return $this;
    }

    /**
     * Get placementBudget
     *
     * @return float 
     */
    public function getPlacementBudget()
    {
        return $this->placementBudget;
    }

    /**
     * Set placementBudgetSpent
     *
     * @param float $placementBudgetSpent
     * @return Placement
     */
    public function setPlacementBudgetSpent($placementBudgetSpent)
    {
        $this->placementBudgetSpent = $placementBudgetSpent;
    
        return $this;
    }

    /**
     * Get placementBudgetSpent
     *
     * @return float 
     */
    public function getPlacementBudgetSpent()
    {
        return $this->placementBudgetSpent;
    }

    /**
     * Set placementDateStart
     *
     * @param \DateTime $placementDateStart
     * @return Placement
     */
    public function setPlacementDateStart($placementDateStart)
    {
        $this->placementDateStart = $placementDateStart;
    
        return $this;
    }

    /**
     * Get placementDateStart
     *
     * @return \DateTime 
     */
    public function getPlacementDateStart()
    {
        return $this->placementDateStart;
    }

    /**
     * Set placementDateStop
     *
     * @param \DateTime $placementDateStop
     * @return Placement
     */
    public function setPlacementDateStop($placementDateStop)
    {
        $this->placementDateStop = $placementDateStop;
    
        return $this;
    }

    /**
     * Get placementDateStop
     *
     * @return \DateTime 
     */
    public function getPlacementDateStop()
    {
        return $this->placementDateStop;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return Placement
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

    /**
     * Set study
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study
     * @return Placement
     */
    public function setStudy(\Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study = null)
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
}