<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecoveryQuestion
 *
 * @ORM\Table(name="recovery_question")
 * @ORM\Entity
 */
class RecoveryQuestion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="recovery_question_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $recoveryQuestionId;

    /**
     * @var string
     *
     * @ORM\Column(name="recovery_question_name", type="string", length=145, nullable=false)
     */
    private $recoveryQuestionName;

    /**
     * @var \Status
     *
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="status_id")
     * })
     */
    private $status;



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
    public function setStatus(\Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status = null)
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