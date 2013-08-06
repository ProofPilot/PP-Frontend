<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;
use JMS\TranslationBundle\Translation\TranslationContainerInterface;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParticipantContactTime
 *
 * @ORM\Table(name="participant_contact_time")
 * @ORM\Entity
 */
class ParticipantContactTime implements TranslationContainerInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="participant_contact_times_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $participantContactTimesId;

    /**
     * @var string
     *
     * @ORM\Column(name="participant_contact_times_name", type="string", length=45)
     */
    private $participantContactTimesName;

    /**
     * Set participantContactTimesId
     *
     * @param integer $participantContactTimesId
     * @return ParticipantContactTime
     */
    public function setParticipantContactTimesId($participantContactTimesId)
    {
        $this->participantContactTimesId = $participantContactTimesId;

        return $this;
    }

    /**
     * Get participantContactTimesId
     *
     * @return integer 
     */
    public function getParticipantContactTimesId()
    {
        return $this->participantContactTimesId;
    }

    /**
     * Set participantContactTimesName
     *
     * @param string $participantContactTimesName
     * @return ParticipantContactTime
     */
    public function setParticipantContactTimesName(
            $participantContactTimesName)
    {
        $this->participantContactTimesName = $participantContactTimesName;

        return $this;
    }

    /**
     * Get participantContactTimesName
     *
     * @return string 
     */
    public function getParticipantContactTimesName()
    {
        return $this->participantContactTimesName;
    }
    public static function getTranslationMessages()
    {
        $messages =  array(
                'time_early_am',
                'time_morning',
                'time_afternoon',
                'time_early_evening',
                'time_night',
                'time_late_night',
                'day_sunday',
                'day_monday',
                'day_tuesday',
                'day_wednesday',
                'day_thursday',
                'day_friday',
                'day_saturday'
        );
        
        $translations = array();
        
        foreach($messages as $message) {
            $translations[] = new \JMS\TranslationBundle\Model\Message($message, "contact_preferences");
        }
        
        return $translations;
    }

}
