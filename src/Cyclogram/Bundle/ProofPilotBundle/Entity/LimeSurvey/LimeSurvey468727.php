<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;
use Doctrine\ORM\Mapping as ORM;

/**
 * LimeSurvey468727
 *
 * @ORM\Table(name="lime_survey_468727")
 * @ORM\Entity
 */
class LimeSurvey468727
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
     * @var float
     *
     * @ORM\Column(name="468727X596X5526", type="decimal", nullable=true)
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="468727X596X5527", type="string", length=5, nullable=true)
     */
    private $consentFormSigned;

    /**
     * @var string
     *
     * @ORM\Column(name="468727X596X5528", type="string", length=5, nullable=true)
     */
    private $location;

    public function getAge()
    {
        return $this->age;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function setLocation($location)
    {
        $this->location = $location;
    }

}
