<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * StudyLanguageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StaticBlocksRepository extends EntityRepository
{
    public function getBlockContent ($blockName, $locale)
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
                SELECT sb, l
                FROM CyclogramProofPilotBundle:StaticBlocks sb
                JOIN sb.language l
                WHERE
                sb.blockName = :blockName
                AND l.locale IN (:locales)
                ")
                ->setParameter('blockName', $blockName)
                ->setParameter('locales', $fallbacks[$locale])
                ->getResult();
    
        foreach($fallbacks[$locale] as $locale) {
            foreach($results as $result) {
                if($result->getLanguage()->getLocale() == $locale)
                    return $result->getBlockContent();
            }
        }
    
    }
}