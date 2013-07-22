<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeUsers
 *
 * @ORM\Table(name="lime_users")
 * @ORM\Entity
 */
class LimeUsers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="uid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $uid;

    /**
     * @var string
     *
     * @ORM\Column(name="users_name", type="string", length=64, nullable=false)
     */
    private $usersName;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="blob", nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="full_name", type="string", length=50, nullable=false)
     */
    private $fullName;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent_id", type="integer", nullable=false)
     */
    private $parentId;

    /**
     * @var string
     *
     * @ORM\Column(name="lang", type="string", length=20, nullable=true)
     */
    private $lang;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=320, nullable=true)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="create_survey", type="integer", nullable=false)
     */
    private $createSurvey;

    /**
     * @var integer
     *
     * @ORM\Column(name="create_user", type="integer", nullable=false)
     */
    private $createUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="participant_panel", type="integer", nullable=false)
     */
    private $participantPanel;

    /**
     * @var integer
     *
     * @ORM\Column(name="delete_user", type="integer", nullable=false)
     */
    private $deleteUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="superadmin", type="integer", nullable=false)
     */
    private $superadmin;

    /**
     * @var integer
     *
     * @ORM\Column(name="configurator", type="integer", nullable=false)
     */
    private $configurator;

    /**
     * @var integer
     *
     * @ORM\Column(name="manage_template", type="integer", nullable=false)
     */
    private $manageTemplate;

    /**
     * @var integer
     *
     * @ORM\Column(name="manage_label", type="integer", nullable=false)
     */
    private $manageLabel;

    /**
     * @var string
     *
     * @ORM\Column(name="htmleditormode", type="string", length=7, nullable=true)
     */
    private $htmleditormode;

    /**
     * @var string
     *
     * @ORM\Column(name="templateeditormode", type="string", length=7, nullable=true)
     */
    private $templateeditormode;

    /**
     * @var string
     *
     * @ORM\Column(name="questionselectormode", type="string", length=7, nullable=true)
     */
    private $questionselectormode;

    /**
     * @var integer
     *
     * @ORM\Column(name="dateformat", type="integer", nullable=false)
     */
    private $dateformat;

    /**
     * @var string
     *
     * @ORM\Column(name="one_time_pw", type="blob", nullable=true)
     */
    private $oneTimePw;


}
