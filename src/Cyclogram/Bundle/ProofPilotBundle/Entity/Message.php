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
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity
 */
class Message
{
    const STATUS_ACTIVE =1;
    /**
     * @var integer
     *
     * @ORM\Column(name="message_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $messageId;

    /**
     * @var string
     *
     * @ORM\Column(name="message_content", type="string", length=255, nullable=false)
     */
    private $messageContent;

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
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=false)
     */
    private $language;

    /**
     * @var \Study
     *
     * @ORM\ManyToOne(targetEntity="Study")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="study_id", referencedColumnName="study_id")
     * })
     */
    private $study;



    /**
     * Set messageId
     *
     * @param integer $messageId
     * @return Message
     */
    public function setMessageId($messageId)
    {
        $this->messageId = $messageId;
    
        return $this;
    }

    /**
     * Get messageId
     *
     * @return integer 
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * Set messageContent
     *
     * @param string $messageContent
     * @return Message
     */
    public function setMessageContent($messageContent)
    {
        $this->messageContent = $messageContent;
    
        return $this;
    }

    /**
     * Get messageContent
     *
     * @return string 
     */
    public function getMessageContent()
    {
        return $this->messageContent;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return Message
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

    /**
     * Set language
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Language $language
     * @return Message
     */
    public function setLanguage(\Cyclogram\Bundle\ProofPilotBundle\Entity\Language $language)
    {
        $this->language = $language;
    
        return $this;
    }

    /**
     * Get language
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Language 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set study
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study
     * @return Message
     */
    public function setStudy($study)
    {
        $this->study = $study;
    
        return $this;
    }

    /**
     * Get study
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Study 
     */
    public function getStudy()
    {
        return $this->study;
    }
}