<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RepresentativeRole
 *
 * @ORM\Table(name="representative_role")
 * @ORM\Entity
 */
class RepresentativeRole
{
    /**
     * @var integer
     *
     * @ORM\Column(name="representative_role_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $representativeRoleId;

    /**
     * @var string
     *
     * @ORM\Column(name="representative_role_name", type="string", length=45, nullable=false)
     */
    private $representativeRoleName;



    /**
     * Get representativeRoleId
     *
     * @return integer 
     */
    public function getRepresentativeRoleId()
    {
        return $this->representativeRoleId;
    }

    /**
     * Set representativeRoleName
     *
     * @param string $representativeRoleName
     * @return RepresentativeRole
     */
    public function setRepresentativeRoleName($representativeRoleName)
    {
        $this->representativeRoleName = $representativeRoleName;
    
        return $this;
    }

    /**
     * Get representativeRoleName
     *
     * @return string 
     */
    public function getRepresentativeRoleName()
    {
        return $this->representativeRoleName;
    }
    
    public function __toString()
    {
    	return $this->representativeRoleName;
    }
}