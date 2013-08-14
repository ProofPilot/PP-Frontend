<?php
namespace Cyclogram\Bundle\ProofPilotBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class ParticipantRepository extends EntityRepository implements
        UserProviderInterface
{

    public function loadUserByUsername($username)
    {
        return $this->getEntityManager()
         ->createQuery('SELECT p FROM
         CyclogramProofPilotBundle:Participant p
         WHERE p.participantEmail = :username
         OR p.participantUsername = :username')
         ->setParameters(array(
                       'username' => $username
                        ))
         ->getOneOrNullResult();

    }
    public function refreshUser(UserInterface $user)
    {
        return $this->loadUserByUsername($user->getUsername());

    }
    public function supportsClass($class)
    {
        return $class === 'Cyclogram\Bundle\ProofPilotBundle\Entity\Participant';
    }
    
    public function getParticipantInterventionsCount($userid){
        return $this->getEntityManager()
        ->createQuery('SELECT COUNT (pi) FROM CyclogramProofPilotBundle:ParticipantInterventionLink pi
                WHERE pi.participant = :userid')
        ->setParameters(array(
                        'userid' => $userid))
        ->getSingleScalarResult();
    }
    
    public function getParticipantInterventions($userid){
        return $this->getEntityManager()
        ->createQuery('SELECT pi FROM CyclogramProofPilotBundle:ParticipantInterventionLink pi
                WHERE pi.participant = :userid')
                ->setParameters(array(
                        'userid' => $userid))
                        ->getResult();
    }
    
    public function checkIfEmailNotUsed($email) {
        $result = $this->getEntityManager()
            ->createQuery('SELECT COUNT(p.participantEmail) FROM CyclogramProofPilotBundle:Participant p
                    WHERE p.participantEmail = :email
                    AND p.participantEmailConfirmed = true')
            ->setParameter('email', $email)
            ->getSingleScalarResult();
        return $result;
    }
    
    public function checkIfUsernameNotUsed($username) {
        $result = $this->getEntityManager()
        ->createQuery('SELECT COUNT(p.participantUsername) FROM CyclogramProofPilotBundle:Participant p
                WHERE p.participantUsername = :username
                AND p.participantEmailConfirmed = true')
                ->setParameter('username', $username)
                ->getSingleScalarResult();
        return $result;
    }
    
    public function checkIfPhoneNotUsed($phone) {
        $result = $this->getEntityManager()
        ->createQuery('SELECT COUNT(p.participantMobileNumber) FROM CyclogramProofPilotBundle:Participant p
                WHERE p.participantMobileNumber = :phone
                AND p.participantMobileSmsCodeConfirmed = true')
                ->setParameter('phone', $phone)
                ->getSingleScalarResult();
        return $result;
    }
    
    public function getUnfinishedParticipant($username, $email) {
        $result = $this->getEntityManager()
        ->createQuery('SELECT p FROM CyclogramProofPilotBundle:Participant p
                WHERE (p.participantUsername = :username
                OR p.participantEmail = :email)
                AND p.participantEmailConfirmed = false
                ')
                ->setParameters(array(
                        'username' => $username,
                        'email' => $email
                        ))
                 ->getOneOrNullResult();
        return $result;
    }
    
    /**
     * Get count of participants in arm within age/city group
     * @param unknown_type $armName
     * @param unknown_type $city
     * @param unknown_type $minAge
     * @param unknown_type $maxAge
     */
    public function countArmByCityAge($armName, $city, $minAge, $maxAge) {
        return $this->getEntityManager()
        ->createQuery('SELECT COUNT(p) FROM CyclogramProofPilotBundle:ParticipantArmLink pal
                INNER JOIN pal.participant p
                INNER JOIN pal.arm a
                WHERE a.armName = :armname
                AND p.location = :city
                AND p.age >= :minage AND p.age < :maxage
                AND p.participantMobileSmsCodeConfirmed = 1
                ')
                ->setParameters(array(
                        'armname' => $armName,
                        'minage' => $minAge,
                        'maxage' => $maxAge,
                        'city' => $city
                 ))
                 ->getSingleScalarResult();
    }

}
