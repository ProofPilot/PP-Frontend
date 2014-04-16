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
    try {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $participants = $em->getRepository('CyclogramProofPilotBundle:Participant')->getParticipantAndStudyInfo();
        $studyies = $em->getRepository('CyclogramProofPilotBundle:Study')->getAllStudyContent();
        
        $participantId = null;
        $participantsArray = array();

        foreach ($participants as $participant) {
            
                    $participantId = $participant['participantId'];
                    if (array_key_exists($participantId, $participantsArray)) {
                        $participantsArray[$participantId]['studies'][] = $participant['studyCode'];
                    } else {
                        $participantsArray[$participantId]['id'] = $participant['participantId'];
                        $participantsArray[$participantId]['email'] = $participant['participantEmail'];
                        $participantsArray[$participantId]['emailCode'] = $participant['participantEmailCode'];
                        $participantsArray[$participantId]['locale'] = $participant['locale'];
                        $participantsArray[$participantId]['studies'][] = $participant['studyCode'];
                        $participantsArray[$participantId]['username'] = $participant['participantUsername'];
                        $participantsArray[$participantId]['mobile'] = $participant['participantMobileNumber'];
                    }

                
        }
        foreach ($participantsArray as $participant){
                try {
                    $result = $this->sendDoItNowEmail($participant, $studyies);
                    if($result['send'] == true){
                        $output->writeln($participant['email']);
                        $output->writeln("sent email");
                    } else {
                        if (!empty($result['message']))
                        {
                            $output->writeln($participant['email']);
                            $output->writeln($result['message']);
                        }
                    }
                } catch (\Exception $e){}
                if (!empty($participant['mobile'])) {
                    try {
                        $result = $this->sendDoItNowSMS($participant, $studyies);
                        if($result['send'] == true){
                            $output->writeln($participant['username']." phone number: ".$participant['mobile']);
                            $output->writeln("sent sms");
                        } else {
                            if (!empty($result['message']))
                            {
                                $output->writeln($participant['username']." phone number: ".$participant['mobile']);
                                $output->writeln($result['message']);
                            }
                        }
                    } catch (\Exception $e){}
                }
        }
    } catch (\Exception $e) {
        throw new \Exception();
    }
//         }
    }
    
    private function sendDoItNowEmail($participant, $studyies) 
    {
        try {
            $cc = $this->getContainer()->get('cyclogram.common');
            
            $embedded = array();
            $embedded = $cc->getEmbeddedImages();
            
            $parameters['email'] = $participant['email'];
            $parameters['locale'] = $participant['locale'];
            $parameters['host'] = $this->getContainer()->getParameter('site_url');
            $parameters['code'] = $participant['emailCode'];
            $randomStudies = array();
            foreach ($studyies as $study) {
                if (!in_array($study['studyCode'], $participant['studies']))
                $randomStudies[] = $study;
            }
            $parameters["studies"] = $randomStudies;
            $path = $this->getContainer()->get('router')->generate('email_verify', array(
                    '_locale' => $parameters['locale'],
                    'email' => $parameters['email'],
                    'code' => $parameters['code']
            ));
            $parameters['siteurl'] = $this->getContainer()->getParameter('site_url').$path;
    
            $send = $cc->sendMail(null,
                    $participant['email'],
                    $this->getContainer()->get('translator')->trans("email_title_notice", array(), "email", $parameters['locale']),
                    'CyclogramFrontendBundle:Email:verification_notice_email.html.twig',
                    null,
                    $embedded,
                    true,
                    $parameters);
            if ($send['status'] == true){
                return array('send' => true, 'message' => 'sent email');
            } else {
                return array('send' => false, 'message' => 'email not send');
            }
        }catch (\Exception $e) {
            throw new \Exception(); 
        }
    }
    
    private function sendDoItNowSMS($participant, $studyies) 
    {
        try {
            $locale = $participant['locale'];
            
            $cc = $this->getContainer()->get('cyclogram.common');
            $url = $cc::generateGoogleShorURL($this->getContainer()->getParameter('site_url').$this->getContainer()->get('router')->generate('_send_verification_email', array(
                    '_locale' => $participant['locale'],
                    'email' => $participant['email'],
                    'code' => $participant['emailCode'],
                    'id' => $participant['id']
            )));
            $sms = $this->getContainer()->get('sms');
            $message = $this->getContainer()->get('translator')->trans('sms_notice_title', array(), 'security', $locale);
            $sentSms = $sms->sendSmsAction( array('message' => $message.' '.$url , 'phoneNumber'=> $participant['mobile']) );
            if ($sentSms){
                return array('send' => true, 'message' => 'sent sms');
            } else {
                return array('send' => false, 'message' => 'sms not send');
            }
        } catch (\Exception $e) {
            throw new \Exception(); 
        }
    }
}
