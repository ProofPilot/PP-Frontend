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
    
    /**
     * Check if system contains required arms
     * @param unknown_type $studyId
     * @return boolean
     */
    public function checkStudyArms($arm_codes)
    {
        foreach($arm_codes as $armcode) {
            $arm = $this->getEntityManager()
            ->createQuery("
                    SELECT a
                    FROM CyclogramProofPilotBundle:Arm a
                    INNER JOIN a.study s
                    WHERE
                    a.armCode = :armcode
                    ")
                    ->setParameter('armcode', $armcode)
                    ->getOneOrNullResult();
            if(!$arm)
                return false;
        }
        return true;
    }
    
    
    /**
     * Check if system contains required interventions
     * @param unknown_type $studyId
     * @return boolean
     */
    public function checkStudyInterventions($intervention_codes)
    {
        foreach($intervention_codes as $interventionCode) {
            $intervention = $this->getEntityManager()
            ->createQuery("
                    SELECT i
                    FROM CyclogramProofPilotBundle:Intervention i
                    INNER JOIN i.study s
                    WHERE
                    i.interventionCode = :interventioncode
                    ")
                    ->setParameter('interventioncode', $interventionCode)
                    ->getOneOrNullResult();
            if(!$intervention)
                return false;
        }
        return true;
    }
     


}
