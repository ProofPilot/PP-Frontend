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
}
