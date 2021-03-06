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
 * Device
 *
 * @ORM\Table(name="device")
 * @ORM\Entity
 */
class Device
{
    
    const STATUS_ACTIVE = 1;
    /**
     * @var integer
     *
     * @ORM\Column(name="device_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $deviceId;

    /**
     * @var string
     *
     * @ORM\Column(name="device_udid", type="string", length=45, nullable=true)
     */
    private $deviceUdid;

    /**
     * @var string
     *
     * @ORM\Column(name="device_token", type="string", length=145, nullable=true)
     */
    private $deviceToken;

    /**
     * @var string
     *
     * @ORM\Column(name="device_desc", type="string", length=145, nullable=false)
     */
    private $deviceDesc;

    /**
     * @var boolean
     *
     * @ORM\Column(name="device_used", type="boolean", nullable=false)
     */
    private $deviceUsed;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=false)
     */
    private $status;



    /**
     * Get deviceId
     *
     * @return integer 
     */
    public function getDeviceId()
    {
        return $this->deviceId;
    }

    /**
     * Set deviceUdid
     *
     * @param string $deviceUdid
     * @return Device
     */
    public function setDeviceUdid($deviceUdid)
    {
        $this->deviceUdid = $deviceUdid;
    
        return $this;
    }

    /**
     * Get deviceUdid
     *
     * @return string 
     */
    public function getDeviceUdid()
    {
        return $this->deviceUdid;
    }

    /**
     * Set deviceToken
     *
     * @param string $deviceToken
     * @return Device
     */
    public function setDeviceToken($deviceToken)
    {
        $this->deviceToken = $deviceToken;
    
        return $this;
    }

    /**
     * Get deviceToken
     *
     * @return string 
     */
    public function getDeviceToken()
    {
        return $this->deviceToken;
    }

    /**
     * Set deviceDesc
     *
     * @param string $deviceDesc
     * @return Device
     */
    public function setDeviceDesc($deviceDesc)
    {
        $this->deviceDesc = $deviceDesc;
    
        return $this;
    }

    /**
     * Get deviceDesc
     *
     * @return string 
     */
    public function getDeviceDesc()
    {
        return $this->deviceDesc;
    }

    /**
     * Set deviceUsed
     *
     * @param boolean $deviceUsed
     * @return Device
     */
    public function setDeviceUsed($deviceUsed)
    {
        $this->deviceUsed = $deviceUsed;
    
        return $this;
    }

    /**
     * Get deviceUsed
     *
     * @return boolean 
     */
    public function getDeviceUsed()
    {
        return $this->deviceUsed;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return Device
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
}