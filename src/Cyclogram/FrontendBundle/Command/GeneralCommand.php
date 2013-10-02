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

use Symfony\Component\Console\Input\ArgvInput;

use Symfony\Component\Console\Input\ArrayInput;

use Cyclogram\CyclogramCommon;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class GeneralCommand extends ContainerAwareCommand
{
    protected function configure(){

        $this->setName('run:generalcommand')
        ->setDescription('Run all proofpilot CLI commands');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $currentDate = new \DateTime();
        $currentHour =  $currentDate->format('H');
        $currentDay = $currentDate->format('z');
        $DoItNotificationCommand = $this->getApplication()->find('send:doitnotification');
        //send:doitnotification
        $output->writeln("<!--Running command send:doitnotification--!>");
        $returnCode = $DoItNotificationCommand->run($input, $output);
        if ($returnCode == 0) {
            $output->writeln("<!--send:doitnotification command complitet--!>"); 
        } else {
            $output->writeln("<!--send:doitnotification error--!>");
        }
        $output->writeln("\n");
        if ($currentHour == 14) {
            //send:verificationNotice
            $VerificationNoticeCommand = $this->getApplication()->find('send:verificationNotice');
            if (!empty($VerificationNoticeCommand)) {
                $output->writeln("<!--Running command send:verificationNotice--!>");
                $input = new ArrayInput(array('command' => 'send:verificationNotice', 'currentDay'=> $currentDay));
                $returnCode = $VerificationNoticeCommand->run($input, $output);
                if ($returnCode == 0) {
                    $output->writeln("<!--send:verificationNotice command complitet--!>");
                } else {
                    $output->writeln("<!--send:verificationNotice error--!>");
                }
            } else {
                $output->writeln("<!--Cant't find send:verificationNotice command--!>");
            }
            $output->writeln("\n");
            //send:kahintervetionstart
            $KAHInterventionstartCommand = $this->getApplication()->find('send:kahintervetionstart');
            if (!empty($VerificationNoticeCommand)) {
                $output->writeln("<!--Running command send:kahintervetionstart--!>");
                $input = new ArrayInput(array('command' => 'send:kahintervetionstart', 'currentDay'=> $currentDay));
                $returnCode = $KAHInterventionstartCommand->run($input, $output);
                if ($returnCode == 0) {
                    $output->writeln("<!--send:kahintervetionstart command complitet--!>");
                } else {
                    $output->writeln("<!--send:kahintervetionstart error--!>");
                }
            } else {
                $output->writeln("<!--Cant't find send:kahintervetionstart command--!>");
            }
            $output->writeln("\n");
        }
        
    }
}

