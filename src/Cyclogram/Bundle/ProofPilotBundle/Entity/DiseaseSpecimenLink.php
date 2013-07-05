<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DiseaseSpecimenLink
 *
 * @ORM\Table(name="disease_specimen_link")
 * @ORM\Entity
 */
class DiseaseSpecimenLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="disease_specimen_link_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $diseaseSpecimenLinkId;

    /**
     * @var integer
     *
     * @ORM\Column(name="disease_id", type="integer", nullable=false)
     */
    private $diseaseId;

    /**
     * @var \Specimen
     *
     * @ORM\ManyToOne(targetEntity="Specimen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="specimen_id", referencedColumnName="specimen_id")
     * })
     */
    private $specimen;



    /**
     * Get diseaseSpecimenLinkId
     *
     * @return integer 
     */
    public function getDiseaseSpecimenLinkId()
    {
        return $this->diseaseSpecimenLinkId;
    }

    /**
     * Set diseaseId
     *
     * @param integer $diseaseId
     * @return DiseaseSpecimenLink
     */
    public function setDiseaseId($diseaseId)
    {
        $this->diseaseId = $diseaseId;
    
        return $this;
    }

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
     * Set specimen
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Specimen $specimen
     * @return DiseaseSpecimenLink
     */
    public function setSpecimen(\Cyclogram\Bundle\ProofPilotBundle\Entity\Specimen $specimen = null)
    {
        $this->specimen = $specimen;
    
        return $this;
    }

    /**
     * Get specimen
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Specimen 
     */
    public function getSpecimen()
    {
        return $this->specimen;
    }
}