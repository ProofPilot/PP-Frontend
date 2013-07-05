<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AppointmentInterventionLink
 *
 * @ORM\Table(name="appointment_intervention_link")
 * @ORM\Entity
 */
class AppointmentInterventionLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="appointment_intervention_link_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $appointmentInterventionLinkId;

    /**
     * @var \Appointment
     *
     * @ORM\ManyToOne(targetEntity="Appointment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="appointment_id", referencedColumnName="appointment_id")
     * })
     */
    private $appointment;

    /**
     * @var \Intervention
     *
     * @ORM\ManyToOne(targetEntity="Intervention")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="intervention_id", referencedColumnName="intervention_id")
     * })
     */
    private $intervention;



    /**
     * Get appointmentInterventionLinkId
     *
     * @return integer 
     */
    public function getAppointmentInterventionLinkId()
    {
        return $this->appointmentInterventionLinkId;
    }

    /**
     * Set appointment
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Appointment $appointment
     * @return AppointmentInterventionLink
     */
    public function setAppointment(\Cyclogram\Bundle\ProofPilotBundle\Entity\Appointment $appointment = null)
    {
        $this->appointment = $appointment;
    
        return $this;
    }

    /**
     * Get appointment
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Appointment 
     */
    public function getAppointment()
    {
        return $this->appointment;
    }

    /**
     * Set intervention
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Intervention $intervention
     * @return AppointmentInterventionLink
     */
    public function setIntervention(\Cyclogram\Bundle\ProofPilotBundle\Entity\Intervention $intervention = null)
    {
        $this->intervention = $intervention;
    
        return $this;
    }

    /**
     * Get intervention
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Intervention 
     */
    public function getIntervention()
    {
        return $this->intervention;
    }
}