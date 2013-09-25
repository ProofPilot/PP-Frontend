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


use JMS\TranslationBundle\Translation\TranslationContainerInterface;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParticipantStudyReminder
 *
 * @ORM\Table(name="participant_study_reminder")
 * @ORM\Entity
 */
class ParticipantStudyReminder implements TranslationContainerInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="participant_study_reminder_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $participantStudyReminderId;

    /**
     * @var string
     *
     * @ORM\Column(name="participant_study_reminder_name", type="string", length=45)
     */
    private $participantStudyReminderName;

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
    public function setParticipantStudyReminderName(
            $participantStudyReminderName)
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
    
    
    public static function getTranslationMessages()
    {
        $messages =  array(
                'reminder_study_task',
                'reminder_orders',
                'reminder_other_studies'
                );
        
        $translations = array();
        
        foreach($messages as $message) {
            $translations[] = new \JMS\TranslationBundle\Model\Message($message, "contact_preferences");
        }
        
        return $translations;

    }

}
