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
 * SexWith
 *
 * @ORM\Table(name="sex_with")
 * @ORM\Entity
 */
class SexWith
{
    /**
     * @var integer
     *
     * @ORM\Column(name="sex_with_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $sexWithId;

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
     * @var \Sex
     *
     * @ORM\ManyToOne(targetEntity="Sex")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sex_id", referencedColumnName="sex_id")
     * })
     */
    private $sex;



    /**
     * Get sexWithId
     *
     * @return integer 
     */
    public function getSexWithId()
    {
        return $this->sexWithId;
    }

    /**
     * Set participant
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participant
     * @return SexWith
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
     * Set sex
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Sex $sex
     * @return SexWith
     */
    public function setSex(\Cyclogram\Bundle\ProofPilotBundle\Entity\Sex $sex = null)
    {
        $this->sex = $sex;
    
        return $this;
    }

    /**
     * Get sex
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Sex 
     */
    public function getSex()
    {
        return $this->sex;
    }
}