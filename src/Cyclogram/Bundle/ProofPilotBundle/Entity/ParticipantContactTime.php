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
 * ParticipantContactTime
 *
 * @ORM\Table(name="participant_contact_time")
 * @ORM\Entity(repositoryClass="Cyclogram\Bundle\ProofPilotBundle\Repository\ParticipantContactTimeRepository")
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
     * @var \DateTime
     *
     * @ORM\Column(name="participant_contact_times_range_start", type="time", length=45)
     */
    private $participantContactTimesRangeStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="participant_contact_times_range_end", type="time", length=45)
     */
    private $participantContactTimesRangeEnd;

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
        $messages = array('time_early_am', 'time_morning', 'time_afternoon',
                'time_early_evening', 'time_night', 'time_late_night',
                'day_sunday', 'day_monday', 'day_tuesday', 'day_wednesday',
                'day_thursday', 'day_friday', 'day_saturday');

        $translations = array();

        foreach ($messages as $message) {
            $translations[] = new \JMS\TranslationBundle\Model\Message(
                    $message, "contact_preferences");
        }

        return $translations;
    }

    public function getParticipantContactTimesRangeStart()
    {
        return $this->participantContactTimesRangeStart;
    }
    public function getParticipantContactTimesRangeEnd()
    {
        return $this->participantContactTimesRangeEnd;
    }


}
