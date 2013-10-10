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


use Cyclogram\Bundle\ProofPilotBundle\Entity\StudyOrganizationLink;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Organization;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Affinity;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Placement;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Campaign;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Site;

use Doctrine\ORM\EntityRepository;

class CampaignRepository extends EntityRepository
{
    /**
     * Gets the default campaign for study
     * @param unknown_type $studyId
     */
    public function getDefaultCampaignParameters ($studyId)
    {
        $query = $this->getEntityManager()
        ->createQuery("
                SELECT csl.campaignSiteLinkId, c.campaignId, c.campaignName, ct.campaignTypeName, p.placementName, site.siteId, site.siteName, a.affinityName
                FROM CyclogramProofPilotBundle:CampaignSiteLink csl
                INNER JOIN csl.campaign c
                LEFT JOIN c.campaignType ct
                LEFT JOIN c.placement p
                LEFT JOIN c.affinity a
                INNER JOIN csl.site site
                INNER JOIN site.organization o
                INNER JOIN o.studyOrganizationLinks sol
                INNER JOIN sol.studyOrganizationRole role
                INNER JOIN sol.study study
                WHERE
                study.studyId = :studyId
                AND site.status = :sitestatus
                AND site.siteDefault = true
                AND c.status = :campaignstatus
                AND o.status = :organozationstatus
                AND sol.status = :solstatus
                AND p.status = :placementstatus
                AND a.status = :affinitystatus
                AND role.studyOrganizationRoleName = 'Site'
                ")
                ->setParameters(array(
                                      'studyId'=> $studyId,
                                      'sitestatus' => Site::STATUS_ACTIVE,
                                      'campaignstatus' => Campaign::STATUS_ACTIVE,
                                      'placementstatus' => Placement::STATUS_ACTIVE,
                                      'affinitystatus' => Affinity::STATUS_ACTIVE,
                                      'organozationstatus' => Organization::STATUS_ACTIVE,
                                      'solstatus' => StudyOrganizationLink::STATUS_ACTIVE
                        ));
        
        $results = $query->getResult();
        
        if(empty($results))
            return null;
        else 
            return $results[0];
    
    }
}
