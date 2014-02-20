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
namespace Common;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Code;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Incentive;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Intervention;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Status;

class AbstractStudy
{
    protected $container;
    
    public function __construct($container)
    {
        $this->container = $container;
    }
    
    public function createIncentive(Participant $participant, Intervention $intervention, $incentiveTypeName = 'None') {
        $em = $this->container->get('doctrine')->getManager();
        $incentive = $em->getRepository('CyclogramProofPilotBundle:Incentive')->findOneBy(array('participant' => $participant, 'intervention' =>$intervention));
        if (empty($incentive)) {
            $incentiveType = $em->getRepository('CyclogramProofPilotBundle:IncentiveType')->findOneByIncentiveTypeName($incentiveTypeName);
            $incentive = new Incentive();
            $incentive->setParticipant($participant);
            $incentive->setIncentiveDatetime(new \DateTime());
            $incentive->setIncentiveAmount($intervention->getInterventionIncentiveAmount());
            $incentive->setIncentiveType($incentiveType);
            $incentive->setStatus(Incentive::STATUS_PENDING_APPROVAL);
            $incentive->setIntervention($intervention);
            $incentive->setInterventionLanguageid($intervention->getLanguage()->getLanguageId());
            $em->persist($incentive);
            $em->flush();
            $participantIncentiveBalance = $participant->getParticipantIncentiveBalance();
            $sum = $intervention->getInterventionIncentiveAmount() + $participantIncentiveBalance;
            $participant->setParticipantIncentiveBalance($sum);
            $em->persist($participant);
            $em->flush();
            
            $cc = $this->container->get('cyclogram.common');
            $embedded = array();
            $embedded = $cc->getEmbeddedImages();
            $parameters = array();
            $parameters['email'] = $participant->getParticipantEmail();
            $parameters['host'] = $this->container->getParameter('site_url');
            $parameters['locale'] = $participant->getLocale();
            $parameters["studies"] = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Study')->getRandomStudyInfo($participant->getLocale(), $participant);
            $parameters["incentiveAmount"] = $incentive->getIncentiveAmount();
             
            $cc->sendMail(null,
                    $participant->getParticipantEmail(),
                    $this->container->get('translator')->trans("email_incentive_title", array(), "email", $parameters['locale']),
                    'CyclogramFrontendBundle:Email:incentive_email.html.twig',
                    null,
                    $embedded,
                    true,
                    $parameters);
        }
    }
   
    public function setInterventionLinkExpiration(Intervention $intervention, ParticipantInterventionLink $interventionLink) {
        $interventionExpiredDate = $intervention->getInterventionExpirationDate();
        $interventionExpiredPeriod = $intervention->getInterventionExpirationPeriod();
        if (isset($interventionExpiredDate)) {
            $interventionLink->setParticipantInterventionLinkExpiarationDate($interventionExpiredDate);
        } elseif (isset($interventionExpiredPeriod)) {
            $date = new \DateTime("now");
            $date->add(new \DateInterval('P'.$interventionExpiredPeriod.'D'));
            $interventionLink->setParticipantInterventionLinkExpiarationDate($date);
        }
    }
    
    protected function findIntervention($interventionCode, $language){
    	$em = $this->container->get('doctrine')->getManager();
    	$intervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')
    			->findOneBy(array("interventionCode" => $interventionCode, "language" => $language));
    	if (empty($intervention)) {
    		$language = $em->getRepository('CyclogramProofPilotBundle:Language')->findOneBylocale('en');
    		$intervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')
    		->findOneBy(array("interventionCode" => $interventionCode, "language" => $language));
    		if(empty($intervention)) {
    			throw new \Exception("No intervention found with code \"" . $interventionCode . "\"");
    		}
    	} 
    	return $intervention;   	
    }
    
