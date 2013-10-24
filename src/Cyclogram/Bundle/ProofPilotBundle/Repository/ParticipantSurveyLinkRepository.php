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

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantSurveyLink;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Mapping as ORM;

class ParticipantSurveyLinkRepository extends EntityRepository
{
    public function getParticipantSurveyLink($participant, $surveyId, $saveId) {
        $em = $this->getEntityManager();
        $result = $em->createQuery('SELECT psl FROM CyclogramProofPilotBundle:ParticipantSurveyLink psl 
                WHERE psl.participant = :participant
                AND psl.sidId = :surveyId
                AND psl.saveId = :saveId')
                ->setParameters(array(
                        'surveyId' => $surveyId,
                        'saveId' => $saveId,
                        'participant' => $participant
                ))->getOneOrNullResult();
        if(isset($result)) {
            return $result;
        } else {
            return new ParticipantSurveyLink();
        }
    }
    
    /**
     * Check if participant has passed the survey 
     * 
     * @param unknown_type $participant
     * @param unknown_type $surveyId
     */
    public function checkIfSurveyPassed($participant, $surveyId) {
        $em = $this->getEntityManager();
        $result = $em->createQuery('SELECT psl FROM CyclogramProofPilotBundle:ParticipantSurveyLink psl
                WHERE psl.participant = :participant
                AND psl.sidId = :surveyId
                AND psl.status = :statusActive
                ')
                ->setParameters(array(
                        'surveyId' => $surveyId,
                        'participant' => $participant,
                        'statusActive' => ParticipantSurveyLink::STATUS_ACTIVE
                ))->getOneOrNullResult();
        if($result) {
            $result->setStatus(ParticipantSurveyLink::STATUS_CLOSED);
            $em->persist($result);
            $em->flush();
            return true;
        } else {
            return false;
        }
    }
}
