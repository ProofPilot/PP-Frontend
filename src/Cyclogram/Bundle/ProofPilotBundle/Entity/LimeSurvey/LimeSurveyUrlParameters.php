<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeSurveyUrlParameters
 *
 * @ORM\Table(name="lime_survey_url_parameters")
 * @ORM\Entity
 */
class LimeSurveyUrlParameters
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="sid", type="integer", nullable=false)
     */
    private $sid;

    /**
     * @var string
     *
     * @ORM\Column(name="parameter", type="string", length=50, nullable=false)
     */
    private $parameter;

    /**
     * @var integer
     *
     * @ORM\Column(name="targetqid", type="integer", nullable=true)
     */
    private $targetqid;

    /**
     * @var integer
     *
     * @ORM\Column(name="targetsqid", type="integer", nullable=true)
     */
    private $targetsqid;


}
