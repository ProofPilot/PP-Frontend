<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommunicationChannel
 *
 * @ORM\Table(name="communication_channel")
 * @ORM\Entity
 */
class CommunicationChannel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="communication_channel_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $communicationChannelId;

    /**
     * @var string
     *
     * @ORM\Column(name="communication_channel_name", type="string", length=45, nullable=false)
     */
    private $communicationChannelName;

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
     * Get communicationChannelId
     *
     * @return integer 
     */
    public function getCommunicationChannelId()
    {
        return $this->communicationChannelId;
    }

    /**
     * Set communicationChannelName
     *
     * @param string $communicationChannelName
     * @return CommunicationChannel
     */
    public function setCommunicationChannelName($communicationChannelName)
    {
        $this->communicationChannelName = $communicationChannelName;
    
        return $this;
    }

    /**
     * Get communicationChannelName
     *
     * @return string 
     */
    public function getCommunicationChannelName()
    {
        return $this->communicationChannelName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return CommunicationChannel
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