<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Affinity
 *
 * @ORM\Table(name="affinity")
 * @ORM\Entity
 */
class Affinity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="affinity_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $affinityId;

    /**
     * @var string
     *
     * @ORM\Column(name="affinity_name", type="string", length=45, nullable=false)
     */
    private $affinityName;

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
     * Get affinityId
     *
     * @return integer 
     */
    public function getAffinityId()
    {
        return $this->affinityId;
    }

    /**
     * Set affinityName
     *
     * @param string $affinityName
     * @return Affinity
     */
    public function setAffinityName($affinityName)
    {
        $this->affinityName = $affinityName;
    
        return $this;
    }

    /**
     * Get affinityName
     *
     * @return string 
     */
    public function getAffinityName()
    {
        return $this->affinityName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return Affinity
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