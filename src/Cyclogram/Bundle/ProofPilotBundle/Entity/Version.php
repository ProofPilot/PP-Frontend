<?php
/*
* This is part of the ProofPilot package.
*
* (c)2012-2013 Cyclogram, Inc, West Hollywood, CA <crew@proofpilot.com>
* ALL RIGHTS RESERVED
*
* This software is provided by the copyright holders to Manila Consulting for use on the
* Center for Disease Control's Evaluation of Rapid HIV Self-Testing among MSM in High
* Prevalence Cities until 2016 or the project is completed.
*
* Any unauthorized use, modification or resale is not permitted without expressed permission
* from the copyright holders.
*
* KnowatHome branding, URL, study logic, survey instruments, and resulting data are not part
* of this copyright and remain the property of the prime contractor.
*
*/

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

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