    protected function sendNotification($interventionLink, $participant) {
        $cc = $this->container->get('cyclogram.common');
        $em = $this->container->get('doctrine')->getManager();
        $embedded = array();
        $embedded = $cc->getEmbeddedImages();
        $locale =$participant->getLocale();
        $sendTime = $interventionLink->getParticipantInterventionLinkSendEmailTime();
        if (!is_null($sendTime))
            $sendTime = date('W') - $interventionLink->getParticipantInterventionLinkSendEmailTime()->format('W');
        if (is_null($sendTime) || $sendTime == 1 || $sendTime == -51){
            $interventionId = $interventionLink->getIntervention()->getInterventionId();
            $interventionContent = $em->getRepository("CyclogramProofPilotBundle:Intervention")->getInterventionContent($interventionId, $locale);
            
            $study = $interventionLink->getIntervention()->getStudy();
            $studyId = $study->getStudyId();
            $studyContent = $em->getRepository('CyclogramProofPilotBundle:StudyContent')->getStudyContentById($studyId, $locale);
            
            $intervention = array();
            $intervention["title"] = $interventionContent->getInterventionTitle();
            $intervention["content"] = $interventionContent->getInterventionDescripton();
            $interventionUrl = $this->getInterventionUrl($interventionLink, $locale);
            if (!empty($interventionUrl))
                $intervention["url"] =  $interventionUrl;
            else
                $intervention["url"] = $this->container->getParameter('site_url').$this->container->get('router')->generate('_signup', array('_locale' => $locale));
            $intervention["logo"] = $this->container->getParameter('study_image_url') . "/" . $studyId . "/" . $studyContent->getStudyLogo();
    
            $parameters["interventions"][] = $intervention;
            $parameters['email'] = $participant->getParticipantEmail();
            $parameters['locale'] = $participant->getLocale();
            $parameters['host'] = $this->container->getParameter('site_url');
            $parameters['siteurl'] = $this->container->getParameter('site_url').$this->getInterventionUrl($interventionLink, $locale);
            $parameters["studies"] = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Study')->getRandomStudyInfo($locale, $participant);
            
            $send = $cc->sendMail(null,
                        $participant->getParticipantEmail(),
                        $this->container->get('translator')->trans("do_it_task_email_title", array(), "email", $parameters['locale']),
                        'CyclogramFrontendBundle:Email:doitemail.html.twig',
                        null,
                        $embedded,
                        true,
                        $parameters);
            $interventionLink->setParticipantInterventionLinkSendEmailTime(new \DateTime());
            $em->persist($interventionLink);
        }
            $participantMobileNumber = $participant->getParticipantMobileNUmber();
            if (!is_null($participantMobileNumber)){ 
                $sendTime = $interventionLink->getParticipantInterventionLinkSendSmsTime();
                if (!is_null($sendTime))
                    $sendTime = date('W') - $interventionLink->getParticipantInterventionLinkSendSmsTime()->format('W');
                if (is_null($sendTime) || $sendTime == 1 || $sendTime == -51){
                    $interventionId = $interventionLink->getIntervention()->getInterventionId();
                    $interventionContent = $em->getRepository("CyclogramProofPilotBundle:Intervention")->getInterventionContent($interventionId, $locale);
                    $interventionUrl = $this->getInterventionUrl($interventionLink, $participant->getLocale());
                    $interventionTitle = strip_tags($interventionContent->getInterventionName());
                    if (!empty($interventionUrl))
                        $url = $cc::generateGoogleShorURL($interventionUrl);
                    else
                        $url = $cc::generateGoogleShorURL($this->container->getParameter('site_url').$this->container->get('router')->generate('_signup', array('_locale' => $locale)));
                    $sms = $this->container->get('sms');
                    $message = $this->container->get('translator')->trans('sms_title', array(), 'security', $locale);
                    $sentSms = $sms->sendSmsAction( array('message' => $message .': '. $interventionTitle.' '.$url, 'phoneNumber'=> $participant->getParticipantMobileNumber()) );
                    $interventionLink->setParticipantInterventionLinkSendSmsTime(new \DateTime());
                    $em->persist($interventionLink);
                }
            }
         $em->flush();
    }

    private function getInterventionUrl($interventionLink, $locale) {
        $intervention = $interventionLink->getIntervention();
    
        $studyCode = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Intervention')
        ->getInterventionStudyCode($intervention->getInterventionId());
    
        $typeName = $interventionLink->getIntervention()->getInterventionType()->getInterventionTypeName();
        switch($typeName) {
            case 'Activity':
                return $intervention->getInterventionUrl();
            case 'Survey & Observation':
                $surveyId = $intervention->getSidId();
                $redirectPath = $this->container->get('router')->generate('_main', array('_locale' => $locale));
                $path = $this->container->getParameter('site_url').$this->container->get('router')->generate('_survey_protected', array(
                        '_locale' => $locale,
                        'studyCode' => $studyCode,
                        'surveyId' => $surveyId,
                        'redirectUrl' => urlencode($redirectPath)
    
                ));
                return $path;
    
        }
    }
    
    protected function sendThankYouRefferalEmail($participant, $studyCode) {
        $locale = $participant->getLocale();
        $cc = $this->container->get('cyclogram.common');
        $embedded = array();
        $embedded = $cc->getEmbeddedImages();
        $studyContent =  $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:StudyContent')->findOneByStudyUrl($studyCode);
        $parameters = array();
        $parameters['email'] = $participant->getParticipantEmail();
        $parameters['host'] = $this->container->getParameter('site_url');
        $parameters['locale'] = $participant->getLocale();
        $parameters['studyName'] =  $studyContent->getStudyName();
        $parameters["studies"] = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Study')->getRandomStudyInfo($locale, $participant);
        
        $cc->sendMail(null,
                    $participant->getParticipantEmail(),
                    $this->container->get('translator')->trans("email_title_thank_you_refferal", array(), "email", $parameters['locale']),
                    'CyclogramFrontendBundle:Email:thanks_for_referral_email.html.twig',
                    null,
                    $embedded,
                    true,
                    $parameters);
    }
    
    protected function updatePromoCode($promoCodeId, $participant, $intervention) {
        
         $codeId = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Code')->getEmptyCode($promoCodeId, $intervention, $participant->getLocale());
         if (!empty($codeId)) {
             $em = $this->container->get('doctrine')->getManager();
             $code = $em->getRepository('CyclogramProofPilotBundle:Code')->find($codeId);
             $code->setCodeRedeemedByParticipant($participant);
             $code->setCodeRedeemedDatetime(new \DateTime());
             $em->persist($code);
             $interventionLink = $em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')->findOneBY(array('intervention' => $intervention, 'participant' => $participant));
             $interventionLink->setPromoCodeUsed(true);
             $em->persist($interventionLink);
             $em->flush();
             
             $cc = $this->container->get('cyclogram.common');
             $embedded = array();
             $embedded = $cc->getEmbeddedImages();
             $parameters = array();
             $parameters['email'] = $participant->getParticipantEmail();
             $parameters['host'] = $this->container->getParameter('site_url');
             $parameters['locale'] = $participant->getLocale();
             $parameters["studies"] = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Study')->getRandomStudyInfo($participant->getLocale(), $participant);
             $parameters["codeContent"] = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Code')->getCodeContentByCode($code->getCodeValue(), $participant, $promoCodeId);
             
             $cc->sendMail(null,
                     $participant->getParticipantEmail(),
                     $this->container->get('translator')->trans("email_promo_code_title", array(), "email", $parameters['locale']),
                     'CyclogramFrontendBundle:Email:promo_code_email.html.twig',
                     null,
                     $embedded,
                     true,
                     $parameters);
         }
    }
}
