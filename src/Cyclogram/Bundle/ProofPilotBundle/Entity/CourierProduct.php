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
 * CourierProduct
 *
 * @ORM\Table(name="courier_product")
 * @ORM\Entity
 */
class CourierProduct
{
    
    const STATUS_ACTIVE = 1;
    /**
     * @var integer
     *
     * @ORM\Column(name="courier_product_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $courierProductId;

    /**
     * @var string
     *
     * @ORM\Column(name="courier_product_name", type="string", length=45, nullable=false)
     */
    private $courierProductName;

    /**
     * @var \Courier
     *
     * @ORM\ManyToOne(targetEntity="Courier")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="courier_id", referencedColumnName="courier_id")
     * })
     */
    private $courier;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=false)
     */
    private $status;



    /**
     * Get courierProductId
     *
     * @return integer 
     */
    public function getCourierProductId()
    {
        return $this->courierProductId;
    }

    /**
     * Set courierProductName
     *
     * @param string $courierProductName
     * @return CourierProduct
     */
    public function setCourierProductName($courierProductName)
    {
        $this->courierProductName = $courierProductName;
    
        return $this;
    }

    /**
     * Get courierProductName
     *
     * @return string 
     */
    public function getCourierProductName()
    {
        return $this->courierProductName;
    }

    /**
     * Set courier
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Courier $courier
     * @return CourierProduct
     */
    public function setCourier(\Cyclogram\Bundle\ProofPilotBundle\Entity\Courier $courier = null)
    {
        $this->courier = $courier;
    
        return $this;
    }

    /**
     * Get courier
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Courier 
     */
    public function getCourier()
    {
        return $this->courier;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return CourierProduct
     */
    public function setStatus($status)
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
    	return $this->courierProductName;
    }
}