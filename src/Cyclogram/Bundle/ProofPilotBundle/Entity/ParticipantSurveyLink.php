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
 * ParticipantSurveyLink
 *
 * @ORM\Table(name="participant_survey_link")
 * @ORM\Entity(repositoryClass="Cyclogram\Bundle\ProofPilotBundle\Repository\ParticipantSurveyLinkRepository")
 */
class ParticipantSurveyLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="participant_survey_link_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $participantSurveyLinkId;

    /**
     * @var string
     *
     * @ORM\Column(name="participant_survey_link_uniqid", type="string", length=45, nullable=true)
     */
    private $participantSurveyLinkUniqid;

    /**
     * @var integer
     *
     * @ORM\Column(name="sid_id", type="integer", nullable=false)
     */
    private $sidId;

    /**
     * @var integer
     *
     * @ORM\Column(name="save_id", type="integer", nullable=false)
     */
    private $saveId;

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
     * @var smallint $participantSurveyLinkElegibility
     *
     * @ORM\Column(name="participant_survey_link_elegibility", type="smallint", nullable=true)
     */
    private $participantSurveyLinkElegibility;



    /**
     * Get participantSurveyLinkId
     *
     * @return integer 
     */
    public function getParticipantSurveyLinkId()
    {
        return $this->participantSurveyLinkId;
    }

    /**
     * Set participantSurveyLinkUniqid
     *
     * @param string $participantSurveyLinkUniqid
     * @return ParticipantSurveyLink
     */
    public function setParticipantSurveyLinkUniqid($participantSurveyLinkUniqid)
    {
        $this->participantSurveyLinkUniqid = $participantSurveyLinkUniqid;
    
        return $this;
    }

    /**
     * Get participantSurveyLinkUniqid
     *
     * @return string 
     */
    public function getParticipantSurveyLinkUniqid()
    {
        return $this->participantSurveyLinkUniqid;
    }

    /**
     * Set sidId
     *
     * @param integer $sidId
     * @return ParticipantSurveyLink
     */
    public function setSidId($sidId)
    {
        $this->sidId = $sidId;
    
        return $this;
    }

    /**
     * Get sidId
     *
     * @return integer 
     */
    public function getSidId()
    {
        return $this->sidId;
    }

    /**
     * Set saveId
     *
     * @param integer $saveId
     * @return ParticipantSurveyLink
     */
    public function setSaveId($saveId)
    {
        $this->saveId = $saveId;
    
        return $this;
    }

    /**
     * Get saveId
     *
     * @return integer 
     */
    public function getSaveId()
    {
        return $this->saveId;
    }

    /**
     * Set participantSurveyLinkElegibility
     *
     * @param smallint $participantSurveyLinkElegibility
     */
    public function setParticipantSurveyLinkElegibility($participantSurveyLinkElegibility)
    {
        $this->participantSurveyLinkElegibility = $participantSurveyLinkElegibility;
    }

    /**
     * Get participantSurveyLinkElegibility
     *
     * @return smallint
     */
    public function getParticipantSurveyLinkElegibility()
    {
        return $this->participantSurveyLinkElegibility;
    }

    /**
     * Set participant
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participant
     * @return ParticipantSurveyLink
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