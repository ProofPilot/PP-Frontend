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
        $studyContent->setStudyName("Sexual Health Promotion (SexPro) Study");
        $strAbout = <<<EOD
            <h2>About</h2>
            <p>The purpose of this study is to learn what men and transwomen like and don’t like about SexPro and how it affects their understanding of sexual protection 
               behaviors. We will also see whether Sex Pro helps men and transwomen to change their sexual health practices, and how using this tool affects counseling 
               sessions between our study participants and their HIV counselors.</p>
EOD;
        $strWhatsInvolved = <<<EOD
            <h2>What's involved?</h2>
            <p>You will be asked to come to the clinic for 3 different study visits: enrollment, 3 months and 6 months after enrollment. You will answer questions by 
               computer about your sexual and drug use practices at each of these visits, and then will meet with a study counselor, who will talk with you about ways 
               you can protect yourself against HIV infection.</p>
EOD;
        $strRequirements = <<<EOD
            <h2></h2>
            <p>You will receive SexPro instructions and start to use SexPro either at your first study visit or at your second study visit, depending on your 
               random group assignment.</p>
EOD;
        $strGraphicText = <<<EOD
          <span>Online Tool for Sexual Health Promotion</span>
          <p>SexPro is a part of a new study of online tools that might be helpful in keeping yourself HIV-negative inside and outside of your relationship(s).</p>
          <p><br></p>
          <p>Enroll in the study to get started!<br></p>
EOD;
        $studyContent->setStudyGraphicText($strGraphicText);
        $studyContent->setStudyAbout($strAbout);
        $studyContent->setStudyWhatsInvolved($strWhatsInvolved);
        $studyContent->setStudyRequirements($strRequirements);

        $manager->persist($studyContent);
        $manager->flush();

        
        $studyContent = new StudyContent();
        $language = $manager->getRepository('CyclogramProofPilotBundle:Language')->find(2);
        $study = $manager->getRepository('CyclogramProofPilotBundle:Study')->find(1);
        
        $studyContent->setStudy($study);
        $studyContent->setLanguage($language);
        $studyContent->setStudyLogo('/images/tmp_sexpro.png');
        $studyContent->setStudyGraphic('/images/tmp_img2.png');
        $studyContent->setStudyName("Promoción Estudio de la Salud Sexual (SexPro)");
        $strAbout = <<<EOD
            <h2>Sobre</h2>
            <p>El propósito de este estudio es conocer lo que los hombres y transexuales gusta y no les gusta de SexPro y cómo afecta a su comprensión de la protección sexual
                comportamientos. También vamos a ver si Sex Pro ayuda a los hombres y los transexuales a cambiar sus prácticas de salud sexual, y cómo el uso de esta herramienta afecta el asesoramiento
                sesiones entre los participantes del estudio y sus consejeros de VIH.</p>
EOD;
        $strWhatsInvolved = <<<EOD
            <h2>¿Qué implica?</h2>
            <p>Se le pedirá que acuda a la clínica por 3 visitas diferentes de estudio: matrícula, 3 meses y 6 meses después de la inscripción. Va a responder a las preguntas de
                equipo acerca de sus prácticas sexuales y uso de drogas en cada una de estas visitas, y luego se reunirá con un consejero de estudio, quien hablará con usted acerca de las formas
                usted puede protegerse contra la infección por el VIH..</p>
EOD;
        $strRequirements = <<<EOD
            <h2></h2>
            <p>Usted recibirá instrucciones SexPro y empezar a utilizar SexPro ya sea en su primera visita de estudio o en su segunda visita de estudio, dependiendo de su
                asignación a los grupos al azar.</p>
EOD;
        $strGraphicText = <<<EOD
          <span>Herramienta en línea para la Promoción de la Salud Sexual/span>
          <p>SexPro es una parte de un nuevo estudio de las herramientas en línea que pueden ser útiles para mantener a sí mismo en el interior del VIH-negativas y fuera de su relación (s).</p>
          <p><br></p>
          <p>Inscríbase en el estudio para empezar!<br></p>
EOD;
        $studyContent->setStudyGraphicText($strGraphicText);
        $studyContent->setStudyAbout($strAbout);
        $studyContent->setStudyWhatsInvolved($strWhatsInvolved);
        $studyContent->setStudyRequirements($strRequirements);
        
        $manager->persist($studyContent);
        $manager->flush();
        
        
    }
}