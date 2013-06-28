<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Disease
 *
 * @ORM\Table(name="disease")
 * @ORM\Entity
 */
class Disease
{
    /**
     * @var integer
     *
     * @ORM\Column(name="disease_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $diseaseId;

    /**
     * @var string
     *
     * @ORM\Column(name="disease_name", type="string", length=45, nullable=false)
     */
    private $diseaseName;

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
     * Get diseaseId
     *
     * @return integer 
     */
    public function getDiseaseId()
    {
        return $this->diseaseId;
    }

    /**
     * Set diseaseName
     *
     * @param string $diseaseName
     * @return Disease
     */
    public function setDiseaseName($diseaseName)
    {
        $this->diseaseName = $diseaseName;
    
        return $this;
    }

    /**
     * Get diseaseName
     *
     * @return string 
     */
    public function getDiseaseName()
    {
        return $this->diseaseName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return Disease
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