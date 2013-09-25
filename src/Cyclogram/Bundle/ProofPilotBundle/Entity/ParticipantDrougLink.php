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
 * ParticipantDrougLink
 *
 * @ORM\Table(name="participant_droug_link")
 * @ORM\Entity
 */
class ParticipantDrougLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="participant_droug_link_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $participantDrougLinkId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="participant_droug_link_share_needles", type="boolean", nullable=false)
     */
    private $participantDrougLinkShareNeedles;

    /**
     * @var \Droug
     *
     * @ORM\ManyToOne(targetEntity="Droug")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="droug_id", referencedColumnName="droug_id")
     * })
     */
    private $droug;

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
     * Get participantDrougLinkId
     *
     * @return integer 
     */
    public function getParticipantDrougLinkId()
    {
        return $this->participantDrougLinkId;
    }

    /**
     * Set participantDrougLinkShareNeedles
     *
     * @param boolean $participantDrougLinkShareNeedles
     * @return ParticipantDrougLink
     */
    public function setParticipantDrougLinkShareNeedles($participantDrougLinkShareNeedles)
    {
        $this->participantDrougLinkShareNeedles = $participantDrougLinkShareNeedles;
    
        return $this;
    }

    /**
     * Get participantDrougLinkShareNeedles
     *
     * @return boolean 
     */
    public function getParticipantDrougLinkShareNeedles()
    {
        return $this->participantDrougLinkShareNeedles;
    }

    /**
     * Set droug
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Droug $droug
     * @return ParticipantDrougLink
     */
    public function setDroug(\Cyclogram\Bundle\ProofPilotBundle\Entity\Droug $droug = null)
    {
        $this->droug = $droug;
    
        return $this;
    }

    /**
     * Get droug
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Droug 
     */
    public function getDroug()
    {
        return $this->droug;
    }

    /**
     * Set participant
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participant
     * @return ParticipantDrougLink
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
}