<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SpecimenTestLink
 *
 * @ORM\Table(name="specimen_test_link")
 * @ORM\Entity
 */
class SpecimenTestLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="specimen_test_link_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $specimenTestLinkId;

    /**
     * @var integer
     *
     * @ORM\Column(name="test_id", type="integer", nullable=false)
     */
    private $testId;

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
     * Get specimenTestLinkId
     *
     * @return integer 
     */
    public function getSpecimenTestLinkId()
    {
        return $this->specimenTestLinkId;
    }

    /**
     * Set testId
     *
     * @param integer $testId
     * @return SpecimenTestLink
     */
    public function setTestId($testId)
    {
        $this->testId = $testId;
    
        return $this;
    }

    /**
     * Get testId
     *
     * @return integer 
     */
    public function getTestId()
    {
        return $this->testId;
    }

    /**
     * Set specimen
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Specimen $specimen
     * @return SpecimenTestLink
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