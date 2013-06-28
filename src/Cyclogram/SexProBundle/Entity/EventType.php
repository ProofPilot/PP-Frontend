<?php

namespace Cyclogram\SexProBundle\Entity;

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