<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeOldSurvey88725320130415132450
 *
 * @ORM\Table(name="lime_old_survey_887253_20130415132450")
 * @ORM\Entity
 */
class LimeOldSurvey88725320130415132450
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
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=36, nullable=true)
     */
    private $token;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="submitdate", type="datetime", nullable=true)
     */
    private $submitdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="lastpage", type="integer", nullable=true)
     */
    private $lastpage;

    /**
     * @var string
     *
     * @ORM\Column(name="startlanguage", type="string", length=20, nullable=false)
     */
    private $startlanguage;

    /**
     * @var string
     *
     * @ORM\Column(name="887253X48X5431", type="string", length=5, nullable=true)
     */
    private $887253x48x5431;

    /**
     * @var string
     *
     * @ORM\Column(name="887253X48X5432", type="string", length=5, nullable=true)
     */
    private $887253x48x5432;

    /**
     * @var string
     *
     * @ORM\Column(name="887253X48X5433", type="string", length=5, nullable=true)
     */
    private $887253x48x5433;

    /**
     * @var string
     *
     * @ORM\Column(name="887253X48X5434", type="string", length=5, nullable=true)
     */
    private $887253x48x5434;

    /**
     * @var string
     *
     * @ORM\Column(name="887253X48X5435", type="string", length=5, nullable=true)
     */
    private $887253x48x5435;


}
