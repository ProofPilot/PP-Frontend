<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CollectorForumTestPhaseLink
 *
 * @ORM\Table(name="collector_forum_test_phase_link")
 * @ORM\Entity
 */
class CollectorForumTestPhaseLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="collector_forum_test_phase_link_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $collectorForumTestPhaseLinkId;

    /**
     * @var \CollectorForum
     *
     * @ORM\ManyToOne(targetEntity="CollectorForum")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="collector_forum_id", referencedColumnName="collector_forum_id")
     * })
     */
    private $collectorForum;

    /**
     * @var \TestPhase
     *
     * @ORM\ManyToOne(targetEntity="TestPhase")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="test_phase_id", referencedColumnName="test_phase_id")
     * })
     */
    private $testPhase;



    /**
     * Get collectorForumTestPhaseLinkId
     *
     * @return integer 
     */
    public function getCollectorForumTestPhaseLinkId()
    {
        return $this->collectorForumTestPhaseLinkId;
    }

    /**
     * Set collectorForum
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\CollectorForum $collectorForum
     * @return CollectorForumTestPhaseLink
     */
    public function setCollectorForum(\Cyclogram\Bundle\ProofPilotBundle\Entity\CollectorForum $collectorForum = null)
    {
        $this->collectorForum = $collectorForum;
    
        return $this;
    }

    /**
     * Get collectorForum
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\CollectorForum 
     */
    public function getCollectorForum()
    {
        return $this->collectorForum;
    }

    /**
     * Set testPhase
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\TestPhase $testPhase
     * @return CollectorForumTestPhaseLink
     */
    public function setTestPhase(\Cyclogram\Bundle\ProofPilotBundle\Entity\TestPhase $testPhase = null)
    {
        $this->testPhase = $testPhase;
    
        return $this;
    }

    /**
     * Get testPhase
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\TestPhase 
     */
    public function getTestPhase()
    {
        return $this->testPhase;
    }
    
    public function __toString() {
    	return $this->testPhase;
    }
    
}