<?php
namespace Cyclogram\Bundle\ProofPilotBundle\Repository;

use Cyclogram\Bundle\ProofPilotBundle\Entity\CampaignSiteLink;

use Doctrine\ORM\EntityRepository;

class CampaignSiteLinkRepository extends EntityRepository
{
    /**
     * Gets the default campaign for study
     * @param unknown_type $studyId
     */
    public function getCSLParameters ($campaignName, $siteName)
    {
        $query = $this->getEntityManager()
        ->createQuery("
                SELECT csl, site, c
                FROM CyclogramProofPilotBundle:CampaignSiteLink csl
                INNER JOIN csl.campaign c
                LEFT JOIN c.campaignType ct
                INNER JOIN csl.site site
                INNER JOIN site.status site_status
                INNER JOIN c.status campaign_status
                WHERE
                site.siteName = :siteName
                AND c.campaignName = :campaignName
                AND site_status.statusName = 'Active'
                AND campaign_status.statusName = 'Active'
                ")
                ->setParameter('siteName', $siteName)
                ->setParameter('campaignName', $campaignName);
    
        $results = $query->getResult();
    
        if(empty($results))
            return null;
        else
            return $results[0];
    
    }
}
