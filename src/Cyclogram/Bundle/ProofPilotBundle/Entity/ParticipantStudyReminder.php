<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParticipantStudyReminder
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ParticipantStudyReminder
{
    /**
     * @var integer
     *
     * @ORM\Column(name="participantStudyReminderId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $participantStudyReminderId;

    /**
     * @var string
     *
     * @ORM\Column(name="participantStudyReminderName", type="string", length=45)
     */
    private $participantStudyReminderName;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set participantStudyReminderId
     *
     * @param integer $participantStudyReminderId
     * @return ParticipantStudyReminder
     */
    public function setParticipantStudyReminderId($participantStudyReminderId)
    {
        $this->participantStudyReminderId = $participantStudyReminderId;
    
        return $this;
    }

    /**
     * Get participantStudyReminderId
     *
     * @return integer 
     */
    public function getParticipantStudyReminderId()
    {
        return $this->participantStudyReminderId;
    }

    /**
     * Set participantStudyReminderName
     *
     * @param string $participantStudyReminderName
     * @return ParticipantStudyReminder
     */
    public function setParticipantStudyReminderName($participantStudyReminderName)
    {
        $this->participantStudyReminderName = $participantStudyReminderName;
    
        return $this;
    }

    /**
     * Get participantStudyReminderName
     *
     * @return string 
     */
    public function getParticipantStudyReminderName()
    {
        return $this->participantStudyReminderName;
    }
}
