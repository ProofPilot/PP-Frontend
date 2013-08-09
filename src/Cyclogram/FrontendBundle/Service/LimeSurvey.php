<?php
namespace Cyclogram\FrontendBundle\Service;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink;

use Symfony\Component\DependencyInjection\Container;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;

class LimeSurvey
{
    private $container;
    
    public function __construct (Container $container)
    {
        $this->container = $container;
    }
    
    public function sexproRegistration($participantId) {
        $surveyId = 468727;
        $sexProBaselineArm = 'SexProBaseLine';
        $sexPro3MonthArm = 'SexPro3Month';
        
        $em = $this->container->get('doctrine')->getEntityManager();
        
        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->find($participantId);
        
        $participantSurveyLink = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')->findOneBySidId($surveyId);
        if (isset($participantSurveyLink)) {
            $saveId = $participantSurveyLink->getSaveId();
            
            $lem = $this->container->get('doctrine')->getEntityManager('limesurvey');
            $participantSurvey = $lem->getRepository('CyclogramProofPilotBundleLime:LimeSurvey468727')->find($saveId);
            
            $surveyAge = $participantSurvey->getAge();
            $surveyCity = $participantSurvey->getLocation();
            
            switch ($surveyCity){
                case 'A1':
                    $cityName = 'San Francisco';
                    break;
                case 'A2':
                    $cityName = 'New York';
                    break;
                case 'A3': 
                    $cityName = 'Lima';
                    break;
                case 'A4':
                    $cityName = 'Rio de Janiero';
                    break;
            }
            
            $participant->setLocation($cityName);
            $participant->setAge($surveyAge);
            $em->persist($participant);
            $em->flush($participant);
            
            if ($surveyAge < 30){
                $minAge = 18;
                $maxAge = 30;
            } else {
                $minAge = 31;
                $maxAge = 90;
            }
            $firstArmParticipants = $em->getRepository('CyclogramProofPilotBundle:Participant')->countArmByCityAge($sexProBaselineArm, $cityName, $minAge, $maxAge);
            $secondArmParticipants = $em->getRepository('CyclogramProofPilotBundle:Participant')->countArmByCityAge($sexPro3MonthArm, $cityName, $minAge, $maxAge);
            $firstArm = $em->getRepository('CyclogramProofPilotBundle:Arm')->findOneByArmName($sexProBaselineArm);
            $secondArm = $em->getRepository('CyclogramProofPilotBundle:Arm')->findOneByArmName($sexPro3MonthArm);
            
            $participantArmLink = new ParticipantArmLink();
            if ($firstArmParticipants <= $secondArmParticipants){
                $participantArmLink->setArm($firstArm);
            } else {
                $participantArmLink->setArm($secondArm);
            }
            $participantArmLink->setParticipant($participant);
            $status = $em->getRepository('CyclogramProofPilotBundle:Status')->find(1);
            $participantArmLink->setStatus($status);
            $participantArmLink->setParticipantArmLinkDatetime(new \DateTime());
            $em->persist($participantArmLink);
            $em->flush($participantArmLink);
        }
    }
}
