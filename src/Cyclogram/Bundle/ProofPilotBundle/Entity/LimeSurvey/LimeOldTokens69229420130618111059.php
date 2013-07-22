<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeOldTokens69229420130618111059
 *
 * @ORM\Table(name="lime_old_tokens_692294_20130618111059")
 * @ORM\Entity
 */
class LimeOldTokens69229420130618111059
{
    /**
     * @var integer
     *
     * @ORM\Column(name="tid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tid;

    /**
     * @var string
     *
     * @ORM\Column(name="participant_id", type="string", length=50, nullable=true)
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
     * @ORM\Column(name="email", type="text", nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="emailstatus", type="text", nullable=true)
     */
    private $emailstatus;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=35, nullable=true)
     */
    private $token;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=25, nullable=true)
     */
    private $language;

    /**
     * @var string
     *
     * @ORM\Column(name="blacklisted", type="string", length=17, nullable=true)
     */
    private $blacklisted;

    /**
     * @var string
     *
     * @ORM\Column(name="sent", type="string", length=17, nullable=true)
     */
    private $sent;

    /**
     * @var string
     *
     * @ORM\Column(name="remindersent", type="string", length=17, nullable=true)
     */
    private $remindersent;

    /**
     * @var integer
     *
     * @ORM\Column(name="remindercount", type="integer", nullable=true)
     */
    private $remindercount;

    /**
     * @var string
     *
     * @ORM\Column(name="completed", type="string", length=17, nullable=true)
     */
    private $completed;

    /**
     * @var integer
     *
     * @ORM\Column(name="usesleft", type="integer", nullable=true)
     */
    private $usesleft;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="validfrom", type="datetime", nullable=true)
     */
    private $validfrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="validuntil", type="datetime", nullable=true)
     */
    private $validuntil;

    /**
     * @var integer
     *
     * @ORM\Column(name="mpid", type="integer", nullable=true)
     */
    private $mpid;


}
