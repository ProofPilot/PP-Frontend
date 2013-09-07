<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParticipantStudyReminderLink
 *
 * @ORM\Table(name="participant_study_reminder_link")
 * @ORM\Entity(repositoryClass="Cyclogram\Bundle\ProofPilotBundle\Repository\ParticipantStudyReminderLinkRepository")
 */
class ParticipantStudyReminderLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="participant_study_reminder_link_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $participantStudyReminderLinkId;

    /**
     * @var \Participant
     *
     * @ORM\ManyToOne(targetEntity="Participant", inversedBy="studyReminders")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="participant_id", referencedColumnName="participant_id")
     * })
     */
    private $participant;

    /**
     * @var \ParticipantStudyReminder
     *
     * @ORM\ManyToOne(targetEntity="ParticipantStudyReminder")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="participant_study_reminder_id", referencedColumnName="participant_study_reminder_id")
     * })
     */
    private $participantStudyReminder;

    /**
     * @var integer
     *
     * @ORM\Column(name="by_sms", type="integer")
     */
    private $bySMS = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="by_email", type="integer")
     */
    private $byEmail = false;

    /**
     * Set participantStudyReminderLinkId
     *
     * @param integer $participantStudyReminderLinkId
     * @return ParticipantStudyReminderLink
     */
    public function setParticipantStudyReminderLinkId($participantStudyReminderLinkId)
    {
        $this->participantStudyReminderLinkId = $participantStudyReminderLinkId;
    
        return $this;
    }

    /**
     * Get participantStudyReminderLinkId
     *
     * @return integer 
     */
    public function getParticipantStudyReminderLinkId()
    {
        return $this->participantStudyReminderLinkId;
    }

    /**
     * Set participant
     *
     * @param integer $participant
     * @return ParticipantStudyReminderLink
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
     * Set participantStudyReminder
     *
     * @param integer $participantStudyReminder
     * @return ParticipantStudyReminderLink
     */
    public function setParticipantStudyReminder(\Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantStudyReminder $participantStudyReminder = null)
    {
        $this->participantStudyReminder = $participantStudyReminder;
    
        return $this;
    }

    /**
     * Get participantStudyReminder
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantStudyReminder 
     */
    public function getParticipantStudyReminder()
    {
        return $this->participantStudyReminder;
    }

    /**
     * Set bySMS
     *
     * @param integer $bySMS
     * @return ParticipantStudyReminderLink
     */
    public function setBySMS($bySMS)
    {
        $this->bySMS = $bySMS;
    
        return $this;
    }

    /**
     * Get bySMS
     *
     * @return integer 
     */
    public function getBySMS()
    {
        return $this->bySMS;
    }

    /**
     * Set byEmail
     *
     * @param integer $byEmail
     * @return ParticipantStudyReminderLink
     */
    public function setByEmail($byEmail)
    {
        $this->byEmail = $byEmail;
    
        return $this;
    }

    /**
     * Get byEmail
     *
     * @return integer 
     */
    public function getByEmail()
    {
        return $this->byEmail;
    }
}
