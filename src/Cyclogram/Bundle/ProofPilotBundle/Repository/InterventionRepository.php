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

class InterventionRepository extends EntityRepository {
    
    public function getInterventionContent ($interventionId, $locale)
    {
        $fallbacks = array(
                'en'=> array('en'),
                'es'=> array('es', 'en'),
                'pt'=> array('pt', 'en'),
                'fr'=> array('fr', 'en'),
                'pt_BR'=> array('pt_BR', 'pt', 'en'),
                'es_MX'=> array('es_MX', 'es', 'en')
        );
    
    
        //try to get using full locale
        $results = $this->getEntityManager()
        ->createQuery("
                SELECT i, l
                FROM CyclogramProofPilotBundle:Intervention i
                JOIN i.language l
                WHERE
                i.interventionId = :interventionid
                AND l.locale IN (:locales)
                ")
                ->setParameter('interventionid', $interventionId)
                ->setParameter('locales', $fallbacks[$locale])
                ->getResult();
    
        foreach($fallbacks[$locale] as $locale) {
            foreach($results as $result) {
                if($result->getLanguage()->getLocale() == $locale)
                    return $result;
            }
        }
    
    }
    
    public function getInterventionStudyCode ($interventionId) 
    {
        $results = $this->getEntityManager()
        ->createQuery("
                SELECT ail, a, i, s
                FROM CyclogramProofPilotBundle:ArmInterventionLink ail
                INNER JOIN ail.arm a
                INNER JOIN ail.intervention i
                INNER JOIN a.study s
                WHERE
                i.interventionId = :interventionid
                ")
                ->setParameter('interventionid', $interventionId)
                ->getResult();
        
        $studies = array();
        foreach($results as $result) {
            $studies[$result->getArm()->getStudy()->getStudyCode()] = $result->getArm()->getStudy()->getStudyCode();
        }
        if($studies)
        {
            $ids = array_values($studies);
            return $ids[0];
        }
            
    }
    
    public function getInterventionByParticipantandCode ( $participantEmail, $interventionCode )
    {
            
            return $this->getEntityManager()->createQuery("SELECT pil FROM CyclogramProofPilotBundle:ParticipantInterventionLink pil
                    INNER JOIN pil.intervention i
                    INNER JOIN pil.participant p 
                    WHERE i.interventionCode = :interventionCode
                    AND p.participantEmail = :email
                    AND pil.status <> :dismiss
                    ")->setParameters(array('interventionCode' => $interventionCode,
                                            'email' => $participantEmail,
                                            'dismiss' => ParticipantInterventionLink::STATUS_DISMISS))->getSingleResult();

    }

    
    public function getAllParticipantIntervention ($participantEmail)
    {
        return $this->getEntityManager()->createQuery("SELECT pil FROM CyclogramProofPilotBundle:ParticipantInterventionLink pil
                INNER JOIN pil.participant p
                WHERE p.participantEmail = :email
                AND pil.status <> :dismiss
                ")->setParameter('email',$participantEmail)
                 ->setParameter('dismiss' , ParticipantInterventionLink::STATUS_DISMISS)->getResult();
        

    }
}
