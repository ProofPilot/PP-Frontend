<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Intervention
 *
 * @ORM\Table(name="intervention")
 * @ORM\Entity
 */
class Intervention
{
    /**
     * @var integer
     *
     * @ORM\Column(name="intervention_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $interventionId;

    /**
     * @var string
     *
     * @ORM\Column(name="intervention_name", type="string", length=45, nullable=false)
     */
    private $interventionName;

    /**
     * @var string
     *
     * @ORM\Column(name="intervention_url", type="string", length=300, nullable=true)
     */
    private $interventionUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="sid_id", type="string", length=45, nullable=true)
     */
    private $sidId;

    /**
     * @var string
     *
     * @ORM\Column(name="intervention_response_url", type="string", length=500, nullable=true)
     */
    private $interventionResponseUrl;

    /**
     * @var \Language
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Language")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="language_id", referencedColumnName="language_id")
     * })
     */
    private $language;

    /**
     * @var \InterventionType
     *
     * @ORM\ManyToOne(targetEntity="InterventionType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="intervention_type_id", referencedColumnName="intervention_type_id")
     * })
     */
    private $interventionType;

    /**
     * @var \Status
     *
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="status_id")
     * })
     */
    private $status;

    public function getInterventionName()
    {
        return $this->interventionName;
    }

    public function setInterventionName($interventionName)
    {
        $this->interventionName = $interventionName;
    }
    
    


    public function getInterventionType()
    {
        return $this->interventionType;
    }

    public function setInterventionType($interventionType)
    {
        $this->interventionType = $interventionType;
    }

    public function getSidId()
    {
        return $this->sidId;
    }

    public function setSidId($sidId)
    {
        $this->sidId = $sidId;
    }
}
