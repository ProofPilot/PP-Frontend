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
 * AdverseReactionHistory
 *
 * @ORM\Table(name="adverse_reaction_history")
 * @ORM\Entity
 */
class AdverseReactionHistory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="adverse_reaction_history_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $adverseReactionHistoryId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="adverse_reaction_history_datetime", type="datetime", nullable=false)
     */
    private $adverseReactionHistoryDatetime;

    /**
     * @var \AdverseReaction
     *
     * @ORM\ManyToOne(targetEntity="AdverseReaction")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="adverse_reaction_id", referencedColumnName="adverse_reaction_id")
     * })
     */
    private $adverseReaction;

    /**
     * @var \Representative
     *
     * @ORM\ManyToOne(targetEntity="Representative")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="representative_id", referencedColumnName="representative_id")
     * })
     */
    private $representative;



    /**
     * Get adverseReactionHistoryId
     *
     * @return integer 
     */
    public function getAdverseReactionHistoryId()
    {
        return $this->adverseReactionHistoryId;
    }

    /**
     * Set adverseReactionHistoryDatetime
     *
     * @param \DateTime $adverseReactionHistoryDatetime
     * @return AdverseReactionHistory
     */
    public function setAdverseReactionHistoryDatetime($adverseReactionHistoryDatetime)
    {
        $this->adverseReactionHistoryDatetime = $adverseReactionHistoryDatetime;
    
        return $this;
    }

    /**
     * Get adverseReactionHistoryDatetime
     *
     * @return \DateTime 
     */
    public function getAdverseReactionHistoryDatetime()
    {
        return $this->adverseReactionHistoryDatetime;
    }

    /**
     * Set adverseReaction
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\AdverseReaction $adverseReaction
     * @return AdverseReactionHistory
     */
    public function setAdverseReaction(\Cyclogram\Bundle\ProofPilotBundle\Entity\AdverseReaction $adverseReaction = null)
    {
        $this->adverseReaction = $adverseReaction;
    
        return $this;
    }

    /**
     * Get adverseReaction
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\AdverseReaction 
     */
    public function getAdverseReaction()
    {
        return $this->adverseReaction;
    }

    /**
     * Set representative
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Representative $representative
     * @return AdverseReactionHistory
     */
    public function setRepresentative(\Cyclogram\Bundle\ProofPilotBundle\Entity\Representative $representative = null)
    {
        $this->representative = $representative;
    
        return $this;
    }

    /**
     * Get representative
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Representative 
     */
    public function getRepresentative()
    {
        return $this->representative;
    }
}