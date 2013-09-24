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
 * ParticipantStudyExternalSiteLink
 *
 * @ORM\Table(name="campaign_site_link")
 * @ORM\Entity(repositoryClass="Cyclogram\Bundle\ProofPilotBundle\Repository\ParticipantStudyExternalSiteLinkRepository")
 */
class ParticipantStudyExternalSiteLink
{

    /**
     * @var integer
     *
     * @ORM\Column(name="participant_study_external_site_link_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $participantStudyExternalSiteLinkSd;

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
     * @var \Study
     *
     * @ORM\ManyToOne(targetEntity="Study")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="study_id", referencedColumnName="study_id")
     * })
     */
    private $study;

    /**
     * @var string
     *
     * @ORM\Column(name="external_site_userid", type="string", length=255)
     */
    protected $externalSiteUserId;

    public function getParticipantStudyExternalSiteLinkSd()
    {
        return $this->participantStudyExternalSiteLinkSd;
    }

    public function setParticipantStudyExternalSiteLinkSd(
            $participantStudyExternalSiteLinkSd)
    {
        $this->participantStudyExternalSiteLinkSd = $participantStudyExternalSiteLinkSd;
    }

    /**
     * Set participant
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participant
     * @return Participant
     */
    public function setParticipant(
            \Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participant = null)
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
     * Set study
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study
     * @return Study
     */
    public function setStudy(
            \Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study = null)
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
        return $this->Study;
    }

    public function getExternalSiteUserId()
    {
        return $this->externalSiteUserId;
    }

    public function setExternalSiteUserId($externalSiteUserId)
    {
        $this->externalSiteUserId = $externalSiteUserId;
    }

}
