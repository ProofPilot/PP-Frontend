<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeOldSurvey57337620130508121658
 *
 * @ORM\Table(name="lime_old_survey_573376_20130508121658")
 * @ORM\Entity
 */
class LimeOldSurvey57337620130508121658
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
     * @ORM\Column(name="573376X77X1011SQ001", type="string", length=5, nullable=true)
     */
    private $573376x77x1011sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1011SQ002", type="string", length=5, nullable=true)
     */
    private $573376x77x1011sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1011SQ003", type="string", length=5, nullable=true)
     */
    private $573376x77x1011sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1011SQ004", type="string", length=5, nullable=true)
     */
    private $573376x77x1011sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1011SQ005", type="string", length=5, nullable=true)
     */
    private $573376x77x1011sq005;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1603SQ001", type="string", length=5, nullable=true)
     */
    private $573376x77x1603sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1603SQ002", type="string", length=5, nullable=true)
     */
    private $573376x77x1603sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1603SQ003", type="string", length=5, nullable=true)
     */
    private $573376x77x1603sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1603SQ004", type="string", length=5, nullable=true)
     */
    private $573376x77x1603sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1603SQ005", type="string", length=5, nullable=true)
     */
    private $573376x77x1603sq005;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1609SQ001", type="string", length=5, nullable=true)
     */
    private $573376x77x1609sq001;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1609SQ002", type="string", length=5, nullable=true)
     */
    private $573376x77x1609sq002;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1609SQ003", type="string", length=5, nullable=true)
     */
    private $573376x77x1609sq003;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1609SQ004", type="string", length=5, nullable=true)
     */
    private $573376x77x1609sq004;

    /**
     * @var string
     *
     * @ORM\Column(name="573376X77X1609SQ005", type="string", length=5, nullable=true)
     */
    private $573376x77x1609sq005;


}
