<?php
namespace Cyclogram\Bundle\ProofPilotBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class StudyContentRepository extends EntityRepository 
{
    
    public function getStudyContent ($studyUrl, $locale)
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
                SELECT sc, s, l
                FROM CyclogramProofPilotBundle:StudyContent sc
                JOIN sc.language l
                JOIN sc.study s
                WHERE 
                sc.studyUrl = :studyurl
                AND l.locale IN (:locales)
                ")
                ->setParameter('studyurl', $studyUrl)
                ->setParameter('locales', $fallbacks[$locale])
                ->getResult();
        
        foreach($fallbacks[$locale] as $locale) {
            foreach($results as $result) {
                if($result->getLanguage()->getLocale() == $locale)
                    return $result;
            }
        }
        
    }
    
    public function getStudyContentByCode ($studyCode, $locale)
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
                SELECT sc, s, l
                FROM CyclogramProofPilotBundle:StudyContent sc
                JOIN sc.language l
                JOIN sc.study s
                WHERE
                s.studyCode = :studycode
                AND l.locale IN (:locales)
                ")
                ->setParameter('studycode', $studyCode)
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
