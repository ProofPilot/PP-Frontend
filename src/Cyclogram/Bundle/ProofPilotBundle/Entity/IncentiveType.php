<?php
namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IncentiveType
 *
 * @ORM\Table(name="incentive_type")
 * @ORM\Entity(repositoryClass="Cyclogram\Bundle\ProofPilotBundle\Repository\IncentiveTypeRepository")
 */
class IncentiveType
{
    const STATUS_ACTIVE =1;
    /**
     * @var integer
     *
     * @ORM\Column(name="incentive_type_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $incentiveId;

    /**
     * @var string
     *
     * @ORM\Column(name="incentive_type_name", type="string", length=145, nullable=true)
     */
    private $incentiveTypeName;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=false)
     */
    protected $status;

    public function getIncentiveTypeName()
    {
        return $this->incentiveTypeName;
    }

    public function setIncentiveTypeName($incentiveTypeName)
    {
        $this->incentiveTypeName = $incentiveTypeName;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

}
