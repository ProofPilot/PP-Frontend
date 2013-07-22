<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeSurveyLinks
 *
 * @ORM\Table(name="lime_survey_links")
 * @ORM\Entity
 */
class LimeSurveyLinks
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
     * @ORM\Column(name="token_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $tokenId;

    /**
     * @var integer
     *
     * @ORM\Column(name="survey_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $surveyId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="datetime", nullable=true)
     */
    private $dateCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_invited", type="datetime", nullable=true)
     */
    private $dateInvited;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_completed", type="datetime", nullable=true)
     */
    private $dateCompleted;


}
