<?php
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
    
}
