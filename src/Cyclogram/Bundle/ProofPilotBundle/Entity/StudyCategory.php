<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StudyCategory
 *
 * @ORM\Table(name="study_category")
 * @ORM\Entity
 */
class StudyCategory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="study_category_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $studyCategoryId;

    /**
     * @var string
     *
     * @ORM\Column(name="study_category_name", type="string", length=45, nullable=true)
     */
    private $studyCategoryName;

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
     * Get studyCategoryId
     *
     * @return integer 
     */
    public function getStudyCategoryId()
    {
        return $this->studyCategoryId;
    }

    /**
     * Set studyCategoryName
     *
     * @param string $studyCategoryName
     * @return StudyCategory
     */
    public function setStudyCategoryName($studyCategoryName)
    {
        $this->studyCategoryName = $studyCategoryName;
    
        return $this;
    }

    /**
     * Get studyCategoryName
     *
     * @return string 
     */
    public function getStudyCategoryName()
    {
        return $this->studyCategoryName;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return StudyCategory
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