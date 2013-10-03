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