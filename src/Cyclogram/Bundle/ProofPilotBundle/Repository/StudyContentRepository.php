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

use Cyclogram\FrontendBundle\CyclogramFrontendBundle;

use Cyclogram\Bundle\ProofPilotBundle\Entity\StudyContent;

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
        		'zh_cn'=> array('zh_cn', 'en'),
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
                AND s.status IN (:studyStatus)
                ")
                ->setParameter('studyurl', $studyUrl)
                ->setParameter('locales', $fallbacks[$locale])
                ->setParameter('studyStatus', array(\Cyclogram\Bundle\ProofPilotBundle\Entity\Study::STATUS_ACTIVE, \Cyclogram\Bundle\ProofPilotBundle\Entity\Study::STATUS_PRELAUNCH))
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
        		'zh_cn'=> array('zh_cn', 'en'),
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
    
    public function getStudyContentById ($studyId, $locale)
    {
        $fallbacks = array(
                'en'=> array('en'),
                'es'=> array('es', 'en'),
                'pt'=> array('pt', 'en'),
                'fr'=> array('fr', 'en'),
        		'zh_cn'=> array('zh_cn', 'en'),
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
                sc.studyId = :studyid
                AND l.locale IN (:locales)
                ")
                ->setParameter('studyid', $studyId)
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
