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
 * Sex
 *
 * @ORM\Table(name="sex")
 * @ORM\Entity
 */
class Sex
{
    /**
     * @var integer
     *
     * @ORM\Column(name="sex_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $sexId;

    /**
     * @var string
     *
     * @ORM\Column(name="sex_name", type="string", length=45, nullable=false)
     */
    protected $sexName;

    /**
     * @var \Status
     *
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="status_id")
     * })
     */
    protected $status;



    /**
     * Get sexId
     *
     * @return integer 
     */
    public function getSexId()
    {
        return $this->sexId;
    }

    /**
     * Set sexName
     *
     * @param string $sexName
     * @return Sex
     */
    public function setSexName($sexName)
    {
        $this->sexName = $sexName;
    
        return $this;
    }

    /**
     * Get sexName
     *
     * @return string 
     */
    public function getSexName()
    {
        return $this->sexName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return Sex
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
}