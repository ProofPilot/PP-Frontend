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
         WHERE p.participantUsername = :username')
         ->setParameters(array(
                       'username' => $username
                        ))
         ->getOneOrNullResult();

    }
    
    public function loadUserByEmail($email)
    {
        return $this->getEntityManager()
        ->createQuery('SELECT p FROM
                CyclogramProofPilotBundle:Participant p
                WHERE p.participantEmail = :email')
                ->setParameters(array(
                        'email' => $email
                ))
                ->getOneOrNullResult();
    }
    
    public function refreshUser(UserInterface $user)
    {
        return $this->loadUserByEmail($user->getParticipantEmail());

    }
    public function supportsClass($class)
    {
        return $class === 'Cyclogram\Bundle\ProofPilotBundle\Entity\Participant';
    }
    
    public function getActiveParticipantInterventionsCount($userid){
        $currentDate = new \DateTime();
        
        return $this->getEntityManager()
        ->createQuery("SELECT COUNT (pil) FROM CyclogramProofPilotBundle:ParticipantInterventionLink pil
                INNER JOIN pil.status intervention_status
                WHERE pil.participant = :userid
                AND pil.participantInterventionLinkDatetimeStart <= :currentDate
                AND intervention_status.statusName = 'Active'
                ")
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
    
    public function getActiveParticipantInterventionLinks($userid){
    
        $currentDate = new \DateTime();
    
        return $this->getEntityManager()
        ->createQuery('SELECT pil, i, it, s FROM CyclogramProofPilotBundle:ParticipantInterventionLink pil
                INNER JOIN pil.intervention i
                INNER JOIN pil.status s
                INNER JOIN i.interventionType it
                WHERE pil.participant = :userid
                AND pil.participantInterventionLinkDatetimeStart <= :currentDate
                AND s.statusId = 1
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
                    OR p.participantAppreciationEmail = :email')
                    //AND p.participantEmailConfirmed = true')
            ->setParameter('email', $email)
            ->getSingleScalarResult();
        return $result;
    }
    
    public function checkIfUsernameNotUsed($username) {
        $result = $this->getEntityManager()
        ->createQuery('SELECT COUNT(p.participantUsername) FROM CyclogramProofPilotBundle:Participant p
                WHERE p.participantUsername = :username')
                //AND p.participantEmailConfirmed = true')
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
    public function countArmByCityAge($armCode, $city, $minAge, $maxAge) {
        return $this->getEntityManager()
        ->createQuery('SELECT COUNT(p) FROM CyclogramProofPilotBundle:ParticipantArmLink pal
                INNER JOIN pal.participant p
                INNER JOIN pal.arm a
                WHERE a.armCode = :armcode
                AND p.location = :city
                AND p.age >= :minage AND p.age < :maxage
                AND p.participantMobileSmsCodeConfirmed = 1
                ')
                ->setParameters(array(
                        'armcode' => $armCode,
                        'minage' => $minAge,
                        'maxage' => $maxAge,
                        'city' => $city
                 ))
                 ->getSingleScalarResult();
    }
    
    public function countAllArms($armCode) {
        return $this->getEntityManager()
        ->createQuery('SELECT COUNT(p) FROM CyclogramProofPilotBundle:ParticipantArmLink pal
                INNER JOIN pal.participant p
                INNER JOIN pal.arm a
                WHERE a.armCode = :armcode
                ')
                ->setParameters(array(
                        'armcode' => $armCode,
                ))
                ->getSingleScalarResult();
    }
    
    
    public function isEnrolledInStudy($participant, $studyCode) {
        $result = $this->getEntityManager()
        ->createQuery('SELECT COUNT(a) FROM CyclogramProofPilotBundle:ParticipantArmLink pal
                INNER JOIN pal.arm a
                INNER JOIN a.study s
                WHERE s.studyCode = :studycode
                AND pal.participant = :participant
                ')
                ->setParameter('studycode', $studyCode)
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
    
    
    
    /**
     * Get all participants who should receive email notifications with the specified parameters
     * @param int $reminderId  - reminder which is being sent
     * @param int $timeZoneId - time zone currently processed
     * @param int $contactTimeId - time frame
     */
    public function getParticipantsForEmailNotifications($reminderId, $timeZoneId, $contactTimeId, $weekDayId)
    {
        $query = $this->getEntityManager()
        ->createQuery("
                SELECT p
                FROM CyclogramProofPilotBundle:Participant p
                INNER JOIN p.contacttimelinks pctl
                INNER JOIN pctl.participantContactTime pct
                INNER JOIN p.studyreminderlinks psrl
                INNER JOIN psrl.participantStudyReminder psr
                WHERE psrl.byEmail = 1
                AND p.participantTimezone = :timeZoneId
                AND pct.participantContactTimesId = :contactTimeId
                AND psr.participantStudyReminderId = :reminderId
                AND pctl.participantWeekday = :weekDayId
                ")
                ->setParameter("timeZoneId", $timeZoneId)
                ->setParameter("contactTimeId", $contactTimeId)
                ->setParameter("reminderId", $reminderId)
                ->setParameter("weekDayId", $weekDayId);
        $results = $query->getResult();
        
        return $results;
    }
    
    /**
     * Get all participants who should receive SMS notifications with the specified parameters
     * @param int $reminderId  - reminder which is being sent
     * @param int $timeZoneId - time zone currently processed
     * @param int $contactTimeId - time frame
     */
    public function getParticipantsForSmsNotifications($reminderId, $timeZoneId, $contactTimeId, $weekDayId)
    {
        $query = $this->getEntityManager()
        ->createQuery("
                SELECT p
                FROM CyclogramProofPilotBundle:Participant p
                INNER JOIN p.contacttimelinks pctl
                INNER JOIN pctl.participantContactTime pct
                INNER JOIN p.studyreminderlinks psrl
                INNER JOIN psrl.participantStudyReminder psr
                WHERE psrl.bySMS = 1
                AND p.participantTimezone = :timeZoneId
                AND pct.participantContactTimesId = :contactTimeId
                AND psr.participantStudyReminderId = :reminderId
                AND pctl.participantWeekday = :weekDayId
                ")
                ->setParameter("timeZoneId", $timeZoneId)
                ->setParameter("contactTimeId", $contactTimeId)
                ->setParameter("reminderId", $reminderId)
                ->setParameter("weekDayId", $weekDayId);
        $results = $query->getResult();
    
        return $results;
    }

}
