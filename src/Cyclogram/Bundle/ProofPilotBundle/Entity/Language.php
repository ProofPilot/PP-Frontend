<?php

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
    /**
     * @var integer
     *
     * @ORM\Column(name="language_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $languageId;

    /**
     * @var string
     *
     * @ORM\Column(name="language_name", type="string", length=45, nullable=false)
     */
    private $languageName;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Study", mappedBy="language")
     */
    private $study;

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
     * @var string
     *
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="status_id")
     * })
     */
    private $locale;

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
    public function setStatus(
            \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status = null)
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

    public function getLocale()
    {
        return $this->locale;
    }

    public function setLocale(string $locale)
    {
        $this->locale = $locale;
    }

}
