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
        $intervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')->findOneByIntervetionCode('KAHPhase3TestPackage');
        $interventionLinks = $em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')->findByIntervention($intervention);
        foreach ($interventionLinks as $interventionLink) {
//             $participant = $interventin
        }
        $participants = $em->getRepository('CyclogramProofPilotBundle:Participant')->findByParticipantEmailConfirmed(false);
        $currentDate = new \DateTime();
        $currentDay = $currentDate->format('z');
        foreach ($participants as $participant) {
            $participantRegTime = $participant->getParticipantRegistrationtime();
            $participantRegDay = $participantRegTime->format('z');
            $participantRegDay = 366;
            $interval = $currentDay - $participantRegDay;
            if ((($currentDay - $participantRegDay) == 3) || (($currentDay - $participantRegDay) == -363) || (($currentDay - $participantRegDay) == -364)
                    || (($currentDay - $participantRegDay) == -365) || (($currentDay - $participantRegDay) == -366)) {
                // send email
                $result = $this->sendDoItNowEmail($participant);
                if($result['send'] == true){
                    $output->writeln($participant->getParticipantEmail());
                    $output->writeln("sent email");
                } else {
                    if (!empty($result['message']))
                    {
                        $output->writeln($participant->getParticipantEmail());
                        $output->writeln($result['message']);
                    }
                }
                $result = $this->sendDoItNowSMS($participant);
                if($result['send'] == true){
                    $output->writeln($participant->getParticipantUsername()." phone number: ".$participant->getParticipantMobileNumber());
                    $output->writeln("sent sms");
                } else {
                    if (!empty($result['message']))
                    {
                        $output->writeln($participant->getParticipantUsername()." phone number: ".$participant->getParticipantMobileNumber());
                        $output->writeln($result['message']);
                    }
                }
            }
        }
        $output->writeln("\n");
    }
}
