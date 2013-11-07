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

class ParticipantInterventionLinkRepository extends EntityRepository
{
    public function getStudyInterventionLinks($participant, $studyCode){
    
        return $this->getEntityManager()
        ->createQuery("SELECT pil, i, it FROM CyclogramProofPilotBundle:ParticipantInterventionLink pil
                INNER JOIN pil.intervention i
                INNER JOIN i.interventionType it
                INNER JOIN i.language l
                INNER JOIN i.study study
                WHERE pil.participant = :participant

                AND study.studyCode = :studycode
                AND l.locale = 'en'
                ")
                ->setParameters(array(
                        'participant' => $participant,
                        'studycode' => $studyCode))
                        ->getResult();
    }
    
    public function addParticipantInterventionLink($participant, $intervention, $check = true) {
        $em = $this->getEntityManager();
        
        $hasInterventionLink = null;
        //check if intervention link already exists for a participant
        if ($check) {
        $hasInterventionLink = $em->createQuery('SELECT pil, i FROM CyclogramProofPilotBundle:ParticipantInterventionLink pil
                INNER JOIN pil.intervention i
                WHERE pil.participant = :participant
                AND i.interventionName = :interventionName
                ')
                ->setParameter("participant", $participant)
                ->setParameter("interventionName", $intervention->getInterventionName())
                ->getOneOrNullResult();
        }
        if(!$hasInterventionLink) {
            $interventionLink = new ParticipantInterventionLink();
            $interventionLink->setParticipant($participant);
            $interventionLink->setIntervention($intervention);
            if ($intervention->getInterventionType()->getInterventionTypeName() == 'Test')
                $interventionLink->setStatus(ParticipantInterventionLink::STATUS_CLOSED);
            else
                $interventionLink->setStatus(ParticipantInterventionLink::STATUS_ACTIVE);
            $interventionLink->setParticipantInterventionLinkDatetimeStart( new \DateTime("now") );
            $em->persist($interventionLink);
            $em->flush();
        }
    
    }
    
    public function getActiveParticipantInterventionsCount($userid){
        $currentDate = new \DateTime();
    
        $query =  $this->getEntityManager()
        ->createQuery("SELECT COUNT (pil) FROM CyclogramProofPilotBundle:ParticipantInterventionLink pil
                INNER JOIN pil.intervention i
                INNER JOIN i.interventionType it
                INNER JOIN i.language l
                WHERE pil.participant = :userid
                AND pil.participantInterventionLinkDatetimeStart <= :currentDate
                AND pil.status = :pilstatus
                AND it.interventionTypeName <> 'Test'
                AND l.locale = 'en'")
                ->setParameters(array(
                        'userid' => $userid,
                        'currentDate' => $currentDate,
                        'pilstatus' => ParticipantInterventionLink::STATUS_ACTIVE
                ));
        return $query->getSingleScalarResult();
    }
    
    
    public function getActiveParticipantInterventionLinks($userid){
    
        $currentDate = new \DateTime();
    
        return $this->getEntityManager()
        ->createQuery('SELECT pil, i, it FROM CyclogramProofPilotBundle:ParticipantInterventionLink pil
                INNER JOIN pil.intervention i
                INNER JOIN i.interventionType it
                WHERE pil.participant = :userid
                AND pil.participantInterventionLinkDatetimeStart <= :currentDate
                AND pil.status  = :pilstatus
                AND it.interventionTypeName <> \'Test\'
                ')
                ->setParameters(array(
                        'userid' => $userid,
                        'currentDate' => $currentDate,
                        'pilstatus' => ParticipantInterventionLink::STATUS_ACTIVE))
                        ->getResult();
    }
    
    public function getNotSendParticipantInterventionLinks($userid, $sendType){
       
        if ($sendType == 'sms') {
        return $this->getEntityManager()
        ->createQuery('SELECT pil, i, it FROM CyclogramProofPilotBundle:ParticipantInterventionLink pil
                INNER JOIN pil.intervention i
                INNER JOIN i.study s
                INNER JOIN i.interventionType it
                WHERE pil.participant = :userid
                AND pil.status  = :pilstatus
                AND pil.participantInterventionLinkSendSmsTime IS NULL
                AND it.interventionTypeName <> \'Test\'
                AND s.studyCode <> \'sexpro\'
                ')
                ->setParameters(array(
                        'userid' => $userid,
                        'pilstatus' => ParticipantInterventionLink::STATUS_ACTIVE))
                        ->getResult();
        } 
        if ($sendType == 'email') {
            return $this->getEntityManager()
            ->createQuery('SELECT pil, i, it FROM CyclogramProofPilotBundle:ParticipantInterventionLink pil
                    INNER JOIN pil.intervention i
                    INNER JOIN i.study s
                    INNER JOIN i.interventionType it
                    WHERE pil.participant = :userid
                    AND pil.status  = :pilstatus
                    AND pil.participantInterventionLinkSendEmailTime IS NULL
                    AND it.interventionTypeName <> \'Test\'
                    AND s.studyCode <> \'sexpro\'
                    ')
                    ->setParameters(array(
                            'userid' => $userid,
                            'pilstatus' => ParticipantInterventionLink::STATUS_ACTIVE))
                            ->getResult();
        }
    }
    
    public function getParticipantByInterventionCodeAndPeriod($interventionCode, $period) {
        $query = $this->getEntityManager()
        ->createQuery("
                SELECT p.participantId, p.participantEmail
                FROM CyclogramProofPilotBundle:ParticipantInterventionLink pil
                INNER JOIN pil.participant p
                INNER JOIN pil.intervention i
                WHERE DATEDIFF(CURRENT_DATE(), pil.participantInterventionLinkDatetimeStart) = :period
                AND i.interventionCode = :code
                AND pil.status = :pilstatus
                ")->setParameters(array(
                                        'period' => $period,
                                        'code' => $interventionCode,
                                        'pilstatus' => ParticipantInterventionLink::STATUS_CLOSED));
        $results = $query->getResult();
        
        return $results;
    }
    
    public function checkIfExistParticipantInterventionLink($interventionCode, $participantId){
        $result = $this->getEntityManager()
        ->createQuery('SELECT COUNT(pil) FROM CyclogramProofPilotBundle:ParticipantInterventionLink pil
                INNER JOIN pil.participant p
                INNER JOIN pil.intervention i
                WHERE i.interventionCode = :code
                AND p.participantId = :participant
                ')
                ->setParameter('code', $interventionCode)
                ->setParameter('participant', $participantId)
                ->getSingleScalarResult();
        if($result)
            return true;
        else
            return false;
    }
}
