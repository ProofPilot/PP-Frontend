<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeOldSurvey59947920130415132428
 *
 * @ORM\Table(name="lime_old_survey_599479_20130415132428")
 * @ORM\Entity
 */
class LimeOldSurvey59947920130415132428
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
     * @var \DateTime
     *
     * @ORM\Column(name="startdate", type="datetime", nullable=false)
     */
    private $startdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datestamp", type="datetime", nullable=false)
     */
    private $datestamp;

    /**
     * @var string
     *
     * @ORM\Column(name="ipaddr", type="text", nullable=true)
     */
    private $ipaddr;

    /**
     * @var string
     *
     * @ORM\Column(name="refurl", type="text", nullable=true)
     */
    private $refurl;

    /**
     * @var string
     *
     * @ORM\Column(name="599479X23X3291", type="string", length=5, nullable=true)
     */
    private $599479x23x3291;

    /**
     * @var string
     *
     * @ORM\Column(name="599479X23X3292", type="string", length=5, nullable=true)
     */
    private $599479x23x3292;

    /**
     * @var string
     *
     * @ORM\Column(name="599479X23X3293", type="string", length=5, nullable=true)
     */
    private $599479x23x3293;

    /**
     * @var string
     *
     * @ORM\Column(name="599479X23X3294", type="string", length=5, nullable=true)
     */
    private $599479x23x3294;

    /**
     * @var string
     *
     * @ORM\Column(name="599479X23X3295", type="string", length=5, nullable=true)
     */
    private $599479x23x3295;

    /**
     * @var string
     *
     * @ORM\Column(name="599479X23X3296", type="string", length=5, nullable=true)
     */
    private $599479x23x3296;

    /**
     * @var string
     *
     * @ORM\Column(name="599479X23X3297", type="string", length=5, nullable=true)
     */
    private $599479x23x3297;

    /**
     * @var string
     *
     * @ORM\Column(name="599479X23X3298", type="string", length=5, nullable=true)
     */
    private $599479x23x3298;


}
