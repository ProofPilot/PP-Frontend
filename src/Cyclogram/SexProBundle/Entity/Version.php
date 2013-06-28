<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Version
 *
 * @ORM\Table(name="version")
 * @ORM\Entity
 */
class Version
{
    /**
     * @var integer
     *
     * @ORM\Column(name="version_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $versionId;

    /**
     * @var string
     *
     * @ORM\Column(name="version_app", type="string", length=50, nullable=false)
     */
    private $versionApp;

    /**
     * @var integer
     *
     * @ORM\Column(name="version_number", type="smallint", nullable=false)
     */
    private $versionNumber;



    /**
     * Get versionId
     *
     * @return integer 
     */
    public function getVersionId()
    {
        return $this->versionId;
    }

    /**
     * Set versionApp
     *
     * @param string $versionApp
     * @return Version
     */
    public function setVersionApp($versionApp)
    {
        $this->versionApp = $versionApp;
    
        return $this;
    }

    /**
     * Get versionApp
     *
     * @return string 
     */
    public function getVersionApp()
    {
        return $this->versionApp;
    }

    /**
     * Set versionNumber
     *
     * @param integer $versionNumber
     * @return Version
     */
    public function setVersionNumber($versionNumber)
    {
        $this->versionNumber = $versionNumber;
    
        return $this;
    }

    /**
     * Get versionNumber
     *
     * @return integer 
     */
    public function getVersionNumber()
    {
        return $this->versionNumber;
    }
}