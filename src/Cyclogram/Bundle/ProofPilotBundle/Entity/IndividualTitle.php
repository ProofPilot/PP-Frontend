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
 * IndividualTitle
 *
 * @ORM\Table(name="individual_title")
 * @ORM\Entity
 */
class IndividualTitle
{
    const STATUS_ACTIVE =1;
    /**
     * @var integer
     *
     * @ORM\Column(name="individual_title_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $individualTitleId;

    /**
     * @var string
     *
     * @ORM\Column(name="individual_title_name", type="string", length=45, nullable=false)
     */
    private $individualTitleName;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=false)
     */
    private $status;



    /**
     * Get individualTitleId
     *
     * @return integer 
     */
    public function getIndividualTitleId()
    {
        return $this->individualTitleId;
    }

    /**
     * Set individualTitleName
     *
     * @param string $individualTitleName
     * @return IndividualTitle
     */
    public function setIndividualTitleName($individualTitleName)
    {
        $this->individualTitleName = $individualTitleName;
    
        return $this;
    }

    /**
     * Get individualTitleName
     *
     * @return string 
     */
    public function getIndividualTitleName()
    {
        return $this->individualTitleName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return IndividualTitle
     */
    public function setStatus($status)
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
    
    public function __toString()
    {
    	return $this->individualTitleName;
    }
}