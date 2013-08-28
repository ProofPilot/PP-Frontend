<?php
namespace Cyclogram\Bundle\ProofPilotBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class StudyRepository extends EntityRepository 
{
    /**
     * Check if study has organization with Site role linked
     * @param unknown_type $studyId
     */
    public function getOrganizationLinks($studyId)
    {
        return $this->getEntityManager()
        ->createQuery("
                SELECT sol.studyOrganizationLinkId, o.organizationName
                FROM CyclogramProofPilotBundle:StudyOrganizationLink sol
                INNER JOIN sol.status sol_status
                INNER JOIN sol.studyOrganizationRole role
                INNER JOIN sol.study study
                INNER JOIN sol.organization o
                INNER JOIN o.status organization_status
                WHERE
                study.studyId = :studyId
                AND sol_status.statusName = 'Active'
                AND organization_status.statusName = 'Active'
                AND role.studyOrganizationRoleName = 'Site'
                ")
                ->setParameter('studyId', $studyId)
                ->getResult();
    }
    
    /**
     * Check if studie's organization has any active default sites
     * @param unknown_type $studyId
     * @return boolean
     */
    public function getDefaultSites($studyId)
    {
        return $this->getEntityManager()
        ->createQuery("
                SELECT sol.studyOrganizationLinkId, sites.siteName
                FROM CyclogramProofPilotBundle:StudyOrganizationLink sol
                INNER JOIN sol.status sol_status
                INNER JOIN sol.studyOrganizationRole role
                INNER JOIN sol.study study
                INNER JOIN sol.organization o
                INNER JOIN o.status organization_status
                INNER JOIN o.sites sites
                INNER JOIN sites.status sites_status
                WHERE
                study.studyId = :studyId
                AND sol_status.statusName = 'Active'
                AND organization_status.statusName = 'Active'
                AND role.studyOrganizationRoleName = 'Site'
                AND sites.siteDefault = true
                AND sites_status.statusName = 'Active'
                ")
                ->setParameter('studyId', $studyId)
                ->getResult();
    }
    
     


}
