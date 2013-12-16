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
 * Placement
 *
 * @ORM\Table(name="participant_race_link")
 * @ORM\Entity
 */

class ParticipantRaceLink
{

    /**
     * @var integer
     *
     * @ORM\Column(name="participant_race_link_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $participantRaceLinkId;

    /**
     * @var \Participant
     *
     * @ORM\ManyToOne(targetEntity="Participant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="participant_id", referencedColumnName="participant_id", nullable=true)
     * })
     */
    protected $participant;

    /**
     * @var \Race
     *
     * @ORM\ManyToOne(targetEntity="Race")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="race_id", referencedColumnName="race_id", nullable=true)
     * })
     */
    protected $race;

    public function getParticippantRaceLinkId()
    {
        return $this->particippantRaceLinkId;
    }

    public function setParticippantRaceLinkId($particippantRaceLinkId)
    {
        $this->particippantRaceLinkId = $particippantRaceLinkId;
    }

    public function getParticipant()
    {
        return $this->participant;
    }

    public function setParticipant( \Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participant = null)
    {
        $this->participant = $participant;
    }

    public function getRace()
    {
        return $this->race;
    }

    public function setRace( \Cyclogram\Bundle\ProofPilotBundle\Entity\Race $race = null)
    {
        $this->race = $race;
    }

}
