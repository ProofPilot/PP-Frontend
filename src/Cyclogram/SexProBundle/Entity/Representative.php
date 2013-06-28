<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Representative
 *
 * @ORM\Table(name="representative")
 * @ORM\Entity
 */
class Representative
{
    /**
     * @var integer
     *
     * @ORM\Column(name="representative_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $representativeId;

    /**
     * @var string
     *
     * @ORM\Column(name="representative_firstname", type="string", length=45, nullable=true)
     */
    private $representativeFirstname;

    /**
     * @var string
     *
     * @ORM\Column(name="representative_lastname", type="string", length=45, nullable=true)
     */
    private $representativeLastname;

    /**
     * @var string
     *
     * @ORM\Column(name="representative_username", type="string", length=45, nullable=true)
     */
    private $representativeUsername;

    /**
     * @var string
     *
     * @ORM\Column(name="representative_password", type="string", length=45, nullable=true)
     */
    private $representativePassword;

    /**
     * @var string
     *
     * @ORM\Column(name="representative_email", type="string", length=45, nullable=true)
     */
    private $representativeEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="representative_phone1", type="string", length=45, nullable=true)
     */
    private $representativePhone1;

    /**
     * @var string
     *
     * @ORM\Column(name="representative_phone_2", type="string", length=45, nullable=true)
     */
    private $representativePhone2;

    /**
     * @var \Organization
     *
     * @ORM\ManyToOne(targetEntity="Organization")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="organization_id", referencedColumnName="organization_id")
     * })
     */
    private $organization;

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
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * })
     */
    private $user;



    /**
     * Get representativeId
     *
     * @return integer 
     */
    public function getRepresentativeId()
    {
        return $this->representativeId;
    }

    /**
     * Set representativeFirstname
     *
     * @param string $representativeFirstname
     * @return Representative
     */
    public function setRepresentativeFirstname($representativeFirstname)
    {
        $this->representativeFirstname = $representativeFirstname;
    
        return $this;
    }

    /**
     * Get representativeFirstname
     *
     * @return string 
     */
    public function getRepresentativeFirstname()
    {
        return $this->representativeFirstname;
    }

    /**
     * Set representativeLastname
     *
     * @param string $representativeLastname
     * @return Representative
     */
    public function setRepresentativeLastname($representativeLastname)
    {
        $this->representativeLastname = $representativeLastname;
    
        return $this;
    }

    /**
     * Get representativeLastname
     *
     * @return string 
     */
    public function getRepresentativeLastname()
    {
        return $this->representativeLastname;
    }

    /**
     * Set representativeUsername
     *
     * @param string $representativeUsername
     * @return Representative
     */
    public function setRepresentativeUsername($representativeUsername)
    {
        $this->representativeUsername = $representativeUsername;
    
        return $this;
    }

    /**
     * Get representativeUsername
     *
     * @return string 
     */
    public function getRepresentativeUsername()
    {
        return $this->representativeUsername;
    }

    /**
     * Set representativePassword
     *
     * @param string $representativePassword
     * @return Representative
     */
    public function setRepresentativePassword($representativePassword)
    {
        $this->representativePassword = $representativePassword;
    
        return $this;
    }

    /**
     * Get representativePassword
     *
     * @return string 
     */
    public function getRepresentativePassword()
    {
        return $this->representativePassword;
    }

    /**
     * Set representativeEmail
     *
     * @param string $representativeEmail
     * @return Representative
     */
    public function setRepresentativeEmail($representativeEmail)
    {
        $this->representativeEmail = $representativeEmail;
    
        return $this;
    }

    /**
     * Get representativeEmail
     *
     * @return string 
     */
    public function getRepresentativeEmail()
    {
        return $this->representativeEmail;
    }

    /**
     * Set representativePhone1
     *
     * @param string $representativePhone1
     * @return Representative
     */
    public function setRepresentativePhone1($representativePhone1)
    {
        $this->representativePhone1 = $representativePhone1;
    
        return $this;
    }

    /**
     * Get representativePhone1
     *
     * @return string 
     */
    public function getRepresentativePhone1()
    {
        return $this->representativePhone1;
    }

    /**
     * Set representativePhone2
     *
     * @param string $representativePhone2
     * @return Representative
     */
    public function setRepresentativePhone2($representativePhone2)
    {
        $this->representativePhone2 = $representativePhone2;
    
        return $this;
    }

    /**
     * Get representativePhone2
     *
     * @return string 
     */
    public function getRepresentativePhone2()
    {
        return $this->representativePhone2;
    }

    /**
     * Set organization
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Organization $organization
     * @return Representative
     */
    public function setOrganization(\Cyclogram\Bundle\ProofPilotBundle\Entity\Organization $organization = null)
    {
        $this->organization = $organization;
    
        return $this;
    }

    /**
     * Get organization
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Organization 
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return Representative
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

    /**
     * Set user
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\User $user
     * @return Representative
     */
    public function setUser(\Cyclogram\Bundle\ProofPilotBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
    
    public function __toString() 
    {
    	return $this->representativeFirstname . ' ' . $this->representativeLastname;
    }
}