<?php
// src/Acme/HelloBundle/DataFixtures/ORM/LoadUserData.php

namespace Cyclogram\FrontendBundle\DataFixtures\ORM;
use Cyclogram\Bundle\ProofPilotBundle\Entity\StaticBlocks;

use Symfony\Component\DependencyInjection\ContainerAware;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;

use Cyclogram\Bundle\ProofPilotBundle\Entity\StudyContent;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\Container;

class LoadStaticData extends ContainerAware implements FixtureInterface, ContainerAwareInterface
{

    protected $container;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $staticBlock = new StaticBlocks();
        $language = $manager
                ->getRepository('CyclogramProofPilotBundle:Language')->find(1);
        
        $staticBlock->setLanguage($language);
        $staticBlock->setBlockName("privacy_security");
        $blockContent = <<<EOD
          <h4>We understand that you may be sharing some really sensitive stuff with ProofPilot, so we take your privacy and security very seriously.</h4>
          <p><br></p>
                      <h3>How does this compare to participating in research where my data is housed at a doctors office, clinic, or other research facility?</h3>
            <p>ProofPilot is required to keep your information as &ndash; or more &ndash; secure than the medical information housed in a doctor’s office, 
                                   clinic or other research facility. In addition, you do not need to call to make an appointment, walk in the door, or wait in a 
                                   lobby where others may see you.</p>
               
                      <h3>Am I at greater risk of someone discovering sensitive information by using ProofPilot compared to other research venues?</h3>
            <p>ProofPilot is required to keep your information as &ndash; or more &ndash;                 secure than the medical information housed in 
                                   a doctor’s office, clinic or other research facility. In addition, you do not need to call to make an appointment, walk in the door, 
                                   or wait in a lobby where others may see you.</p>
               
                      <h3>What exactly do you mean by confidential?</h3>
            <p>You may have heard of anonymous research studies.  In those cases, you do not provide any identifying information. 
                                   With the Internet, anonymity is very difficult to achieve. IP addresses, usernames, passwords, logins &ndash; this is all identifying information. 
                                   ProofPIlot makes participation in research studies confidential.  Any data you provide to ProofPilot will stay completely encrypted - 
                                   strictly confidential. Make sure you carefully read the consent information for the specific study you are joining to understand how your 
                                   data will be used. </p>
               
                      <h3>What information do you collect and why?</h3>
            <p>ProofPilot collects information on behalf of research studies. This information spans a wide perspective &ndash; everything from sexual habits, to weight, 
                                   to how much money you make each year.  The exact data we collect depends on the research study goals.  Make sure you read the specific study consent 
                                   information carefully before joining a study to understand exactly what kinds of data are being collected.</p>
               
                      <h3>Most sites don’t ask for a mobile phone number. Why does ProofPilot?</h3>
            <p>To increase security, ProofPilot uses dual-factor authentication. We ask that you use your username and a password, like any other site, to log into 
                                   the system. However, to increase security, we then send you a random four-digit code by SMS text message. You must enter that code before getting 
                                   access to the site. We may also use this number to call you in case we need to speak with you personally.</p>
               
                      <h3>Who has access to my data?</h3>
            <p>When you choose to participate in a research study, you are choosing to share your data (based on the terms and conditions of the study available in 
                                   the consent information) with a research organization using the ProofPilot infrastructure to help manage their effort. The name of that research 
                                   organization is identified on the study homepage. It will have access to your data.</p>
               
                      <h3>How secure is my data? </h3>
            <p>ProofPilot takes a security-first approach. ProofPilot houses your data in an encrypted form on a dedicated server separate from the website and the 
                                   Internet via advanced firewalls. We always transmit personal and financial information via industry standard secure socket layer technology, 
                                   preventing potential malicious hackers from accessing data while it is being transmitted.</p>
               
                      <h3>How can I protect my account?</h3>
            <p>ProofPilot goes to great lengths to protect your data. There are some things you can do to make it even safer: </p>
                              <ul>
                                      <li>Choose a complex password with letters and numbers, and don’t share it with anyone.</li>
                                      <li>Make sure you have virus protection software on any computer that you use to access ProofPilot.</li>
                                      <li>Be wary about installing programs from companies that you are not familiar with.</li>
                                      <li>If you receive an email from ProofPilot that seems suspicious, contact us immediately and report it. 
                                 It could be another organization posing as ProofPilot.</li>
                                  </ul>
               
                      <h3>What happens to my data if I close my account or I’m finished with ProofPilot’s services? </h3>
            <p>If you close your account, your data remains housed on the secure servers as an inactive participant for up to three years. Your data will stay on 
                                   the server in an encrypted format and it will not be shared with anyone.</p>
               
EOD;

        $staticBlock->setBlockContent($blockContent);
        
        $manager->persist($staticBlock);
        $manager->flush();
        

        $aboutBlock = new StaticBlocks();
        
        $aboutBlock->setLanguage($language);
        $aboutBlock->setBlockName("about_proofpilot");
        $blockContent = <<<EOD
            <h3>About ProofPilot</h3>
            <p>ProofPilot is a platform to create, manage, and participate in online research studies. We help researchers easily launch studies that you, the participant, 
                           can join in order to answer some important questions about health, human behavior, social and public policy. Learn more about ProofPilot with the link below.</p>
            <p><a href="#">www.proofpilot.com</a></p>
EOD;
        $aboutBlock->setBlockContent($blockContent);
        $manager->persist($aboutBlock);
        $manager->flush();



    }


}
