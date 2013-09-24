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
 * EventType
 *
 * @ORM\Table(name="event_type")
 * @ORM\Entity
 */
class EventType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="event_type_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $eventTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="event_type_desc", type="string", length=45, nullable=false)
     */
    private $eventTypeDesc;



    /**
     * Get eventTypeId
     *
     * @return integer 
     */
    public function getEventTypeId()
    {
        return $this->eventTypeId;
    }

    /**
     * Set eventTypeDesc
     *
     * @param string $eventTypeDesc
     * @return EventType
     */
    public function setEventTypeDesc($eventTypeDesc)
    {
        $this->eventTypeDesc = $eventTypeDesc;
    
        return $this;
    }

    /**
     * Get eventTypeDesc
     *
     * @return string 
     */
    public function getEventTypeDesc()
    {
        return $this->eventTypeDesc;
    }
}