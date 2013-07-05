<?php

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