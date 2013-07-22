<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeSurveyPermissions
 *
 * @ORM\Table(name="lime_survey_permissions")
 * @ORM\Entity
 */
class LimeSurveyPermissions
{
    /**
     * @var integer
     *
     * @ORM\Column(name="sid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $sid;

    /**
     * @var integer
     *
     * @ORM\Column(name="uid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $uid;

    /**
     * @var string
     *
     * @ORM\Column(name="permission", type="string", length=20, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $permission;

    /**
     * @var integer
     *
     * @ORM\Column(name="create_p", type="integer", nullable=false)
     */
    private $createP;

    /**
     * @var integer
     *
     * @ORM\Column(name="read_p", type="integer", nullable=false)
     */
    private $readP;

    /**
     * @var integer
     *
     * @ORM\Column(name="update_p", type="integer", nullable=false)
     */
    private $updateP;

    /**
     * @var integer
     *
     * @ORM\Column(name="delete_p", type="integer", nullable=false)
     */
    private $deleteP;

    /**
     * @var integer
     *
     * @ORM\Column(name="import_p", type="integer", nullable=false)
     */
    private $importP;

    /**
     * @var integer
     *
     * @ORM\Column(name="export_p", type="integer", nullable=false)
     */
    private $exportP;


}
