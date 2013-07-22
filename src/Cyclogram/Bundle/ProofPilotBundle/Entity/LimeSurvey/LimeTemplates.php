<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeTemplates
 *
 * @ORM\Table(name="lime_templates")
 * @ORM\Entity
 */
class LimeTemplates
{
    /**
     * @var string
     *
     * @ORM\Column(name="folder", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $folder;

    /**
     * @var integer
     *
     * @ORM\Column(name="creator", type="integer", nullable=false)
     */
    private $creator;


}
