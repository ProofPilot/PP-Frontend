<?php
namespace Cyclogram\Bundle\ProofPilotBundle\Repository;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantContactTimeLink;
use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantContactTime;

use Doctrine\ORM\EntityRepository;

/**
 * StudyLanguageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ParticipantContactTimeLinkRepository extends EntityRepository
{
    /**
     * Get all contact_time_links for participant
     * @param unknown_type $participant
     */
    public function getParticipantContactTimeLinks ($participant)
    {
        $query = $this->getEntityManager()
        ->createQuery("
                SELECT pctl
                FROM CyclogramProofPilotBundle:ParticipantContactTimeLink pctl
                WHERE
                pctl.participant = :participant
                ")
                ->setParameter("participant", $participant);
        
        $results = $query->getResult();
        
        return $results;
    }


    public function updateParticipantContactTimeLink($participant, $contactTime, $contactDay,  $isWeekdayActive, $isContactTimeActive)
    {
        $em = $this->getEntityManager();
        
        if(!$isWeekdayActive || !$isContactTimeActive) {
            $em->createQuery("
                    DELETE FROM CyclogramProofPilotBundle:ParticipantContactTimeLink pctl
                    WHERE
                    pctl.participant = :participant
                    AND
                    pctl.participantContactTime = :contacttime
                    AND
                    pctl.participantWeekday = :contactday
                    ")
                    ->setParameter("participant", $participant)
                    ->setParameter("contacttime", $contactTime)
                    ->setParameter("contactday", $contactDay)
                    ->execute();
        } else {
            $contactTimeLinks = $em->createQuery("
                SELECT COUNT(pctl)
                FROM CyclogramProofPilotBundle:ParticipantContactTimeLink pctl
                WHERE
                pctl.participant = :participant
                AND
                pctl.participantContactTime = :contacttime
                AND  
                pctl.participantWeekday = :contactday
            ")
            ->setParameter("participant", $participant)
            ->setParameter("contacttime", $contactTime)
            ->setParameter("contactday", $contactDay)
            ->getSingleScalarResult();
            
            if(!$contactTimeLinks) {
                $contactTimeLink = new ParticipantContactTimeLink();
                $contactTimeLink->setParticipant($participant);
                $contactTimeLink->setParticipantContactTime($contactTime);
                $contactTimeLink->setParticipantWeekday($contactDay);
                $em->persist($contactTimeLink);
                $em->flush();
            }
        }
    }
    

}
