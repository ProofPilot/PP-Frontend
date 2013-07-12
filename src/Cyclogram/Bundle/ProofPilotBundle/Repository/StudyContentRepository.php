<?php
namespace Cyclogram\Bundle\ProofPilotBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class StudyContentRepository extends EntityRepository 
{
    
    public function getStudyContent ($studyId, $locale)
    {
        if($locale == "en")
            $languageId = 1;
        else if ($locale == "es")
            $languageId = 2;
        else if ($locale == "pt")
            $languageId = 3;
        
        $languages = array($languageId, 1);
        
        return $this->getEntityManager()
        ->createQuery("
                SELECT sc
                FROM CyclogramProofPilotBundle:StudyContent sc
                JOIN sc.language l
                JOIN sc.study s
                WHERE 
                s.studyId = :studyid
                AND l.languageId IN (:languages)
                ORDER BY l.languageId DESC")
                ->setParameter('studyid', $studyId)
                ->setParameter('languages', $languages)
                ->setMaxResults(1)
                ->getOneOrNullResult();
    }

}
