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
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity
 */
class Event
{
    /**
     * @var integer
     *
     * @ORM\Column(name="event_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $eventId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="event_datetime", type="datetime", nullable=true)
     */
    private $eventDatetime;

    /**
     * @var string
     *
     * @ORM\Column(name="event_ip", type="string", length=20, nullable=false)
     */
    private $eventIp;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="participant_id", type="integer", nullable=true)
     */
    private $participantId;

    /**
     * @var string
     *
     * @ORM\Column(name="event_description", type="string", length=45, nullable=true)
     */
    private $eventDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="event_controller", type="string", length=100, nullable=true)
     */
    private $eventController;

    /**
     * @var string
     *
     * @ORM\Column(name="event_extra", type="string", length=2000, nullable=true)
     */
    private $eventExtra;

    /**
     * @var \EventType
     *
     * @ORM\ManyToOne(targetEntity="EventType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="event_type_id", referencedColumnName="event_type_id")
     * })
     */
    private $eventType;



    /**
     * Get eventId
     *
     * @return integer 
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * Set eventDatetime
     *
     * @param \DateTime $eventDatetime
     * @return Event
     */
    public function setEventDatetime($eventDatetime)
    {
        $this->eventDatetime = $eventDatetime;
    
        return $this;
    }

    /**
     * Get eventDatetime
     *
     * @return \DateTime 
     */
    public function getEventDatetime()
    {
        return $this->eventDatetime;
    }

    /**
     * Set eventIp
     *
     * @param string $eventIp
     * @return Event
     */
    public function setEventIp($eventIp)
    {
        $this->eventIp = $eventIp;
    
        return $this;
    }

    /**
     * Get eventIp
     *
     * @return string 
     */
    public function getEventIp()
    {
        return $this->eventIp;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return Event
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    
        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set participantId
     *
     * @param integer $participantId
     * @return Event
     */
    public function setParticipantId($participantId)
    {
        $this->participantId = $participantId;
    
        return $this;
    }

    /**
     * Get participantId
     *
     * @return integer 
     */
    public function getParticipantId()
    {
        return $this->participantId;
    }

    /**
     * Set eventDescription
     *
     * @param string $eventDescription
     * @return Event
     */
    public function setEventDescription($eventDescription)
    {
        $this->eventDescription = $eventDescription;
    
        return $this;
    }

    /**
     * Get eventDescription
     *
     * @return string 
     */
    public function getEventDescription()
    {
        return $this->eventDescription;
    }

    /**
     * Set eventController
     *
     * @param string $eventController
     * @return Event
     */
    public function setEventController($eventController)
    {
        $this->eventController = $eventController;
    
        return $this;
    }

    /**
     * Get eventController
     *
     * @return string 
     */
    public function getEventController()
    {
        return $this->eventController;
    }

    /**
     * Set eventExtra
     *
     * @param string $eventExtra
     * @return Event
     */
    public function setEventExtra($eventExtra)
    {
        $this->eventExtra = $eventExtra;
    
        return $this;
    }

    /**
     * Get eventExtra
     *
     * @return string 
     */
    public function getEventExtra()
    {
        return $this->eventExtra;
    }

    /**
     * Set eventType
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\EventType $eventType
     * @return Event
     */
    public function setEventType(\Cyclogram\Bundle\ProofPilotBundle\Entity\EventType $eventType = null)
    {
        $this->eventType = $eventType;
    
        return $this;
    }

    /**
     * Get eventType
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\EventType 
     */
    public function getEventType()
    {
        return $this->eventType;
    }
}