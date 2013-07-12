<?php
// src/Acme/HelloBundle/DataFixtures/ORM/LoadUserData.php

namespace Cyclogram\FrontendBundle\DataFixtures\ORM;

use Cyclogram\Bundle\ProofPilotBundle\Entity\StudyContent;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadStudyData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        
        $studyContent = new StudyContent();
        $language = $manager->getRepository('CyclogramProofPilotBundle:Language')->find(1);
        $study = $manager->getRepository('CyclogramProofPilotBundle:Study')->find(1);
        
        $studyContent->setStudy($study);
        $studyContent->setLanguage($language);
        $studyContent->setStudyLogo('/images/tmp_sexpro.png');
        $studyContent->setStudyGraphic('/images/tmp_img2.png');
        $str = <<<EOD
        <div class="home_text">
          <h2><br></h2>
            <h2>About</h2>
            <p>The purpose of this study is to learn what men and transwomen like and don’t like about SexPro and how it affects their understanding of sexual protection 
               behaviors. We will also see whether Sex Pro helps men and transwomen to change their sexual health practices, and how using this tool affects counseling 
               sessions between our study participants and their HIV counselors.</p>
            <h2>What's involved?</h2>
            <p>You will be asked to come to the clinic for 3 different study visits: enrollment, 3 months and 6 months after enrollment. You will answer questions by 
               computer about your sexual and drug use practices at each of these visits, and then will meet with a study counselor, who will talk with you about ways 
               you can protect yourself against HIV infection.</p>
            <h2></h2>
            <p>You will receive SexPro instructions and start to use SexPro either at your first study visit or at your second study visit, depending on your 
               random group assignment.</p>
            <div class="social_bar"><br></div>
        </div>'
EOD;
        $studyContent->setStudyAbout($str);
        
        
        


        $manager->persist($studyContent);
        $manager->flush();
    }
}