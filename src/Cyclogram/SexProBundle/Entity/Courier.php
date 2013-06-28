<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Courier
 *
 * @ORM\Table(name="courier")
 * @ORM\Entity
 */
class Courier
{
    /**
     * @var integer
     *
     * @ORM\Column(name="courier_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $courierId;

    /**
     * @var string
     *
     * @ORM\Column(name="courier_name", type="string", length=45, nullable=false)
     */
    private $courierName;

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
     * Get courierId
     *
     * @return integer 
     */
    public function getCourierId()
    {
        return $this->courierId;
    }

    /**
     * Set courierName
     *
     * @param string $courierName
     * @return Courier
     */
    public function setCourierName($courierName)
    {
        $this->courierName = $courierName;
    
        return $this;
    }

    /**
     * Get courierName
     *
     * @return string 
     */
    public function getCourierName()
    {
        return $this->courierName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return Courier
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
    	return $this->courierName;
    }
}