<?php
namespace Cyclogram\Bundle\ProofPilotBundle\Repository;

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
    

}
