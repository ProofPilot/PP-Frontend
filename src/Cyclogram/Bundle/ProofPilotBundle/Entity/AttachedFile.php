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
 * AttachedFile
 *
 * @ORM\Table(name="attached_file")
 * @ORM\Entity
 */
class AttachedFile
{
    /**
     * @var integer
     *
     * @ORM\Column(name="attached_file_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $attachedFileId;

    /**
     * @var string
     *
     * @ORM\Column(name="attached_file_title", type="string", length=145, nullable=false)
     */
    private $attachedFileTitle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="attached_file_datetime", type="datetime", nullable=false)
     */
    private $attachedFileDatetime;

    /**
     * @var string
     *
     * @ORM\Column(name="attached_file_path", type="string", length=1000, nullable=true)
     */
    private $attachedFilePath;

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
     * @var \Status
     *
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="status_id")
     * })
     */
    private $status;

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
     * Get attachedFileId
     *
     * @return integer 
     */
    public function getAttachedFileId()
    {
        return $this->attachedFileId;
    }

    /**
     * Set attachedFileTitle
     *
     * @param string $attachedFileTitle
     * @return AttachedFile
     */
    public function setAttachedFileTitle($attachedFileTitle)
    {
        $this->attachedFileTitle = $attachedFileTitle;
    
        return $this;
    }

    /**
     * Get attachedFileTitle
     *
     * @return string 
     */
    public function getAttachedFileTitle()
    {
        return $this->attachedFileTitle;
    }

    /**
     * Set attachedFileDatetime
     *
     * @param \DateTime $attachedFileDatetime
     * @return AttachedFile
     */
    public function setAttachedFileDatetime($attachedFileDatetime)
    {
        $this->attachedFileDatetime = $attachedFileDatetime;
    
        return $this;
    }

    /**
     * Get attachedFileDatetime
     *
     * @return \DateTime 
     */
    public function getAttachedFileDatetime()
    {
        return $this->attachedFileDatetime;
    }

    /**
     * Set attachedFilePath
     *
     * @param string $attachedFilePath
     * @return AttachedFile
     */
    public function setAttachedFilePath($attachedFilePath)
    {
        $this->attachedFilePath = $attachedFilePath;
    
        return $this;
    }

    /**
     * Get attachedFilePath
     *
     * @return string 
     */
    public function getAttachedFilePath()
    {
        return $this->attachedFilePath;
    }

    /**
     * Set participant
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participant
     * @return AttachedFile
     */
    public function setParticipant(\Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participant = null)
    {
        $this->participant = $participant;
    
        return $this;
    }

    /**
     * Get participant
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Participant 
     */
    public function getParticipant()
    {
        return $this->participant;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return AttachedFile
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
     * Set study
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study
     * @return AttachedFile
     */
    public function setStudy(\Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study = null)
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