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
    
        $currentDate = new \DateTime();
    
        return $this->getEntityManager()
        ->createQuery("SELECT pil, i, it, s FROM CyclogramProofPilotBundle:ParticipantInterventionLink pil
                INNER JOIN pil.intervention i
                INNER JOIN pil.status s
                INNER JOIN i.interventionType it
                INNER JOIN i.language l
                INNER JOIN i.study study
                WHERE pil.participant = :participant
                AND pil.participantInterventionLinkDatetimeStart <= :currentDate
                AND study.studyCode = :studycode
                AND l.locale = 'en'
                ")
                ->setParameters(array(
                        'participant' => $participant,
                        'currentDate' => $currentDate,
                        'studycode' => $studyCode))
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
    
    public function getActiveParticipantInterventionsCount($userid){
        $currentDate = new \DateTime();
    
        $query =  $this->getEntityManager()
        ->createQuery("SELECT COUNT (pil) FROM CyclogramProofPilotBundle:ParticipantInterventionLink pil
                INNER JOIN pil.status intervention_status
                INNER JOIN pil.intervention i
                INNER JOIN i.interventionType it
                INNER JOIN i.language l
                WHERE pil.participant = :userid
                AND pil.participantInterventionLinkDatetimeStart <= :currentDate
                AND intervention_status.statusName = 'Active'
                AND it.interventionTypeName <> 'Test'
                AND l.locale = 'en'")
                ->setParameters(array(
                        'userid' => $userid,
                        'currentDate' => $currentDate
                ));
        return $query->getSingleScalarResult();
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
                AND it.interventionTypeName <> \'Test\'
                ')
                ->setParameters(array(
                        'userid' => $userid,
                        'currentDate' => $currentDate))
                        ->getResult();
    }
}
