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
    public function checkStudyArms($arm_codes, $study_code)
    {
            $armsInDB = $this->getEntityManager()
            ->createQuery("
                    SELECT COUNT (a)
                    FROM CyclogramProofPilotBundle:Arm a
                    INNER JOIN a.study s
                    WHERE
                    a.armCode IN ( :armcodes )
                    and s.studyId = :study_code
                    ")
                    ->setParameter('armcodes', $arm_codes)
                    ->setParameter('study_code', $study_code)
                    ->getSingleScalarResult();
            if($armsInDB != count($arm_codes)) {
                return false;
            }
        return true;
    }
    
    
    /**
     * Check if system contains required interventions
     * @param unknown_type $studyId
     * @return boolean
     */
    public function checkStudyInterventions($intervention_codes, $study_code)
    {
        if (empty($intervention_codes))
            return false;
            $interventionInDB = $this->getEntityManager()
            ->createQuery("
                    SELECT COUNT( DISTINCT i.interventionId )
                    FROM CyclogramProofPilotBundle:Intervention i
                    INNER JOIN i.study s
                    WHERE
                    i.interventionCode IN ( :interventioncode )
                    and s.studyId = :study_code
                    ")
                    ->setParameter('interventioncode', $intervention_codes)
                    ->setParameter('study_code', $study_code)
                    ->getSingleScalarResult();
                if($interventionInDB != count($intervention_codes)) {
                            return false;
                }
        return true;
    }
     


}
