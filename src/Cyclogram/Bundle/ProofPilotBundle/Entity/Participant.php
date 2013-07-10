<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Participant
 *
 * @ORM\Table(name="participant")
 * @ORM\Entity(repositoryClass="Cyclogram\Bundle\ProofPilotBundle\Repository\ParticipantRepository")
 * @UniqueEntity(fields={"participantEmail"}, message="The e-mail address is already registered")
 * @UniqueEntity(fields={"participantUsername"}, message="Username is already registered")
 */
class Participant implements AdvancedUserInterface
{
    protected $participantRoles = array();
    /**
     * @var integer
     *
     * @ORM\Column(name="participant_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $participantId;

    /**
     * @var string
     *
     * @ORM\Column(name="facebookId", type="string", length=255)
     */
    protected $facebookId;

    public function serialize()
    {
        return serialize(array($this->facebookId, parent::serialize()));
    }
    
    public function unserialize($data)
    {
        list($this->facebookId, $parentData) = unserialize($data);
        parent::unserialize($parentData);
    }

    /**
     * @var string
     *
     * @ORM\Column(name="participant_email", type="string", length=255, nullable=false)
     * @Assert\Email(message="This does not appear to be a valid e-mail address")
     */
    protected $participantEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="participant_firstname", type="string", length=45, nullable=true)
     */
    protected $participantFirstname;

    /**
     * @var string
     *
     * @ORM\Column(name="participant_lastname", type="string", length=45, nullable=true)
     */
    protected $participantLastname;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = "8",
     *      minMessage = "Your password name must be at least {{ limit }} characters")
     *      
     * @ORM\Column(name="participant_password", type="string", length=500, nullable=false)
     */
    protected $participantPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="participant_username", type="string", length=45, nullable=true)
     */
    protected $participantUsername;

    /**
     * @var string
     *
     * @ORM\Column(name="recovery_password_code", type="string", length=45, nullable=false)
     */
    protected $recoveryPasswordCode;

    /**
     * @var string
     *
     * @ORM\Column(name="participant_email_code", type="string", length=4, nullable=true)
     */
    protected $participantEmailCode;

    /**
     * @var boolean
     *
     * @ORM\Column(name="participant_email_confirmed", type="boolean", nullable=false)
     */
    protected $participantEmailConfirmed;

    /**
     * @var string
     *
     * @ORM\Column(name="participant_mobile_number", type="string", length=45, nullable=false)
     */
    protected $participantMobileNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="participant_mobile_sms_code", type="string", length=4, nullable=true)
     */
    protected $participantMobileSmsCode;

    /**
     * @var boolean
     *
     * @ORM\Column(name="participant_mobile_sms_code_confirmed", type="boolean", nullable=false)
     */
    protected $participantMobileSmsCodeConfirmed;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="participant_birthdate", type="date", nullable=true)
     */
    protected $participantBirthdate;

    /**
     * @var float
     *
     * @ORM\Column(name="participant_incentive_balance", type="float", nullable=false)
     */
    protected $participantIncentiveBalance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="participant_last_touch_datetime", type="datetime", nullable=false)
     */
    protected $participantLastTouchDatetime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="participant_datetime", type="datetime", nullable=true)
     */
    protected $participantDatetime;

    /**
     * @var string
     *
     * @ORM\Column(name="participant_address1", type="string", length=100, nullable=true)
     */
    protected $participantAddress1;

    /**
     * @var string
     *
     * @ORM\Column(name="participant_address2", type="string", length=45, nullable=true)
     */
    protected $participantAddress2;

    /**
     * @var string
     *
     * @ORM\Column(name="participant_zipcode", type="string", length=10, nullable=false)
     */
    protected $participantZipcode;

    /**
     * @var \City
     *
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="city_id", referencedColumnName="city_id")
     * })
     */
    protected $city;

    /**
     * @var \Country
     *
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="country_id", referencedColumnName="country_id")
     * })
     */
    protected $country;

    /**
     * @var \ParticipantRole
     *
     * @ORM\ManyToOne(targetEntity="ParticipantRole")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="participant_role_id", referencedColumnName="participant_role_id")
     * })
     */
    protected $participantRole;

    /**
     * @var \Race
     *
     * @ORM\ManyToOne(targetEntity="Race")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="race_id", referencedColumnName="race_id")
     * })
     */
    protected $race;

    /**
     * @var \RecoveryQuestion
     *
     * @ORM\ManyToOne(targetEntity="RecoveryQuestion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="recovery_question_id", referencedColumnName="recovery_question_id")
     * })
     */
    protected $recoveryQuestion;

    /**
     * @var \Sex
     *
     * @ORM\ManyToOne(targetEntity="Sex")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sex_id", referencedColumnName="sex_id")
     * })
     */
    protected $sex;

    /**
     * @var \State
     *
     * @ORM\ManyToOne(targetEntity="State")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="state_id", referencedColumnName="state_id")
     * })
     */
    protected $state;

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
     * Get participantId
     *
     * @return integer 
     */
    public function getParticipantId()
    {
        return $this->participantId;
    }

    /**
     * Set participantEmail
     *
     * @param string $participantEmail
     * @return Participant
     */
    public function setParticipantEmail($participantEmail)
    {
        $this->participantEmail = $participantEmail;
    
        return $this;
    }

    /**
     * Get participantEmail
     *
     * @return string 
     */
    public function getParticipantEmail()
    {
        return $this->participantEmail;
    }

    /**
     * Set participantFirstname
     *
     * @param string $participantFirstname
     * @return Participant
     */
    public function setParticipantFirstname($participantFirstname)
    {
        $this->participantFirstname = $participantFirstname;
    
        return $this;
    }

    /**
     * Get participantFirstname
     *
     * @return string 
     */
    public function getParticipantFirstname()
    {
        return $this->participantFirstname;
    }

    /**
     * Set participantLastname
     *
     * @param string $participantLastname
     * @return Participant
     */
    public function setParticipantLastname($participantLastname)
    {
        $this->participantLastname = $participantLastname;
    
        return $this;
    }

    /**
     * Get participantLastname
     *
     * @return string 
     */
    public function getParticipantLastname()
    {
        return $this->participantLastname;
    }

    /**
     * Set participantPassword
     *
     * @param string $participantPassword
     * @return Participant
     */
    public function setParticipantPassword($participantPassword)
    {
        $this->participantPassword = $participantPassword;
    
        return $this;
    }

    /**
     * Get participantPassword
     *
     * @return string 
     */
    public function getParticipantPassword()
    {
        return $this->participantPassword;
    }

    /**
     * Set participantUsername
     *
     * @param string $participantUsername
     * @return Participant
     */
    public function setParticipantUsername($participantUsername)
    {
        $this->participantUsername = $participantUsername;
    
        return $this;
    }

    /**
     * Get participantUsername
     *
     * @return string 
     */
    public function getParticipantUsername()
    {
        return $this->participantUsername;
    }

    /**
     * Set recoveryPasswordCode
     *
     * @param string $recoveryPasswordCode
     * @return Participant
     */
    public function setRecoveryPasswordCode($recoveryPasswordCode)
    {
        $this->recoveryPasswordCode = $recoveryPasswordCode;
    
        return $this;
    }

    /**
     * Get recoveryPasswordCode
     *
     * @return string 
     */
    public function getRecoveryPasswordCode()
    {
        return $this->recoveryPasswordCode;
    }

    /**
     * Set participantEmailCode
     *
     * @param string $participantEmailCode
     * @return Participant
     */
    public function setParticipantEmailCode($participantEmailCode)
    {
        $this->participantEmailCode = $participantEmailCode;
    
        return $this;
    }

    /**
     * Get participantEmailCode
     *
     * @return string 
     */
    public function getParticipantEmailCode()
    {
        return $this->participantEmailCode;
    }

    /**
     * Set participantEmailConfirmed
     *
     * @param boolean $participantEmailConfirmed
     * @return Participant
     */
    public function setParticipantEmailConfirmed($participantEmailConfirmed)
    {
        $this->participantEmailConfirmed = $participantEmailConfirmed;
    
        return $this;
    }

    /**
     * Get participantEmailConfirmed
     *
     * @return boolean 
     */
    public function getParticipantEmailConfirmed()
    {
        return $this->participantEmailConfirmed;
    }

    /**
     * Set participantMobileNumber
     *
     * @param string $participantMobileNumber
     * @return Participant
     */
    public function setParticipantMobileNumber($participantMobileNumber)
    {
        $this->participantMobileNumber = $participantMobileNumber;
    
        return $this;
    }

    /**
     * Get participantMobileNumber
     *
     * @return string 
     */
    public function getParticipantMobileNumber()
    {
        return $this->participantMobileNumber;
    }

    /**
     * Set participantMobileSmsCode
     *
     * @param string $participantMobileSmsCode
     * @return Participant
     */
    public function setParticipantMobileSmsCode($participantMobileSmsCode)
    {
        $this->participantMobileSmsCode = $participantMobileSmsCode;
    
        return $this;
    }

    /**
     * Get participantMobileSmsCode
     *
     * @return string 
     */
    public function getParticipantMobileSmsCode()
    {
        return $this->participantMobileSmsCode;
    }

    /**
     * Set participantMobileSmsCodeConfirmed
     *
     * @param boolean $participantMobileSmsCodeConfirmed
     * @return Participant
     */
    public function setParticipantMobileSmsCodeConfirmed(
            $participantMobileSmsCodeConfirmed)
    {
        $this->participantMobileSmsCodeConfirmed = $participantMobileSmsCodeConfirmed;
    
        return $this;
    }

    /**
     * Get participantMobileSmsCodeConfirmed
     *
     * @return boolean 
     */
    public function getParticipantMobileSmsCodeConfirmed()
    {
        return $this->participantMobileSmsCodeConfirmed;
    }

    /**
     * Set participantBirthdate
     *
     * @param \DateTime $participantBirthdate
     * @return Participant
     */
    public function setParticipantBirthdate($participantBirthdate)
    {
        $this->participantBirthdate = $participantBirthdate;
    
        return $this;
    }

    /**
     * Get participantBirthdate
     *
     * @return \DateTime 
     */
    public function getParticipantBirthdate()
    {
        return $this->participantBirthdate;
    }

    /**
     * Set participantIncentiveBalance
     *
     * @param float $participantIncentiveBalance
     * @return Participant
     */
    public function setParticipantIncentiveBalance(
            $participantIncentiveBalance)
    {
        $this->participantIncentiveBalance = $participantIncentiveBalance;

        return $this;
    }

    /**
     * Get participantIncentiveBalance
     *
     * @return float 
     */
    public function getParticipantIncentiveBalance()
    {
        return $this->participantIncentiveBalance;
    }

    /**
     * Set participantLastTouchDatetime
     *
     * @param \DateTime $participantLastTouchDatetime
     * @return Participant
     */
    public function setParticipantLastTouchDatetime(
            $participantLastTouchDatetime)
    {
        $this->participantLastTouchDatetime = $participantLastTouchDatetime;
    
        return $this;
    }

    /**
     * Get participantLastTouchDatetime
     *
     * @return \DateTime 
     */
    public function getParticipantLastTouchDatetime()
    {
        return $this->participantLastTouchDatetime;
    }

    /**
     * Set participantDatetime
     *
     * @param \DateTime $participantDatetime
     * @return Participant
     */
    public function setParticipantDatetime($participantDatetime)
    {
        $this->participantDatetime = $participantDatetime;
    
        return $this;
    }

    /**
     * Get participantDatetime
     *
     * @return \DateTime 
     */
    public function getParticipantDatetime()
    {
        return $this->participantDatetime;
    }

    /**
     * Set participantAddress1
     *
     * @param string $participantAddress1
     * @return Participant
     */
    public function setParticipantAddress1($participantAddress1)
    {
        $this->participantAddress1 = $participantAddress1;
    
        return $this;
    }

    /**
     * Get participantAddress1
     *
     * @return string 
     */
    public function getParticipantAddress1()
    {
        return $this->participantAddress1;
    }

    /**
     * Set participantAddress2
     *
     * @param string $participantAddress2
     * @return Participant
     */
    public function setParticipantAddress2($participantAddress2)
    {
        $this->participantAddress2 = $participantAddress2;
    
        return $this;
    }

    /**
     * Get participantAddress2
     *
     * @return string 
     */
    public function getParticipantAddress2()
    {
        return $this->participantAddress2;
    }

    /**
     * Set participantZipcode
     *
     * @param string $participantZipcode
     * @return Participant
     */
    public function setParticipantZipcode($participantZipcode)
    {
        $this->participantZipcode = $participantZipcode;
    
        return $this;
    }

    /**
     * Get participantZipcode
     *
     * @return string 
     */
    public function getParticipantZipcode()
    {
        return $this->participantZipcode;
    }

    /**
     * Set city
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\City $city
     * @return Participant
     */
    public function setCity(
            \Cyclogram\Bundle\ProofPilotBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\City 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Country $country
     * @return Participant
     */
    public function setCountry(
            \Cyclogram\Bundle\ProofPilotBundle\Entity\Country $country = null)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set participantRole
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantRole $participantRole
     * @return Participant
     */
    public function setParticipantRole(
            \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantRole $participantRole = null)
    {
        $this->participantRole = $participantRole;
    
        return $this;
    }

    /**
     * Get participantRole
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantRole 
     */
    public function getParticipantRole()
    {
        return $this->participantRole;
    }

    /**
     * Set race
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Race $race
     * @return Participant
     */
    public function setRace(
            \Cyclogram\Bundle\ProofPilotBundle\Entity\Race $race = null)
    {
        $this->race = $race;
    
        return $this;
    }

    /**
     * Get race
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Race 
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set recoveryQuestion
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\RecoveryQuestion $recoveryQuestion
     * @return Participant
     */
    public function setRecoveryQuestion(
            \Cyclogram\Bundle\ProofPilotBundle\Entity\RecoveryQuestion $recoveryQuestion = null)
    {
        $this->recoveryQuestion = $recoveryQuestion;
    
        return $this;
    }

    /**
     * Get recoveryQuestion
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\RecoveryQuestion 
     */
    public function getRecoveryQuestion()
    {
        return $this->recoveryQuestion;
    }

    /**
     * Set sex
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Sex $sex
     * @return Participant
     */
    public function setSex(
            \Cyclogram\Bundle\ProofPilotBundle\Entity\Sex $sex = null)
    {
        $this->sex = $sex;
    
        return $this;
    }

    /**
     * Get sex
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Sex 
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set state
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\State $state
     * @return Participant
     */
    public function setState(
            \Cyclogram\Bundle\ProofPilotBundle\Entity\State $state = null)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get state
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\State 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return Participant
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
    
    public function __toString()
    {
        return $this->participantFirstname . ' ' . $this->participantLastname;
    }
    
    public function isAccountNonExpired()
    {
        return true;
    }
    public function isAccountNonLocked()
    {
        return true;
    }
    public function isCredentialsNonExpired()
    {
        return true;
    }
    public function isEnabled()
    {
        return true;
    }
    
    /**
     * @param string $facebookId
     * @return void
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;
        $this->salt = '';
    }
    
    /**
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }
    
    public function getUsername()
    {
        // TODO: Implement getUsername() method.
        return $this->getParticipantEmail();
    }
    
    public function setFBData($fbdata)
    {
        if (isset($fbdata['id'])) {
            $this->setFacebookId($fbdata['id']);
        }
        if (isset($fbdata['first_name'])) {
            $this->setParticipantFirstname($fbdata['first_name']);
        }
        if (isset($fbdata['last_name'])) {
            $this->setParticipantLastname($fbdata['last_name']);
        }
        if (isset($fbdata['email'])) {
            $this->setParticipantEmail($fbdata['email']);
        }
//         $this->setParticipantEmail("riv.a.ntsiv@gmail.com");
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
    
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }
    
    public function getPassword()
    {
        return $this->participantPassword;
    }
    
    public function getRoles(){
        if(!empty($this->facebookId)) {
            return array_merge($this->participantRoles, array('ROLE_FACEBOOK_USER'));
        } else {
            return array_merge($this->participantRoles, array('ROLE_USER'));
        }
    }
    
    public function setRoles($role){
       $this->participantRoles = $role;
    }
    
    /* @UserInterface */
    public function equals(UserInterface $user)
    {
        return ( $this->getUsername() === $user->getUsername() );
    }
}
