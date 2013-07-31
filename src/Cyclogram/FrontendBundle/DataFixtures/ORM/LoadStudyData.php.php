<?php
// src/Acme/HelloBundle/DataFixtures/ORM/LoadUserData.php

namespace Cyclogram\FrontendBundle\DataFixtures\ORM;
use Symfony\Component\DependencyInjection\ContainerAware;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;

use Cyclogram\Bundle\ProofPilotBundle\Entity\StudyContent;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\Container;

class LoadStudyData extends ContainerAware implements FixtureInterface, ContainerAwareInterface
{

    protected $container;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $studyContent = new StudyContent();
        $language = $manager
                ->getRepository('CyclogramProofPilotBundle:Language')->find(1);
        $study = $manager->getRepository('CyclogramProofPilotBundle:Study')
                ->find(7);

        $studyContent->setStudy($study);
        $studyContent->setLanguage($language);
        $studyLogo = $this->container->getParameter('study_image_url') . '/' . $study->getStudyId(). '/logo-7-en.png';
        $studyGraphic = $this->container->getParameter('study_image_url') . '/' . $study->getStudyId(). '/graphic-7-en.png';
        $studyContent->setStudyLogo($studyLogo);
        $studyContent->setStudyGraphic($studyGraphic);
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
        $strStudyTagline = <<<EOD
          <span>Online Tool for Sexual Health Promotion</span>
EOD;
        $strStudyDescription = <<<EOD
          <p>SexPro is a part of a new study of online tools that might be helpful in keeping yourself HIV-negative inside and outside of your relationship(s).</p>
          <p><br></p>
          <p>Enroll in the study to get started!<br></p>
EOD;
        $strStudyConsentIntroduction = <<<EOD
          <p>The purpose of this study is to learn what men and transwomen like and don’t like about SexPro and how it affects their understanding of sexual protection
                behaviors. We will also see whether Sex Pro helps men and transwomen to change their sexual health practices, and how using this tool affects counseling
                sessions between our study participants and their HIV counselors.</p>
EOD;
        $strStudyConsent = <<<EOD
          <h2>What’s Involved?</h2>
        <p style="color: #7e7e7e;">Taking part in this study is your choice.  You may choose either to take part or not to take part in the study.  If you decide to take part in this
                        study, you may leave the study at any time.  No matter what decision you make, there will be no penalty to you in any way. You can still get your care
                        from our institution the way you usually do.We will tell you about new information or changes in the study that may affect your health or your willingness
                        to continue in the study.</p>
        <h2>What are my rights if I take part in this study?</h2>
        <p style="color: #7e7e7e;">Taking part in this study is your choice. You may choose either to take part or not to take part in the study. If you decide to take part in this study,
                        you may leave the study at any time.  No matter what decision you make, there will be no penalty to you in any way. You can still get your care from our
                        institution the way you usually do.</p>
        <h2>Who can answer my questions about the study?</h2>
        <p style="color: #7e7e7e;">You can talk to the researcher(s) about any questions, concerns, or complaints you have about this study.</p>
EOD;
        $studyContent->setStudyConsent($strStudyConsent);
        $studyContent
                ->setStudyConsentIntroduction($strStudyConsentIntroduction);
        $studyContent->setStudyUrl("sexpro");
        $studyContent->setStudyTagline($strStudyTagline);
        $studyContent->setStudyDescription($strStudyDescription);
        $studyContent->setStudyAbout($strAbout);
        $studyContent->setStudyWhatsInvolved($strWhatsInvolved);
        $studyContent->setStudyRequirements($strRequirements);

        $manager->persist($studyContent);
        $manager->flush();

        $studyContent = new StudyContent();
        $language = $manager
                ->getRepository('CyclogramProofPilotBundle:Language')->find(2);
        $study = $manager->getRepository('CyclogramProofPilotBundle:Study')
                ->find(7);

        $studyContent->setStudy($study);
        $studyContent->setLanguage($language);
        $studyLogo = $this->container->getParameter('study_image_url') . '/' . $study->getStudyId(). '/logo-7-es.png';
        $studyGraphic = $this->container->getParameter('study_image_url') . '/' . $study->getStudyId(). '/graphic-7-es.png';
        $studyContent->setStudyLogo($studyLogo);
        $studyContent->setStudyGraphic($studyGraphic);
        $studyContent
                ->setStudyName("Promoción Estudio de la Salud Sexual (SexPro)");
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
        $strStudyTagline = <<<EOD
          <span>Herramienta en línea para la Promoción de la Salud Sexual/span>
EOD;
        $strStudyDescription = <<<EOD
          <p>SexPro es una parte de un nuevo estudio de las herramientas en línea que pueden ser útiles para mantener a sí mismo en el interior del VIH-negativas y fuera de su relación (s).</p>
          <p><br></p>
          <p>Inscríbase en el estudio para empezar!<br></p>
EOD;
        $strStudyConsentIntroduction = <<<EOD
          <p>El propósito de este estudio es conocer lo que los hombres y transexuales gusta y no les gusta de SexPro y cómo afecta a su comprensión de la protección sexual
                 comportamientos. También vamos a ver si Sex Pro ayuda a los hombres y los transexuales a cambiar sus prácticas de salud sexual, y cómo el uso de esta herramienta afecta el asesoramiento
                 sesiones entre los participantes del estudio y sus consejeros de VIH.</p>
EOD;
        $strStudyConsent = <<<EOD
          <h2>De qué se trata?</h2>
        <p style="color: #7e7e7e;">La participación en este estudio es su elección. Usted puede optar por participar o no participar en el estudio. Si decide participar en este
                         estudio, puede retirarse del estudio en cualquier momento. No importa cuál sea la decisión que tome, no habrá ninguna pena a usted de ninguna manera. Usted todavía puede obtener su atención
                         de nuestra institución la forma en que normalmente do.we le informará acerca de nueva información o cambios en el estudio que pueda afectar su salud o su voluntad
                         para continuar en el estudio.</p>
        <h2>¿Cuáles son mis derechos si participo en este estudio?</h2>
        <p style="color: #7e7e7e;">La participación en este estudio es su elección. Usted puede optar por participar o no participar en el estudio. Si usted decide participar en este estudio,
                         puede dejar el estudio en cualquier momento. No importa cuál sea la decisión que tome, no habrá ninguna pena a usted de ninguna manera. Usted todavía puede recibir la atención de nuestra
                         institución de la forma en que usualmente lo hace.</p>
        <h2>¿Quién puede responder a mis preguntas sobre el estudio?</h2>
        <p style="color: #7e7e7e;">Usted puede hablar con el investigador (s) sobre cualquier pregunta, inquietud o queja que tenga sobre este estudio.</p>
EOD;
        $studyContent->setStudyConsent($strStudyConsent);
        $studyContent
                ->setStudyConsentIntroduction($strStudyConsentIntroduction);
        $studyContent->setStudyUrl("sexpro");
        $studyContent->setStudyTagline($strStudyTagline);
        $studyContent->setStudyDescription($strStudyDescription);
        $studyContent->setStudyAbout($strAbout);
        $studyContent->setStudyWhatsInvolved($strWhatsInvolved);
        $studyContent->setStudyRequirements($strRequirements);

        $manager->persist($studyContent);
        $manager->flush();

    }


}
