<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Droug
 *
 * @ORM\Table(name="droug")
 * @ORM\Entity
 */
class Droug
{
    /**
     * @var integer
     *
     * @ORM\Column(name="droug_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $drougId;

    /**
     * @var string
     *
     * @ORM\Column(name="droug_name", type="string", length=45, nullable=false)
     */
    private $drougName;



    /**
     * Get drougId
     *
     * @return integer 
     */
    public function getDrougId()
    {
        return $this->drougId;
    }

    /**
     * Set drougName
     *
     * @param string $drougName
     * @return Droug
     */
    public function setDrougName($drougName)
    {
        $this->drougName = $drougName;
    
        return $this;
    }

    /**
     * Get drougName
     *
     * @return string 
     */
    public function getDrougName()
    {
        return $this->drougName;
    }
}