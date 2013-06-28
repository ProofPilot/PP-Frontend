<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IndividualTitle
 *
 * @ORM\Table(name="individual_title")
 * @ORM\Entity
 */
class IndividualTitle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="individual_title_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $individualTitleId;

    /**
     * @var string
     *
     * @ORM\Column(name="individual_title_name", type="string", length=45, nullable=false)
     */
    private $individualTitleName;

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
     * Get individualTitleId
     *
     * @return integer 
     */
    public function getIndividualTitleId()
    {
        return $this->individualTitleId;
    }

    /**
     * Set individualTitleName
     *
     * @param string $individualTitleName
     * @return IndividualTitle
     */
    public function setIndividualTitleName($individualTitleName)
    {
        $this->individualTitleName = $individualTitleName;
    
        return $this;
    }

    /**
     * Get individualTitleName
     *
     * @return string 
     */
    public function getIndividualTitleName()
    {
        return $this->individualTitleName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return IndividualTitle
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
    	return $this->individualTitleName;
    }
}