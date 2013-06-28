<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Status
 *
 * @ORM\Table(name="status")
 * @ORM\Entity
 */
class Status
{
    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $statusId;

    /**
     * @var string
     *
     * @ORM\Column(name="status_name", type="string", length=45, nullable=false)
     */
    private $statusName;



    /**
     * Get statusId
     *
     * @return integer 
     */
    public function getStatusId()
    {
        return $this->statusId;
    }

    /**
     * Set statusName
     *
     * @param string $statusName
     * @return Status
     */
    public function setStatusName($statusName)
    {
        $this->statusName = $statusName;
    
        return $this;
    }

    /**
     * Get statusName
     *
     * @return string 
     */
    public function getStatusName()
    {
        return $this->statusName;
    }
    
    public function __toString()
    {
    	return $this->statusName;
    }
}