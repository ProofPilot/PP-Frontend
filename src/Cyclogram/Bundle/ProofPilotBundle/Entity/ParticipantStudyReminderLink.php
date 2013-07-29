<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParticipantStudyReminderLink
 *
 * @ORM\Table(name="participant_study_reminder_link")
 * @ORM\Entity
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
     * @ORM\ManyToOne(targetEntity="Participant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="participant_id", referencedColumnName="participant_id")
     * })
     */
    private $participantId;

    /**
     * @var \ParticipantStudyReminder
     *
     * @ORM\ManyToOne(targetEntity="ParticipantStudyReminder")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="participant_study_reminder_id", referencedColumnName="participant_study_reminder_id")
     * })
     */
    private $participantStudyReminderId;

    /**
     * @var integer
     *
     * @ORM\Column(name="by_sms", type="integer")
     */
    private $bySMS;

    /**
     * @var integer
     *
     * @ORM\Column(name="by_email", type="integer")
     */
    private $byEmail;

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
     * Set participantId
     *
     * @param integer $participantId
     * @return ParticipantStudyReminderLink
     */
    public function setParticipantId(\Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participantId = null)
    {
        $this->participantId = $participantId;
    
        return $this;
    }

    /**
     * Get participantId
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Participant
     */
    public function getParticipantId()
    {
        return $this->participantId;
    }

    /**
     * Set participantStudyReminderId
     *
     * @param integer $participantStudyReminderId
     * @return ParticipantStudyReminderLink
     */
    public function setParticipantStudyReminderId(\Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantStudyReminder $participantStudyReminderId = null)
    {
        $this->participantStudyReminderId = $participantStudyReminderId;
    
        return $this;
    }

    /**
     * Get participantStudyReminderId
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantStudyReminder 
     */
    public function getParticipantStudyReminderId()
    {
        return $this->participantStudyReminderId;
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
