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

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeParticipants
 *
 * @ORM\Table(name="lime_participants")
 * @ORM\Entity
 */
class LimeParticipants
{
    /**
     * @var string
     *
     * @ORM\Column(name="participant_id", type="string", length=50, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $participantId;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=40, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=40, nullable=true)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=80, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=40, nullable=true)
     */
    private $language;

    /**
     * @var string
     *
     * @ORM\Column(name="blacklisted", type="string", length=1, nullable=false)
     */
    private $blacklisted;

    /**
     * @var integer
     *
     * @ORM\Column(name="owner_uid", type="integer", nullable=false)
     */
    private $ownerUid;


}
