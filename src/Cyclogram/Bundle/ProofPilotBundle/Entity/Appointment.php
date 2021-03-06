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
 * Appointment
 *
 * @ORM\Table(name="appointment")
 * @ORM\Entity
 */
class Appointment
{
    
    const STATUS_ACTIVE = 1;
    /**
     * @var integer
     *
     * @ORM\Column(name="appointment_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $appointmentId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="appointment_datetime", type="datetime", nullable=false)
     */
    private $appointmentDatetime;

    /**
     * @var \AppointmentStatus
     *
     * @ORM\ManyToOne(targetEntity="AppointmentStatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="appointment_status_id", referencedColumnName="appointment_status_id")
     * })
     */
    private $appointmentStatus;

    /**
     * @var \AppointmentType
     *
     * @ORM\ManyToOne(targetEntity="AppointmentType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="appointment_type_id", referencedColumnName="appointment_type_id")
     * })
     */
    private $appointmentType;

    /**
     * @var \Individual
     *
     * @ORM\ManyToOne(targetEntity="Individual")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="individual_id", referencedColumnName="individual_id")
     * })
     */
    private $individual;

    /**
     * @var \Organization
     *
     * @ORM\ManyToOne(targetEntity="Organization")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="organization_id", referencedColumnName="organization_id")
     * })
     */
    private $organization;

    /**
     * @var \Participant
     *
     * @ORM\ManyToOne(targetEntity="Participant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="participant_id", referencedColumnName="participant_id")
     * })
     */
    private $participant;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=false)
     */
    private $status;

    /**
     * @var \Test
     *
     * @ORM\ManyToOne(targetEntity="Test")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="test_id", referencedColumnName="test_id")
     * })
     */
    private $test;



    /**
     * Get appointmentId
     *
     * @return integer 
     */
    public function getAppointmentId()
    {
        return $this->appointmentId;
    }

    /**
     * Set appointmentDatetime
     *
     * @param \DateTime $appointmentDatetime
     * @return Appointment
     */
    public function setAppointmentDatetime($appointmentDatetime)
    {
        $this->appointmentDatetime = $appointmentDatetime;
    
        return $this;
    }

    /**
     * Get appointmentDatetime
     *
     * @return \DateTime 
     */
    public function getAppointmentDatetime()
    {
        return $this->appointmentDatetime;
    }

    /**
     * Set appointmentStatus
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\AppointmentStatus $appointmentStatus
     * @return Appointment
     */
    public function setAppointmentStatus(\Cyclogram\Bundle\ProofPilotBundle\Entity\AppointmentStatus $appointmentStatus = null)
    {
        $this->appointmentStatus = $appointmentStatus;
    
        return $this;
    }

    /**
     * Get appointmentStatus
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\AppointmentStatus 
     */
    public function getAppointmentStatus()
    {
        return $this->appointmentStatus;
    }

    /**
     * Set appointmentType
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\AppointmentType $appointmentType
     * @return Appointment
     */
    public function setAppointmentType(\Cyclogram\Bundle\ProofPilotBundle\Entity\AppointmentType $appointmentType = null)
    {
        $this->appointmentType = $appointmentType;
    
        return $this;
    }

    /**
     * Get appointmentType
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\AppointmentType 
     */
    public function getAppointmentType()
    {
        return $this->appointmentType;
    }

    /**
     * Set individual
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Individual $individual
     * @return Appointment
     */
    public function setIndividual(\Cyclogram\Bundle\ProofPilotBundle\Entity\Individual $individual = null)
    {
        $this->individual = $individual;
    
        return $this;
    }

    /**
     * Get individual
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Individual 
     */
    public function getIndividual()
    {
        return $this->individual;
    }

    /**
     * Set organization
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Organization $organization
     * @return Appointment
     */
    public function setOrganization(\Cyclogram\Bundle\ProofPilotBundle\Entity\Organization $organization = null)
    {
        $this->organization = $organization;
    
        return $this;
    }

    /**
     * Get organization
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Organization 
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Set participant
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participant
     * @return Appointment
     */
    public function setParticipant(\Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participant = null)
    {
        $this->participant = $participant;
    
        return $this;
    }

    /**
     * Get participant
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Participant 
     */
    public function getParticipant()
    {
        return $this->participant;
    }

    /**
     * Set status
     *
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

    /**
     * Set test
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Test $test
     * @return Appointment
     */
    public function setTest(\Cyclogram\Bundle\ProofPilotBundle\Entity\Test $test = null)
    {
        $this->test = $test;
    
        return $this;
    }

    /**
     * Get test
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Test 
     */
    public function getTest()
    {
        return $this->test;
    }
}