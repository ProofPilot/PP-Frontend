<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeParticipantShares
 *
 * @ORM\Table(name="lime_participant_shares")
 * @ORM\Entity
 */
class LimeParticipantShares
{
    /**
     * @var string
     *
     * @ORM\Column(name="participant_id", type="string", length=50, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $participantId;

    /**
     * @var integer
     *
     * @ORM\Column(name="share_uid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $shareUid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_added", type="datetime", nullable=false)
     */
    private $dateAdded;

    /**
     * @var string
     *
     * @ORM\Column(name="can_edit", type="string", length=5, nullable=false)
     */
    private $canEdit;


}
