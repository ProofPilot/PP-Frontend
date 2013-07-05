<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CollectorForum
 *
 * @ORM\Table(name="collector_forum")
 * @ORM\Entity
 */
class CollectorForum
{
    /**
     * @var integer
     *
     * @ORM\Column(name="collector_forum_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $collectorForumId;

    /**
     * @var string
     *
     * @ORM\Column(name="collector_forum_name", type="string", length=45, nullable=false)
     */
    private $collectorForumName;

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
     * Get collectorForumId
     *
     * @return integer 
     */
    public function getCollectorForumId()
    {
        return $this->collectorForumId;
    }

    /**
     * Set collectorForumName
     *
     * @param string $collectorForumName
     * @return CollectorForum
     */
    public function setCollectorForumName($collectorForumName)
    {
        $this->collectorForumName = $collectorForumName;
    
        return $this;
    }

    /**
     * Get collectorForumName
     *
     * @return string 
     */
    public function getCollectorForumName()
    {
        return $this->collectorForumName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return CollectorForum
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
    
    public function __toString()
    {
    	return $this->collectorForumName;
    }
}