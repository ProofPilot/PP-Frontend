<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeOldSurvey15729420130626190405
 *
 * @ORM\Table(name="lime_old_survey_157294_20130626190405")
 * @ORM\Entity
 */
class LimeOldSurvey15729420130626190405
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
     * @var float
     *
     * @ORM\Column(name="157294X134X1787", type="decimal", nullable=true)
     */
    private $157294x134x1787;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="157294X134X1776", type="datetime", nullable=true)
     */
    private $157294x134x1776;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17791", type="string", length=5, nullable=true)
     */
    private $157294x134x17791;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17792", type="string", length=5, nullable=true)
     */
    private $157294x134x17792;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17793", type="string", length=5, nullable=true)
     */
    private $157294x134x17793;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17794", type="string", length=5, nullable=true)
     */
    private $157294x134x17794;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17801", type="string", length=5, nullable=true)
     */
    private $157294x134x17801;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17802", type="string", length=5, nullable=true)
     */
    private $157294x134x17802;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17803", type="string", length=5, nullable=true)
     */
    private $157294x134x17803;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17804", type="string", length=5, nullable=true)
     */
    private $157294x134x17804;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17805", type="string", length=5, nullable=true)
     */
    private $157294x134x17805;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17806", type="string", length=5, nullable=true)
     */
    private $157294x134x17806;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17807", type="string", length=5, nullable=true)
     */
    private $157294x134x17807;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X1781", type="string", length=5, nullable=true)
     */
    private $157294x134x1781;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X1777", type="string", length=5, nullable=true)
     */
    private $157294x134x1777;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X1777other", type="text", nullable=true)
     */
    private $157294x134x1777other;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X1782", type="string", length=5, nullable=true)
     */
    private $157294x134x1782;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X1783", type="string", length=5, nullable=true)
     */
    private $157294x134x1783;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17781", type="string", length=5, nullable=true)
     */
    private $157294x134x17781;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17782", type="string", length=5, nullable=true)
     */
    private $157294x134x17782;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17783", type="string", length=5, nullable=true)
     */
    private $157294x134x17783;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17784", type="string", length=5, nullable=true)
     */
    private $157294x134x17784;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17841", type="string", length=5, nullable=true)
     */
    private $157294x134x17841;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17842", type="string", length=5, nullable=true)
     */
    private $157294x134x17842;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17843", type="string", length=5, nullable=true)
     */
    private $157294x134x17843;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17844", type="string", length=5, nullable=true)
     */
    private $157294x134x17844;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17845", type="string", length=5, nullable=true)
     */
    private $157294x134x17845;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17851", type="string", length=5, nullable=true)
     */
    private $157294x134x17851;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17852", type="string", length=5, nullable=true)
     */
    private $157294x134x17852;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17853", type="string", length=5, nullable=true)
     */
    private $157294x134x17853;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17854", type="string", length=5, nullable=true)
     */
    private $157294x134x17854;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17855", type="string", length=5, nullable=true)
     */
    private $157294x134x17855;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17861", type="string", length=5, nullable=true)
     */
    private $157294x134x17861;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17862", type="string", length=5, nullable=true)
     */
    private $157294x134x17862;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17863", type="string", length=5, nullable=true)
     */
    private $157294x134x17863;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17864", type="string", length=5, nullable=true)
     */
    private $157294x134x17864;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X17865", type="string", length=5, nullable=true)
     */
    private $157294x134x17865;

    /**
     * @var string
     *
     * @ORM\Column(name="157294X134X1788", type="text", nullable=true)
     */
    private $157294x134x1788;


}
