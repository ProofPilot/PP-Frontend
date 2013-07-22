<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeUserInGroups
 *
 * @ORM\Table(name="lime_user_in_groups")
 * @ORM\Entity
 */
class LimeUserInGroups
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ugid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $ugid;

    /**
     * @var integer
     *
     * @ORM\Column(name="uid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $uid;


}
