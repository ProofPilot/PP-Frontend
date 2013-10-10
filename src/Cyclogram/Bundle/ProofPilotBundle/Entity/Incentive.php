<?php
namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Incentive
 *
 * @ORM\Table(name="incentive")
 * @ORM\Entity(repositoryClass="Cyclogram\Bundle\ProofPilotBundle\Repository\IncentiveRepository")
 */
class Incentive
{
    
    const STATUS_PENDING_APPROVAL = 25;
    /**
     * @var integer
     *
     * @ORM\Column(name="incentive_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $incentiveId;

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
     * @var \DateTime
     *
     * @ORM\Column(name="incentive_datetime", type="datetime", nullable=false)
     */
    protected $incentiveDatetime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="incentive_datetime_approved", type="datetime", nullable=true)
     */
    protected $incentiveDatetimeApproved;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="incentive_datetime_processed", type="datetime", nullable=true)
     */
    protected $incentiveDatetimeProcessed;

    /**
     * @var string
     *
     * @ORM\Column(name="fulfillment_by", type="string", length=255, nullable=true)
     */
    private $fulfillmentBy;

    /**
     * @var string
     *
     * @ORM\Column(name="fulfillment_confirmation_number", type="string", length=45, nullable=true)
     */
    private $fulfillmentConfirmationNumber;

    /**
     * @var float
     *
     * @ORM\Column(name="incentive_amount", type="float", nullable=false)
     */
    private $incentiveAmount;

    /**
     * @var \Participant
     *
     * @ORM\ManyToOne(targetEntity="IncentiveType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="incentive_type_id", referencedColumnName="incentive_type_id")
     * })
     */
    private $incentiveType;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=false)
     */
    protected $status;

    /**
     * @var \Intervention
     *
     * @ORM\ManyToOne(targetEntity="Intervention")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="intervention_intervention_id", referencedColumnName="intervention_id")
     * })
     */
    private $intervention;

    /**
     * @var string
     *
     * @ORM\Column(name="intervention_language_id", type="string", length=45, nullable=false)
     */
    private $interventionLanguageid;

    public function getIncentiveId()
    {
        return $this->incentiveId;
    }

    public function setIncentiveId($incentiveId)
    {
        $this->incentiveId = $incentiveId;
    }

    public function getParticipant()
    {
        return $this->participant;
    }

    public function setParticipant(\Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participant = null)
    {
        $this->participant = $participant;
    }

    public function getIncentiveDatetime()
    {
        return $this->incentiveDatetime;
    }

    public function setIncentiveDatetime($incentiveDatetime)
    {
        $this->incentiveDatetime = $incentiveDatetime;
    }

    public function getIncentiveDatetimeApproved()
    {
        return $this->incentiveDatetimeApproved;
    }

    public function setIncentiveDatetimeApproved($incentiveDatetimeApproved)
    {
        $this->incentiveDatetimeApproved = $incentiveDatetimeApproved;
    }

    public function getIncentiveDatetimeProcessed()
    {
        return $this->incentiveDatetimeProcessed;
    }

    public function setIncentiveDatetimeProcessed($incentiveDatetimeProcessed)
    {
        $this->incentiveDatetimeProcessed = $incentiveDatetimeProcessed;
    }

    public function getFulfillmentBy()
    {
        return $this->fulfillmentBy;
    }

    public function setFulfillmentBy($fulfillmentBy)
    {
        $this->fulfillmentBy = $fulfillmentBy;
    }

    public function getFulfillmentConfirmationNumber()
    {
        return $this->fulfillmentConfirmationNumber;
    }

    public function setFulfillmentConfirmationNumber($fulfillmentConfirmationNumber)
    {
        $this->fulfillmentConfirmationNumber = $fulfillmentConfirmationNumber;
    }

    public function getIncentiveAmount()
    {
        return $this->incentiveAmount;
    }

    public function setIncentiveAmount($incentiveAmount)
    {
        $this->incentiveAmount = $incentiveAmount;
    }

    public function getIncentiveType()
    {
        return $this->incentiveType;
    }

    public function setIncentiveType(\Cyclogram\Bundle\ProofPilotBundle\Entity\IncentiveType $incentiveType = null )
    {
        $this->incentiveType = $incentiveType;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getIntervention()
    {
        return $this->intervention;
    }

    public function setIntervention(\Cyclogram\Bundle\ProofPilotBundle\Entity\Intervention $intervention = null)
    {
        $this->intervention = $intervention;
    }

    public function getInterventionLanguageid()
    {
        return $this->interventionLanguageid;
    }

    public function setInterventionLanguageid($interventionLanguageid)
    {
        $this->interventionLanguageid = $interventionLanguageid;
    }

}
