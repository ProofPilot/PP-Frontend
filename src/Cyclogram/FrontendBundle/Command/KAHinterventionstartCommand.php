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
namespace Cyclogram\FrontendBundle\Command;

use Cyclogram\CyclogramCommon;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class KAHinterventionstartCommand extends ContainerAwareCommand
{
    protected function configure(){
    
        $this->setName('send:kahintervetionstart')
        ->setDescription('Check if start KAHPhase3ReportResults intervention');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $intervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')->findOneByIntervetionCode('KAHPhase3Baseline');
        $study=$em->getRepository('CyclogramProofPilotBundle:Study')->findByStudyCode('knowathome');
        $status = $em->getRepository('CyclogramProofPilotBundle:Status')
                            ->findOneByStatusName("Closed");
        $currentDate = new \DateTime();
        $currentDay = $currentDate->format('z');
        $interventionLinks = $em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')->findByIntervention(array('intervention'=>$intervention, 'status'=>$status));
        foreach ($interventionLinks as $interventionLink) {
            $participant = $interventinLink->getParticipant();
            
            $order = $em->getRepository('CyclogramProofPilotBundle:Orders')->findOneBy(array('participant'=>$participant,'study'=>$study));
            $orderDate = $order->getOrderDatetime();
            $orderDay = $orderDate->format('z');
            
            if ((($currentDay - $orderDay) == 3) || (($currentDay - $orderDay) == -363) || (($currentDay - $orderDay) == -364)
                    || (($currentDay - $orderDay) == -365) || (($currentDay - $orderDay) == -366)) {

                $status = $em->getRepository('CyclogramProofPilotBundle:Status')
                ->find(1);
                $participantInterventionLink = new ParticipantInterventionLink();
                $intervention = $em
                ->getRepository('CyclogramProofPilotBundle:Intervention')
                ->findOneByInterventionCode('KAHPhase3ReportResults');
                $participantInterventionLink->setIntervention($intervention);
                $participantInterventionLink->setParticipant($participant);
                $participantInterventionLink
                ->setParticipantInterventionLinkDatetimeStart(
                        new \DateTime("now"));
                $participantInterventionLink->setStatus($status);
                $em->persist($participantInterventionLink);
                $em->flush($participantInterventionLink);
            }
        }
    }
}
