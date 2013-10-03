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
