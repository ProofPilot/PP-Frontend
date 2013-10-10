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
 * ParticipantArmLink
 *
 * @ORM\Table(name="participant_arm_link")
 * @ORM\Entity(repositoryClass="Cyclogram\Bundle\ProofPilotBundle\Repository\ParticipantArmLinkRepository")
 */
class ParticipantArmLink
{
    const STATUS_ACTIVE =1;
    /**
     * @var integer
     *
     * @ORM\Column(name="participant_arm_link_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $participantArmLinkId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="participant_arm_link_datetime", type="datetime", nullable=true)
     */
    private $participantArmLinkDatetime;

    /**
     * @var \Arm
     *
     * @ORM\ManyToOne(targetEntity="Arm")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="arm_id", referencedColumnName="arm_id")
     * })
     */
    private $arm;

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
     * Get participantArmLinkId
     *
     * @return integer 
     */
    public function getParticipantArmLinkId()
    {
        return $this->participantArmLinkId;
    }

    /**
     * Set participantArmLinkDatetime
     *
     * @param \DateTime $participantArmLinkDatetime
     * @return ParticipantArmLink
     */
    public function setParticipantArmLinkDatetime($participantArmLinkDatetime)
    {
        $this->participantArmLinkDatetime = $participantArmLinkDatetime;
    
        return $this;
    }

    /**
     * Get participantArmLinkDatetime
     *
     * @return \DateTime 
     */
    public function getParticipantArmLinkDatetime()
    {
        return $this->participantArmLinkDatetime;
    }

    /**
     * Set arm
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Arm $arm
     * @return ParticipantArmLink
     */
    public function setArm(\Cyclogram\Bundle\ProofPilotBundle\Entity\Arm $arm = null)
    {
        $this->arm = $arm;
    
        return $this;
    }

    /**
     * Get arm
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Arm 
     */
    public function getArm()
    {
        return $this->arm;
    }

    /**
     * Set participant
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participant
     * @return ParticipantArmLink
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
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return ParticipantArmLink
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
}