<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeGroups
 *
 * @ORM\Table(name="lime_groups")
 * @ORM\Entity
 */
class LimeGroups
{
    /**
     * @var integer
     *
     * @ORM\Column(name="gid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $gid;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=20, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $language;

    /**
     * @var integer
     *
     * @ORM\Column(name="sid", type="integer", nullable=false)
     */
    private $sid;

    /**
     * @var string
     *
     * @ORM\Column(name="group_name", type="string", length=100, nullable=false)
     */
    private $groupName;

    /**
     * @var integer
     *
     * @ORM\Column(name="group_order", type="integer", nullable=false)
     */
    private $groupOrder;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="randomization_group", type="string", length=20, nullable=false)
     */
    private $randomizationGroup;

    /**
     * @var string
     *
     * @ORM\Column(name="grelevance", type="text", nullable=true)
     */
    private $grelevance;


}
