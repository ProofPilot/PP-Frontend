<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeFailedLoginAttempts
 *
 * @ORM\Table(name="lime_failed_login_attempts")
 * @ORM\Entity
 */
class LimeFailedLoginAttempts
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
     * @ORM\Column(name="ip", type="string", length=40, nullable=false)
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="last_attempt", type="string", length=20, nullable=false)
     */
    private $lastAttempt;

    /**
     * @var integer
     *
     * @ORM\Column(name="number_attempts", type="integer", nullable=false)
     */
    private $numberAttempts;


}
