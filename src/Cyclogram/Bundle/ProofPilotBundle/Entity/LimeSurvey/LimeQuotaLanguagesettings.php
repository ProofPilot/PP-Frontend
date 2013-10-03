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
 * LimeQuotaLanguagesettings
 *
 * @ORM\Table(name="lime_quota_languagesettings")
 * @ORM\Entity
 */
class LimeQuotaLanguagesettings
{
    /**
     * @var integer
     *
     * @ORM\Column(name="quotals_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $quotalsId;

    /**
     * @var integer
     *
     * @ORM\Column(name="quotals_quota_id", type="integer", nullable=false)
     */
    private $quotalsQuotaId;

    /**
     * @var string
     *
     * @ORM\Column(name="quotals_language", type="string", length=45, nullable=false)
     */
    private $quotalsLanguage;

    /**
     * @var string
     *
     * @ORM\Column(name="quotals_name", type="string", length=255, nullable=true)
     */
    private $quotalsName;

    /**
     * @var string
     *
     * @ORM\Column(name="quotals_message", type="text", nullable=false)
     */
    private $quotalsMessage;

    /**
     * @var string
     *
     * @ORM\Column(name="quotals_url", type="string", length=255, nullable=true)
     */
    private $quotalsUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="quotals_urldescrip", type="string", length=255, nullable=true)
     */
    private $quotalsUrldescrip;


}
