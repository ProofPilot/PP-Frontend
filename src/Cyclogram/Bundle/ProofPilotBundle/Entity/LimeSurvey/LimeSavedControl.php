<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeSavedControl
 *
 * @ORM\Table(name="lime_saved_control")
 * @ORM\Entity
 */
class LimeSavedControl
{
    /**
     * @var integer
     *
     * @ORM\Column(name="scid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $scid;

    /**
     * @var integer
     *
     * @ORM\Column(name="sid", type="integer", nullable=false)
     */
    private $sid;

    /**
     * @var integer
     *
     * @ORM\Column(name="srid", type="integer", nullable=false)
     */
    private $srid;

    /**
     * @var string
     *
     * @ORM\Column(name="identifier", type="text", nullable=false)
     */
    private $identifier;

    /**
     * @var string
     *
     * @ORM\Column(name="access_code", type="text", nullable=false)
     */
    private $accessCode;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=320, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="text", nullable=false)
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="saved_thisstep", type="text", nullable=false)
     */
    private $savedThisstep;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=1, nullable=false)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="saved_date", type="datetime", nullable=false)
     */
    private $savedDate;

    /**
     * @var string
     *
     * @ORM\Column(name="refurl", type="text", nullable=true)
     */
    private $refurl;


}
