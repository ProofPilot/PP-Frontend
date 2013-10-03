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
 * UserType
 *
 * @ORM\Table(name="user_type")
 * @ORM\Entity
 */
class UserType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_type_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_type_name", type="string", length=45, nullable=false)
     */
    private $userTypeName;

    /**
     * @var \Status
     *
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="status_id")
     * })
     */
    private $status;



    /**
     * Get userTypeId
     *
     * @return integer 
     */
    public function getUserTypeId()
    {
        return $this->userTypeId;
    }

    /**
     * Set userTypeName
     *
     * @param string $userTypeName
     * @return UserType
     */
    public function setUserTypeName($userTypeName)
    {
        $this->userTypeName = $userTypeName;
    
        return $this;
    }

    /**
     * Get userTypeName
     *
     * @return string 
     */
    public function getUserTypeName()
    {
        return $this->userTypeName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return UserType
     */
    public function setStatus(\Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status = null)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Status 
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    public function __toString() {
    	return $this->userTypeName;
    }
}