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
 * RecoveryQuestion
 *
 * @ORM\Table(name="recovery_question")
 * @ORM\Entity
 */
class RecoveryQuestion
{
    const STATUS_ACTIVE =1;
    /**
     * @var integer
     *
     * @ORM\Column(name="recovery_question_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $recoveryQuestionId;

    /**
     * @var string
     *
     * @ORM\Column(name="recovery_question_name", type="string", length=145, nullable=false)
     */
    protected $recoveryQuestionName;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=false)
     */
    protected $status;



    /**
     * Get recoveryQuestionId
     *
     * @return integer 
     */
    public function getRecoveryQuestionId()
    {
        return $this->recoveryQuestionId;
    }

    /**
     * Set recoveryQuestionName
     *
     * @param string $recoveryQuestionName
     * @return RecoveryQuestion
     */
    public function setRecoveryQuestionName($recoveryQuestionName)
    {
        $this->recoveryQuestionName = $recoveryQuestionName;
    
        return $this;
    }

    /**
     * Get recoveryQuestionName
     *
     * @return string 
     */
    public function getRecoveryQuestionName()
    {
        return $this->recoveryQuestionName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return RecoveryQuestion
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