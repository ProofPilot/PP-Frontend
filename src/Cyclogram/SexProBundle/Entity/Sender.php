<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sender
 *
 * @ORM\Table(name="sender")
 * @ORM\Entity
 */
class Sender
{
    /**
     * @var integer
     *
     * @ORM\Column(name="sender_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $senderId;

    /**
     * @var string
     *
     * @ORM\Column(name="sender_name", type="string", length=45, nullable=true)
     */
    private $senderName;

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
     * Get senderId
     *
     * @return integer 
     */
    public function getSenderId()
    {
        return $this->senderId;
    }

    /**
     * Set senderName
     *
     * @param string $senderName
     * @return Sender
     */
    public function setSenderName($senderName)
    {
        $this->senderName = $senderName;
    
        return $this;
    }

    /**
     * Get senderName
     *
     * @return string 
     */
    public function getSenderName()
    {
        return $this->senderName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return Sender
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