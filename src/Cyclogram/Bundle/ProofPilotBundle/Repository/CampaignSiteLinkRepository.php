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

use Cyclogram\Bundle\ProofPilotBundle\Entity\Campaign;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Site;

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
                WHERE
                site.siteName = :siteName
                AND c.campaignName = :campaignName
                AND site.status = :sitestatus
                AND c.status = :campaignstatus
                ")
                ->setParameters(array('siteName' => $siteName,
                                      'campaignName' => $campaignName,
                                      ':sitestatus' => Site::STATUS_ACTIVE,
                                      'campaignstatus' => Campaign::STATUS_ACTIVE
                        ));
    
        $results = $query->getResult();
    
        if(empty($results))
            return null;
        else
            return $results[0];
    
    }
}
