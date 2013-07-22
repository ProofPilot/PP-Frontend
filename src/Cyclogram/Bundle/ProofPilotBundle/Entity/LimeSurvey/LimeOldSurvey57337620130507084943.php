<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeOldSurvey57337620130507084943
 *
 * @ORM\Table(name="lime_old_survey_573376_20130507084943")
 * @ORM\Entity
 */
class LimeOldSurvey57337620130507084943
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=36, nullable=true)
     */
    private $token;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="submitdate", type="datetime", nullable=true)
     */
    private $submitdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="lastpage", type="integer", nullable=true)
     */
    private $lastpage;

    /**
     * @var string
     *
     * @ORM\Column(name="startlanguage", type="string", length=20, nullable=false)
     */
    private $startlanguage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startdate", type="datetime", nullable=false)
     */
    private $startdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datestamp", type="datetime", nullable=false)
     */
    private $datestamp;

    /**
     * @var string
     *
     * @ORM\Column(name="ipaddr", type="text", nullable=true)
     */
    private $ipaddr;

    /**
     * @var string
     *
     * @ORM\Column(name="refurl", type="text", nullable=true)
     */
    private $refurl;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1004", type="string", length=5, nullable=true)
     */
    private $573376x77x1004;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1004other", type="text", nullable=true)
     */
    private $573376x77x1004other;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1003", type="string", length=5, nullable=true)
     */
    private $573376x77x1003;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1003other", type="text", nullable=true)
     */
    private $573376x77x1003other;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1009", type="string", length=5, nullable=true)
     */
    private $573376x77x1009;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1010", type="string", length=5, nullable=true)
     */
    private $573376x77x1010;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="573376X77X1002", type="datetime", nullable=true)
     */
    private $573376x77x1002;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1005SQ001", type="string", length=5, nullable=true)
     */
    private $573376x77x1005sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1005SQ002", type="string", length=5, nullable=true)
     */
    private $573376x77x1005sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1005SQ003", type="string", length=5, nullable=true)
     */
    private $573376x77x1005sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1005SQ004", type="string", length=5, nullable=true)
     */
    private $573376x77x1005sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1006SQ001", type="string", length=5, nullable=true)
     */
    private $573376x77x1006sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1006SQ004", type="string", length=5, nullable=true)
     */
    private $573376x77x1006sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1006SQ002", type="string", length=5, nullable=true)
     */
    private $573376x77x1006sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1006SQ003", type="string", length=5, nullable=true)
     */
    private $573376x77x1006sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1007SQ001", type="string", length=5, nullable=true)
     */
    private $573376x77x1007sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1007SQ002", type="string", length=5, nullable=true)
     */
    private $573376x77x1007sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1007SQ003", type="string", length=5, nullable=true)
     */
    private $573376x77x1007sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1007SQ004", type="string", length=5, nullable=true)
     */
    private $573376x77x1007sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1007SQ005", type="string", length=5, nullable=true)
     */
    private $573376x77x1007sq005;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1007SQ006", type="string", length=5, nullable=true)
     */
    private $573376x77x1007sq006;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1007SQ007", type="string", length=5, nullable=true)
     */
    private $573376x77x1007sq007;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1008", type="string", length=5, nullable=true)
     */
    private $573376x77x1008;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1011SQ001_SQ001", type="text", nullable=true)
     */
    private $573376x77x1011sq001Sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1011SQ001_SQ002", type="text", nullable=true)
     */
    private $573376x77x1011sq001Sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1011SQ001_SQ003", type="text", nullable=true)
     */
    private $573376x77x1011sq001Sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1011SQ001_SQ004", type="text", nullable=true)
     */
    private $573376x77x1011sq001Sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1011SQ001_SQ005", type="text", nullable=true)
     */
    private $573376x77x1011sq001Sq005;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1011SQ002_SQ001", type="text", nullable=true)
     */
    private $573376x77x1011sq002Sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1011SQ002_SQ002", type="text", nullable=true)
     */
    private $573376x77x1011sq002Sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1011SQ002_SQ003", type="text", nullable=true)
     */
    private $573376x77x1011sq002Sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1011SQ002_SQ004", type="text", nullable=true)
     */
    private $573376x77x1011sq002Sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1011SQ002_SQ005", type="text", nullable=true)
     */
    private $573376x77x1011sq002Sq005;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1011SQ003_SQ001", type="text", nullable=true)
     */
    private $573376x77x1011sq003Sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1011SQ003_SQ002", type="text", nullable=true)
     */
    private $573376x77x1011sq003Sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1011SQ003_SQ003", type="text", nullable=true)
     */
    private $573376x77x1011sq003Sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1011SQ003_SQ004", type="text", nullable=true)
     */
    private $573376x77x1011sq003Sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1011SQ003_SQ005", type="text", nullable=true)
     */
    private $573376x77x1011sq003Sq005;


}
