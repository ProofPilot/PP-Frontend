<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeSettingsGlobal
 *
 * @ORM\Table(name="lime_settings_global")
 * @ORM\Entity
 */
class LimeSettingsGlobal
{
    /**
     * @var string
     *
     * @ORM\Column(name="stg_name", type="string", length=50, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $stgName;

    /**
     * @var string
     *
     * @ORM\Column(name="stg_value", type="string", length=255, nullable=false)
     */
    private $stgValue;


}
