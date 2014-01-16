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


use Cyclogram\Bundle\ProofPilotBundle\Entity\Study;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Site;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Organization;

use Cyclogram\Bundle\ProofPilotBundle\Entity\StudyOrganizationLink;

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
                INNER JOIN sol.studyOrganizationRole role
                INNER JOIN sol.study study
                INNER JOIN sol.organization o
                WHERE
                study.studyId = :studyId
                AND sol.status = :solstatus
                AND o.status = :organizationstatus
                AND role.studyOrganizationRoleName = 'Site'
                ")
                ->setParameters(array(
                                      'studyId' => $studyId,
                                      'solstatus' => StudyOrganizationLink::STATUS_ACTIVE,
                                      'organizationstatus' => Organization::STATUS_ACTIVE,
                        ))
                ->getResult();
    }
    
    /**
     * Check if study has organization with Affiliate role linked
     * @param unknown_type $studyId
     */
    public function getAffiliatedOrganization($studyId)
    {
        return $this->getEntityManager()
        ->createQuery("
                SELECT sol.studyOrganizationLinkId, o.organizationName, o.organizationLogo
                FROM CyclogramProofPilotBundle:StudyOrganizationLink sol
                INNER JOIN sol.studyOrganizationRole role
                INNER JOIN sol.study study
                INNER JOIN sol.organization o
                WHERE
                study.studyId = :studyId
                AND sol.status = :solstatus
                AND o.status = :organizationstatus
                AND role.studyOrganizationRoleName = 'Affiliate'
                ")
                ->setParameters(array(
                        'studyId' => $studyId,
                        'solstatus' => StudyOrganizationLink::STATUS_ACTIVE,
                        'organizationstatus' => Organization::STATUS_ACTIVE,
                ))
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
                INNER JOIN sol.studyOrganizationRole role
                INNER JOIN sol.study study
                INNER JOIN sol.organization o
                INNER JOIN o.sites sites
                WHERE
                study.studyId = :studyId
                AND sol.status = :solstatus
                AND o.status = :organizationstatus
                AND role.studyOrganizationRoleName = 'Site'
                AND sites.siteDefault = true
                AND sites.status = :sitestatus
                ")
                ->setParameters(array(
                                      'studyId' => $studyId,
                                      'solstatus' => StudyOrganizationLink::STATUS_ACTIVE,
                                      'organizationstatus' => Organization::STATUS_ACTIVE,
                                      'sitestatus' => Site::STATUS_ACTIVE
                        ))
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
    
    public function getStudyArms($study_code)
    {
        return $this->getEntityManager()
        ->createQuery("
                SELECT a
                FROM CyclogramProofPilotBundle:Arm a
                INNER JOIN a.study s
                WHERE s.studyCode = :study_code
                ")
                ->setParameter('study_code', $study_code)
                ->getResult();
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
     
    public function getParticipantsWithArmAndPeriod($armCode, $period)
    {
        $query = $this->getEntityManager()
        ->createQuery("
                SELECT p.participantId, p.participantEmail
                FROM CyclogramProofPilotBundle:ParticipantArmLink pal
                INNER JOIN pal.participant p
                INNER JOIN pal.arm a
                WHERE DATEDIFF(CURRENT_DATE(), pal.participantArmLinkDatetime) = :period
                AND a.armCode = :code
                AND pal.status = :palstatus
                ")->setParameters(array(
                                        'period' => $period,
                                        'code' => $armCode,
                                        'palstatus' => ParticipantArmLink::STATUS_ACTIVE));
        $results = $query->getResult();
        
        return $results;
    }
    
    public function countStudyParticipant($studyCode) {
        
        $query = $this->getEntityManager()
        ->createQuery("
                SELECT COUNT(p.participantId)
                FROM CyclogramProofPilotBundle:ParticipantArmLink pal
                INNER JOIN pal.participant p
                INNER JOIN pal.arm a
                INNER JOIN a.study s
                WHERE  s.studyCode = :code
                ")->setParameters(array('code' => $studyCode));
        $results = $query->getSingleScalarResult();
        
        return $results;
    }
    
    public function getStudyOrganizations($studyCode)
    {
        return $this->getEntityManager()
        ->createQuery("
                SELECT o.organizationName, o.organizationAddress1
                FROM CyclogramProofPilotBundle:Organization o
                WHERE o.status = :organizationstatus
                AND o.organizationId IN (SELECT org.organizationId FROM CyclogramProofPilotBundle:StudyOrganizationLink sol
                                         JOIN sol.study s
                                         JOIN sol.organization org
                                         WHERE s.studyCode = :code
                                         AND sol.status = :solstatus 
                                         GROUP BY sol.organization, sol.study)
                
                ")
                ->setParameters(array(
                        'code' => $studyCode,
                        'solstatus' => StudyOrganizationLink::STATUS_ACTIVE,
                        'organizationstatus' => Organization::STATUS_ACTIVE,
                ))
                ->getResult();
    }
    
    public function getStudyStaff($studyCode) {
    
        $query = $this->getEntityManager()
        ->createQuery("
                SELECT r.representativeFirstname, r.representativeLastname
                FROM CyclogramProofPilotBundle:Representative r
                INNER JOIN r.user u
                INNER JOIN r.organization o
                WHERE o.organizationId IN (SELECT org.organizationId FROM CyclogramProofPilotBundle:StudyOrganizationLink sol
                                         JOIN sol.study s
                                         JOIN sol.organization org
                                         WHERE s.studyCode = :code)
                AND u.userId IN (SELECT usr.userId FROM CyclogramProofPilotBundle:UserRoleLink url
                                 JOIN url.userUser usr
                                 JOIN url.userRoleUserRole ur
                                 WHERE ur.userRoleName = 'ROLE_STUDY_COORDINATOR')
                ")->setParameters(array('code' => $studyCode));
        $results = $query->getResult();
    
        return $results;
    }
    
    public function getRandomStudyInfo($locale, $participant = null) {
        
        $language =  $this->getEntityManager()->getRepository('CyclogramProofPilotBundle:Language')->findOneByLocale($locale);
        
        $studyies = $this->getEntityManager()
        ->createQuery("
                SELECT sc.studyId, sc.studyLogo, sc.studyName, sc.studyTagline, sc.studyGraphic, s.studyCode
                FROM CyclogramProofPilotBundle:StudyContent sc
                INNER JOIN sc.study s
                 WHERE sc.language = :lang
                AND s.studyAllowSharing = 1
                AND s.status =:status")->setParameters(array('lang' => $language,'status' => Study::STATUS_ACTIVE))->getResult();
        $results = array();
        if (isset($participant)) {
            $enrolledStudies = $this->getEntityManager()->getRepository('CyclogramProofPilotBundle:Participant')->getEnrolledStudies($participant);
            $enroledStudyName = array();
            foreach ($enrolledStudies as $study) {
                $enroledStudyName[$study->getStudyId()] = $study->getStudyCode();
            }
            foreach ($studyies as $study) {
                if (!array_key_exists($study['studyId'],$enroledStudyName))
                    $results[] = $study;
            }
        } else {
            foreach ($studyies as $study) {
                $results[] = $study;
            }
        }
        if (count($results) >= 3) {
            $resultsKeys = array_rand($results, 3);
            foreach ($resultsKeys as $key=>$val) {
                $studyResults[] = $results[$val]; 
            }
            return $studyResults;
        } else {
            return $results;
        }

    }
    
    public function getStudyParticipantInterventions($studyCode, $participant) {
        return $this->getEntityManager()
        ->createQuery('SELECT pil FROM
                CyclogramProofPilotBundle:ParticipantInterventionLink pil
                INNER JOIN pil.participant p
                INNER JOIN pil.intervention i
                INNER JOIN i.study s
                WHERE p.participantEmail = :email
                AND s.studyCode = :studyCode')
                ->setParameters(array(
                        'email' => $participant->getParticipantEmail(),
                        'studyCode' => $studyCode
                ))
                ->getResult();
    }

}
