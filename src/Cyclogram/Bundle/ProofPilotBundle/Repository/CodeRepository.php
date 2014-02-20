<?php
namespace Cyclogram\Bundle\ProofPilotBundle\Repository;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Code;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Intervention;

use Doctrine\ORM\EntityRepository;
class CodeRepository extends EntityRepository
{
    public function getEmptyCode($promocodeId, $intervention, $locale = 'en')
    {
        $language =  $this->getEntityManager()->getRepository('CyclogramProofPilotBundle:Language')->findOneByLocale($locale);
        return $this->getEntityManager()->createQuery("SELECT c.codeId FROM CyclogramProofPilotBundle:PromoCodeInterventionLink pcil
                INNER JOIN pcil.promoCode pc
                INNER JOIN pc.code c
                INNER JOIN pcil.intervention i
                WHERE pc.promoCodeId = :promocodeid
                AND c.codeRedeemedByParticipant is null
                AND i.interventionId = :intervention
                AND i.language = :language
                AND i.status = :istatus
                AND c.status = :cstatus")
                ->setMaxResults(1)
        ->setParameter('promocodeid', $promocodeId)
        ->setParameter('intervention', $intervention->getInterventionId())
        ->setParameter('language', $language)
        ->setParameter('istatus', Intervention::STATUS_ACTIVE)
        ->setParameter('cstatus', Code::STATUS_UNUSED)->getOneOrNullResult();
    }
    
    public function getCodesByParticipant($participant) {
        
        $language =  $this->getEntityManager()->getRepository('CyclogramProofPilotBundle:Language')->findOneByLocale($participant->getLocale());
        return $this->getEntityManager()->createQuery("
                SELECT pcc.promoCodeContentTitle, pcc.promoCodeContentUnlockMessage, pcc.promoCodeContentUrlForUnlock,
                       pcc.promoCodeContentUnlockShareMsg ,c.codeValue ,pc.promoCodeLogo
                FROM CyclogramProofPilotBundle:PromoCode pc
                INNER JOIN pc.code c
                INNER JOIN pc.promoCodeContent pcc
                WHERE c.codeRedeemedByParticipant = :participant
                AND c.status = :cstatus
                AND pcc.languageId = :language")
        ->setParameter('cstatus', Code::STATUS_UNUSED)
        ->setParameter('language', $language)
        ->setParameter('participant', $participant)->getResult();
    }
    
    public function getCodeContentByCode($codeValue, $participant, $promoCodeId) {
    
        $promoCode = $this->getEntityManager()->getRepository('CyclogramProofPilotBundle:PromoCode')->find($promoCodeId);
        $language =  $this->getEntityManager()->getRepository('CyclogramProofPilotBundle:Language')->findOneByLocale($participant->getLocale());
        return $this->getEntityManager()->createQuery("
                SELECT pcc.promoCodeContentTitle, pcc.promoCodeContentUnlockMessage, pcc.promoCodeContentUrlForUnlock,
                pcc.promoCodeContentUnlockShareMsg ,c.codeValue ,pc.promoCodeLogo
                FROM CyclogramProofPilotBundle:PromoCode pc
                INNER JOIN pc.code c
                INNER JOIN pc.promoCodeContent pcc
                WHERE c.codeValue = :code
                AND c.promoCode = :promocode
                AND c.status = :cstatus
                AND pcc.languageId = :language")
                ->setParameter('cstatus', Code::STATUS_UNUSED)
                ->setParameter('code', $codeValue)
                ->setParameter('language', $language)
                ->setParameter('promocode', $promoCode)->getOneOrNullResult();
    }
}
