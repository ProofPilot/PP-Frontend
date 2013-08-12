<?php
namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RepresentativeSiteLink
 *
 * @ORM\Table(name="campaign")
 * @ORM\Entity(repositoryClass="Cyclogram\Bundle\ProofPilotBundle\Repository\RepresentativeSiteLinkRepository")
 */
class RepresentativeSiteLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="representative_site_link_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $representativeSiteLinkId;

    /**
     * @var \Representative
     *
     * @ORM\ManyToOne(targetEntity="Representative")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="representative_id", referencedColumnName="representative_id")
     * })
     */
    private $representative;

    /**
     * @var \Site
     *
     * @ORM\ManyToOne(targetEntity="Site")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="site_id", referencedColumnName="site_id")
     * })
     */
    private $site;

    public function getRepresentativeSiteLinkId()
    {
        return $this->representativeSiteLinkId;
    }

    public function setRepresentativeSiteLinkId($representativeSiteLinkId)
    {
        $this->representativeSiteLinkId = $representativeSiteLinkId;
    }
    
    /**
     * Set representative
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Representative $representative
     * @return Representative
     */
    public function setRepresentative(\Cyclogram\Bundle\ProofPilotBundle\Entity\Representative $representative = null)
    {
        $this->representative = $representative;
    
        return $this;
    }
    
    /**
     * Get representative
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Representative
     */
    public function getRepresentative()
    {
        return $this->representative;
    }
    
    /**
     * Set site
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Site $site
     * @return Site
     */
    public function setSite(\Cyclogram\Bundle\ProofPilotBundle\Entity\Site $site = null)
    {
        $this->site = $site;
    
        return $this;
    }
    
    /**
     * Get site
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Site
     */
    public function getSite()
    {
        return $this->site;
    }

}
