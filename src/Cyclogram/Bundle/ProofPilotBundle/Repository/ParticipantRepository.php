<?php
namespace Cyclogram\Bundle\ProofPilotBundle\Repository;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink;

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
        $currentDate = new \DateTime();
        
        return $this->getEntityManager()
        ->createQuery('SELECT COUNT (pil) FROM CyclogramProofPilotBundle:ParticipantInterventionLink pil
                WHERE pil.participant = :userid
                AND pil.participantInterventionLinkDatetimeStart <= :currentDate
                ')
        ->setParameters(array(
                        'userid' => $userid,
                        'currentDate' => $currentDate
                ))
        ->getSingleScalarResult();
    }
    
    public function getParticipantInterventionLinks($userid){
        
        $currentDate = new \DateTime();
        
        return $this->getEntityManager()
        ->createQuery('SELECT pil, i, it, s FROM CyclogramProofPilotBundle:ParticipantInterventionLink pil
                INNER JOIN pil.intervention i
                INNER JOIN pil.status s
                INNER JOIN i.interventionType it
                WHERE pil.participant = :userid
                AND pil.participantInterventionLinkDatetimeStart <= :currentDate
                ')
                ->setParameters(array(
                        'userid' => $userid,
                        'currentDate' => $currentDate))
                        ->getResult();
    }
    
    public function addParticipantInterventionLink($participant, $intervention) {
        $em = $this->getEntityManager();
        
        //check if intervention link already exists for a participant 
        $hasInterventionLink = $em->createQuery('SELECT pil, i FROM CyclogramProofPilotBundle:ParticipantInterventionLink pil
                INNER JOIN pil.intervention i
                WHERE pil.participant = :participant
                AND i.interventionName = :interventionName
                ')
                ->setParameter("participant", $participant)
                ->setParameter("interventionName", $intervention->getInterventionName())
                ->getOneOrNullResult();
        
        if(!$hasInterventionLink) {
            $interventionLink = new ParticipantInterventionLink();
            $interventionLink->setParticipant($participant);
            $interventionLink->setIntervention($intervention);
            $interventionLink->setStatus($em->getRepository('CyclogramProofPilotBundle:Status')->findOneByStatusName("Active"));
            $interventionLink->setParticipantInterventionLinkDatetimeStart( new \DateTime("now") );
            $em->persist($interventionLink);
            $em->flush();
        }

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
    
    
    public function isEnrolledInStudy($participant, $studyId) {
        $result = $this->getEntityManager()
        ->createQuery('SELECT COUNT(a) FROM CyclogramProofPilotBundle:ParticipantArmLink pal
                INNER JOIN pal.arm a
                INNER JOIN a.study s
                WHERE s.studyId = :studyid
                AND pal.participant = :participant
                ')
                ->setParameter('studyid', $studyId)
                ->setParameter('participant', $participant)
                ->getSingleScalarResult();
        if($result)
            return true;
        else
            return false;
        
    }
    
    /**
     * Get all enrolled studies of participant
     * @param unknown_type $participant
     * @return unknown
     */
    public function getEnrolledStudies($participant) {
        $results = $this->getEntityManager()
        ->createQuery('SELECT pal FROM CyclogramProofPilotBundle:ParticipantArmLink pal
                INNER JOIN pal.arm a
                INNER JOIN a.study s
                WHERE pal.participant = :participant
                ')
                ->setParameter('participant', $participant)
                ->getResult();
        $studies = array();
        foreach($results as $result) {
            $study = $result->getArm()->getStudy();
            $studies[$study->getStudyId()] = $study;
        }
        
        return $studies;
    }

}
