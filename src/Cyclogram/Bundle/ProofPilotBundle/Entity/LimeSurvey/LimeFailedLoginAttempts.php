<?php
/*
* This is part of the ProofPilot package.
*
* (c)2012-2013 Cyclogram, Inc, West Hollywood, CA <crew@proofpilot.com>
* ALL RIGHTS RESERVED
*
* This software is provided by the copyright holders to Manila Consulting for use on the
* Center for Disease Control's Evaluation of Rapid HIV Self-Testing among MSM in High
* Prevalence Cities until 2016 or the project is completed.
*
* Any unauthorized use, modification or resale is not permitted without expressed permission
* from the copyright holders.
*
* KnowatHome branding, URL, study logic, survey instruments, and resulting data are not part
* of this copyright and remain the property of the prime contractor.
*
*/

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
