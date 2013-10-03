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
 * Cyclogram\Bundle\ProofPilotBundle\Entity\TestDiseasePrevious
 *
 * @ORM\Table(name="test_disease_previous")
 * @ORM\Entity
 */
class TestDiseasePrevious
{
    /**
     * @var integer $testDiseasePreviousId
     *
     * @ORM\Column(name="test_disease_previous_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $testDiseasePreviousId;

    /**
     * @var datetime $testDiseasePreviousDatetime
     *
     * @ORM\Column(name="test_disease_previous_datetime", type="datetime", nullable=false)
     */
    private $testDiseasePreviousDatetime;

    /**
     * @var Disease
     *
     * @ORM\ManyToOne(targetEntity="Disease")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="disease_id", referencedColumnName="disease_id")
     * })
     */
    private $disease;

    /**
     * @var Participant
     *
     * @ORM\ManyToOne(targetEntity="Participant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="participant_id", referencedColumnName="participant_id")
     * })
     */
    private $participant;



    /**
     * Get testDiseasePreviousId
     *
     * @return integer 
     */
    public function getTestDiseasePreviousId()
    {
        return $this->testDiseasePreviousId;
    }

    /**
     * Set testDiseasePreviousDatetime
     *
     * @param datetime $testDiseasePreviousDatetime
     */
    public function setTestDiseasePreviousDatetime($testDiseasePreviousDatetime)
    {
        $this->testDiseasePreviousDatetime = $testDiseasePreviousDatetime;
    }

    /**
     * Get testDiseasePreviousDatetime
     *
     * @return datetime 
     */
    public function getTestDiseasePreviousDatetime()
    {
        return $this->testDiseasePreviousDatetime;
    }

    /**
     * Set disease
     *
     * @param Cyclogram\Bundle\ProofPilotBundle\Entity\Disease $disease
     */
    public function setDisease(\Cyclogram\Bundle\ProofPilotBundle\Entity\Disease $disease)
    {
        $this->disease = $disease;
    }

    /**
     * Get disease
     *
     * @return Cyclogram\Bundle\ProofPilotBundle\Entity\Disease 
     */
    public function getDisease()
    {
        return $this->disease;
    }

    /**
     * Set participant
     *
     * @param Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participant
     */
    public function setParticipant(\Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participant)
    {
        $this->participant = $participant;
    }

    /**
     * Get participant
     *
     * @return Cyclogram\Bundle\ProofPilotBundle\Entity\Participant 
     */
    public function getParticipant()
    {
        return $this->participant;
    }
}