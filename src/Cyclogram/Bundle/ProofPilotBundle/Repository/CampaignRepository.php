<?php
namespace Cyclogram\Bundle\ProofPilotBundle\Repository;


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
                SELECT csl.campaignSiteLinkId, c.campaignName, ct.campaignTypeName, p.placementName, site.siteName, a.affinityName
                FROM CyclogramProofPilotBundle:CampaignSiteLink csl
                INNER JOIN csl.campaign c
                LEFT JOIN c.campaignType ct
                LEFT JOIN c.placement p
                LEFT JOIN c.affinity a
                INNER JOIN csl.site site
                INNER JOIN site.status site_status
                INNER JOIN c.status campaign_status
                INNER JOIN p.status placement_status
                INNER JOIN a.status affinity_status
                INNER JOIN site.organization o
                INNER JOIN o.status organization_status
                INNER JOIN o.studyOrganizationLinks sol
                INNER JOIN sol.studyOrganizationRole role
                INNER JOIN sol.study study
                WHERE
                study.studyId = :studyId
                AND site_status.statusName = 'Active'
                AND campaign_status.statusName = 'Active'
                AND organization_status.statusName = 'Active'
                AND placement_status.statusName = 'Active'
                AND affinity_status.statusName = 'Active'
                AND role.studyOrganizationRoleName = 'Site'
                ")
                ->setParameter('studyId', $studyId);
        
        $results = $query->getResult();
        
        if(empty($results))
            return null;
        else 
            return $results[0];
    
    }
}
