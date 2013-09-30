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


class VerificationNoticeCommand extends ContainerAwareCommand
{
    protected function configure(){
        
        $this->setName('send:verificationNotice')
        ->setDescription('Send email&SMS with verificaion');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $em = $this->getContainer()->get('doctrine')->getManager();
        $participants = $em->getRepository('CyclogramProofPilotBundle:Participant')->findByParticipantEmailConfirmed(false);
        $currentDate = new \DateTime();
//         $currentDay = $currentDate->format('z');
        $currentDay = 3;
        foreach ($participants as $participant) {
            $participantRegTime = $participant->getParticipantRegistrationtime();
//             $participantRegDay = $participantRegTime->format('z');
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
    
    private function sendDoItNowEmail($participant) 
    {
        
        $cc = $this->getContainer()->get('cyclogram.common');
        $embedded['logo_top'] = realpath($this->getContainer()->getParameter('kernel.root_dir') . "/../web/images/newsletter_logo.png");
        $embedded['logo_footer'] = realpath($this->getContainer()->getParameter('kernel.root_dir') . "/../web/images/newletter_logo_footer.png");
        $embedded['login_button'] = realpath($this->getContainer()->getParameter('kernel.root_dir') . "/../web/images/newsletter_small_login.jpg");
        $embedded['white_top'] = realpath($this->getContainer()->getParameter('kernel.root_dir') . "/../web/images/newsletter_white_top.png");
        $embedded['white_bottom'] = realpath($this->getContainer()->getParameter('kernel.root_dir') . "/../web/images/newsletter_white_bottom.png");
        
        $parameters['email'] = $participant->getParticipantEmail();
        $parameters['locale'] = $participant->getLocale();
        $parameters['host'] = $this->getContainer()->getParameter('site_url');
        $parameters['code'] = $participant->getParticipantEmailCode();
        $path = $this->getContainer()->get('router')->generate('_send_verification_email', array(
                '_locale' => $parameters['locale'],
                'email' => $parameters['email'],
                'code' => $parameters['code'],
                'id' => $participant->getParticipantId()
        ));
        $parameters['siteurl'] = $this->getContainer()->getParameter('site_url').$path;

        $send = $cc->sendMail($participant->getParticipantEmail(),
                $this->getContainer()->get('translator')->trans("email_title_notice", array(), "email", $parameters['locale']),
                'CyclogramFrontendBundle:Email:verification_notice_email.html.twig',
                null,
                $embedded,
                true,
                $parameters);
        if ($send){
            return array('send' => true, 'message' => 'sent email');
        } else {
            return array('send' => false, 'message' => 'email not send');
        }
    }
    
    private function sendDoItNowSMS($participant) {
        $locale = $participant->getLocale();
        
        $cc = $this->getContainer()->get('cyclogram.common');
        $url = $cc::generateGoogleShorURL($this->getContainer()->getParameter('site_url').$this->getContainer()->get('router')->generate('_send_verification_email', array(
                '_locale' => $participant->getLocale(),
                'email' => $participant->getParticipantEmail(),
                'code' => $participant->getParticipantEmailCode(),
                'id' => $participant->getParticipantId()
        )));
        $sms = $this->getContainer()->get('sms');
        $message = $this->getContainer()->get('translator')->trans('sms_notice_title', array(), 'security', $locale);
        $sentSms = $sms->sendSmsAction( array('message' => $message.' '.$url , 'phoneNumber'=> $participant->getParticipantMobileNumber()) );
        if ($sentSms){
            return array('send' => true, 'message' => 'sent sms');
        } else {
            return array('send' => false, 'message' => 'sms not send');
        }
    }
}
