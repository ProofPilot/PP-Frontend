<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sex
 *
 * @ORM\Table(name="sex")
 * @ORM\Entity
 */
class Sex
{
    /**
     * @var integer
     *
     * @ORM\Column(name="sex_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $sexId;

    /**
     * @var string
     *
     * @ORM\Column(name="sex_name", type="string", length=45, nullable=false)
     */
    private $sexName;

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
     * Get sexId
     *
     * @return integer 
     */
    public function getSexId()
    {
        return $this->sexId;
    }

    /**
     * Set sexName
     *
     * @param string $sexName
     * @return Sex
     */
    public function setSexName($sexName)
    {
        $this->sexName = $sexName;
    
        return $this;
    }

    /**
     * Get sexName
     *
     * @return string 
     */
    public function getSexName()
    {
        return $this->sexName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return Sex
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