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
 * ParticipantTimezone
 *
 * @ORM\Table("participant_timezone")
 * @ORM\Entity(repositoryClass="Cyclogram\Bundle\ProofPilotBundle\Repository\ParticipantTimezoneRepository")
 */
class ParticipantTimezone
{
    /**
     * @var integer
     *
     * @ORM\Column(name="participant_timezone_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $participantTimezoneId;

    /**
     * @var string
     *
     * @ORM\Column(name="participant_timezone_desc", type="string", length=45)
     */
    protected $participantTimezoneDesc;
    
    /**
     * @var string
     *
     * @ORM\Column(name="participant_timezone_name", type="string", length=25)
     */
    protected $participantTimezoneName;

    /**
     * Set participantTimezoneId
     *
     * @param integer $participantTimezoneId
     * @return ParticipantTimezone
     */
    public function setParticipantTimezoneId($participantTimezoneId)
    {
        $this->participantTimezoneId = $participantTimezoneId;
    
        return $this;
    }

    /**
     * Get participantTimezoneId
     *
     * @return integer 
     */
    public function getParticipantTimezoneId()
    {
        return $this->participantTimezoneId;
    }

    /**
     * Set participantTimezoneDesc
     *
     * @param string $participantTimezoneDesc
     * @return ParticipantTimezone
     */
    public function setParticipantTimezoneDesc($participantTimezoneDesc)
    {
        $this->participantTimezoneDesc = $participantTimezoneDesc;
    
        return $this;
    }

    /**
     * Get participantTimezoneDesc
     *
     * @return string 
     */
    public function getParticipantTimezoneDesc()
    {
        return $this->participantTimezoneDesc;
    }

    public function getParticipantTimezoneName()
    {
        return $this->participantTimezoneName;
    }

    public function setParticipantTimezoneName($participantTimezoneName)
    {
        $this->participantTimezoneName = $participantTimezoneName;
    }
}
