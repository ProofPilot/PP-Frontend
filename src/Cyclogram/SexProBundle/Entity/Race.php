<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Race
 *
 * @ORM\Table(name="race")
 * @ORM\Entity
 */
class Race
{
    /**
     * @var integer
     *
     * @ORM\Column(name="race_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $raceId;

    /**
     * @var string
     *
     * @ORM\Column(name="race_name", type="string", length=45, nullable=false)
     */
    private $raceName;

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
     * Get raceId
     *
     * @return integer 
     */
    public function getRaceId()
    {
        return $this->raceId;
    }

    /**
     * Set raceName
     *
     * @param string $raceName
     * @return Race
     */
    public function setRaceName($raceName)
    {
        $this->raceName = $raceName;
    
        return $this;
    }

    /**
     * Get raceName
     *
     * @return string 
     */
    public function getRaceName()
    {
        return $this->raceName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return Race
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