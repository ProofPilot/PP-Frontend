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
 * AppointmentStatus
 *
 * @ORM\Table(name="appointment_status")
 * @ORM\Entity
 */
class AppointmentStatus
{
    /**
     * @var integer
     *
     * @ORM\Column(name="appointment_status_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $appointmentStatusId;

    /**
     * @var string
     *
     * @ORM\Column(name="appointment_status_name", type="string", length=45, nullable=false)
     */
    private $appointmentStatusName;



    /**
     * Get appointmentStatusId
     *
     * @return integer 
     */
    public function getAppointmentStatusId()
    {
        return $this->appointmentStatusId;
    }

    /**
     * Set appointmentStatusName
     *
     * @param string $appointmentStatusName
     * @return AppointmentStatus
     */
    public function setAppointmentStatusName($appointmentStatusName)
    {
        $this->appointmentStatusName = $appointmentStatusName;
    
        return $this;
    }

    /**
     * Get appointmentStatusName
     *
     * @return string 
     */
    public function getAppointmentStatusName()
    {
        return $this->appointmentStatusName;
    }
    
    public function __toString() {
    	return $this->appointmentStatusName;
    }
}