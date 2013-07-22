<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeTemplatesRights
 *
 * @ORM\Table(name="lime_templates_rights")
 * @ORM\Entity
 */
class LimeTemplatesRights
{
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
     * @ORM\Column(name="folder", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $folder;

    /**
     * @var integer
     *
     * @ORM\Column(name="use", type="integer", nullable=false)
     */
    private $use;


}
