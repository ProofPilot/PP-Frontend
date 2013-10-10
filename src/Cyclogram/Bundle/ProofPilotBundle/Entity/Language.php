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
 * Language
 *
 * @ORM\Table(name="language")
 * @ORM\Entity
 */
class Language
{
    const STATUS_ACTIVE =1;
    /**
     * @var integer
     *
     * @ORM\Column(name="language_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $languageId;

    /**
     * @var string
     *
     * @ORM\Column(name="language_name", type="string", length=45, nullable=false)
     */
    protected $languageName;
    
    /**
     * @var string
     *
     * @ORM\Column(name="locale", type="string", length=10, nullable=false)
     *
     */
    protected $locale;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Study", mappedBy="language")
     */
    private $study;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=false)
     */
    protected $status;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->study = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get languageId
     *
     * @return integer 
     */
    public function getLanguageId()
    {
        return $this->languageId;
    }

    /**
     * Set languageName
     *
     * @param string $languageName
     * @return Language
     */
    public function setLanguageName($languageName)
    {
        $this->languageName = $languageName;

        return $this;
    }

    /**
     * Get languageName
     *
     * @return string 
     */
    public function getLanguageName()
    {
        return $this->languageName;
    }

    /**
     * Add study
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study
     * @return Language
     */
    public function addStudy(
            \Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study)
    {
        $this->study[] = $study;

        return $this;
    }

    /**
     * Remove study
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study
     */
    public function removeStudy(
            \Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study)
    {
        $this->study->removeElement($study);
    }

    /**
     * Get study
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStudy()
    {
        return $this->study;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return Language
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
    
    /**
     * Get locale
     *
     */
    public function getLocale()
    {
        return $this->locale;
    }
    
    /**
     * Set locale
     *
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

}
