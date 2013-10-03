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
 * LocationType
 *
 * @ORM\Table(name="location_type")
 * @ORM\Entity
 */
class LocationType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="location_type_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $locationTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="location_type_name", type="string", length=45, nullable=false)
     */
    private $locationTypeName;

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
     * Get locationTypeId
     *
     * @return integer 
     */
    public function getLocationTypeId()
    {
        return $this->locationTypeId;
    }

    /**
     * Set locationTypeName
     *
     * @param string $locationTypeName
     * @return LocationType
     */
    public function setLocationTypeName($locationTypeName)
    {
        $this->locationTypeName = $locationTypeName;
    
        return $this;
    }

    /**
     * Get locationTypeName
     *
     * @return string 
     */
    public function getLocationTypeName()
    {
        return $this->locationTypeName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return LocationType
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
    	return $this->locationTypeName;
    }
}