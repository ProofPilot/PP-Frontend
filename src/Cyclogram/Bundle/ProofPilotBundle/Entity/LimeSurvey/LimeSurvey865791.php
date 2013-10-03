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

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;

use Doctrine\ORM\Mapping as ORM;

/**
 * LimeSurvey865791
 *
 * @ORM\Table(name="lime_survey_865791")
 * @ORM\Entity
 */
class LimeSurvey865791
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

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X105X1461", type="string", length=5, nullable=true)
//      */
//     private $865791x105x1461;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X105X1376", type="string", length=5, nullable=true)
//      */
//     private $865791x105x1376;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X105X1425", type="decimal", nullable=true)
//      */
//     private $865791x105x1425;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X105X1426SQ001", type="string", length=5, nullable=true)
//      */
//     private $865791x105x1426sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X105X1426SQ002", type="string", length=5, nullable=true)
//      */
//     private $865791x105x1426sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X105X1426SQ003", type="string", length=5, nullable=true)
//      */
//     private $865791x105x1426sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X105X1426SQ004", type="string", length=5, nullable=true)
//      */
//     private $865791x105x1426sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X105X1426SQ005", type="string", length=5, nullable=true)
//      */
//     private $865791x105x1426sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X105X1426other", type="text", nullable=true)
//      */
//     private $865791x105x1426other;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X105X1377", type="string", length=5, nullable=true)
//      */
//     private $865791x105x1377;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X105X1742", type="string", length=5, nullable=true)
//      */
//     private $865791x105x1742;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X105X1743", type="string", length=5, nullable=true)
//      */
//     private $865791x105x1743;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X105X1378", type="decimal", nullable=true)
//      */
//     private $865791x105x1378;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X105X13791", type="string", length=5, nullable=true)
//      */
//     private $865791x105x13791;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X105X13792", type="string", length=5, nullable=true)
//      */
//     private $865791x105x13792;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X105X13793", type="string", length=5, nullable=true)
//      */
//     private $865791x105x13793;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X105X13794", type="string", length=5, nullable=true)
//      */
//     private $865791x105x13794;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X105X13795", type="string", length=5, nullable=true)
//      */
//     private $865791x105x13795;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X105X13797", type="string", length=5, nullable=true)
//      */
//     private $865791x105x13797;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X105X13799", type="string", length=5, nullable=true)
//      */
//     private $865791x105x13799;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X105X13798", type="string", length=5, nullable=true)
//      */
//     private $865791x105x13798;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X105X1379other", type="text", nullable=true)
//      */
//     private $865791x105x1379other;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X105X1744", type="string", length=5, nullable=true)
//      */
//     private $865791x105x1744;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X105X1744other", type="text", nullable=true)
//      */
//     private $865791x105x1744other;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X105X1745", type="string", length=5, nullable=true)
//      */
//     private $865791x105x1745;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X105X1745other", type="text", nullable=true)
//      */
//     private $865791x105x1745other;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X106X1380SQ001", type="string", length=5, nullable=true)
//      */
//     private $865791x106x1380sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X106X1380SQ002", type="string", length=5, nullable=true)
//      */
//     private $865791x106x1380sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X106X1380SQ003", type="string", length=5, nullable=true)
//      */
//     private $865791x106x1380sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X106X1380SQ004", type="string", length=5, nullable=true)
//      */
//     private $865791x106x1380sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X106X1380SQ005", type="string", length=5, nullable=true)
//      */
//     private $865791x106x1380sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X106X1380other", type="text", nullable=true)
//      */
//     private $865791x106x1380other;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X106X1427", type="string", length=5, nullable=true)
//      */
//     private $865791x106x1427;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X106X1381", type="string", length=5, nullable=true)
//      */
//     private $865791x106x1381;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X106X1381other", type="text", nullable=true)
//      */
//     private $865791x106x1381other;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X106X1382SQ001", type="string", length=5, nullable=true)
//      */
//     private $865791x106x1382sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X106X1382SQ002", type="string", length=5, nullable=true)
//      */
//     private $865791x106x1382sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X106X1382SQ003", type="string", length=5, nullable=true)
//      */
//     private $865791x106x1382sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X106X1382SQ004", type="string", length=5, nullable=true)
//      */
//     private $865791x106x1382sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X107X1383", type="string", length=5, nullable=true)
//      */
//     private $865791x107x1383;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X107X1384", type="string", length=5, nullable=true)
//      */
//     private $865791x107x1384;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X107X1385", type="string", length=5, nullable=true)
//      */
//     private $865791x107x1385;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X107X1386", type="string", length=5, nullable=true)
//      */
//     private $865791x107x1386;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X107X1386other", type="text", nullable=true)
//      */
//     private $865791x107x1386other;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X107X1747", type="string", length=5, nullable=true)
//      */
//     private $865791x107x1747;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X107X1747other", type="text", nullable=true)
//      */
//     private $865791x107x1747other;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X107X1748", type="string", length=5, nullable=true)
//      */
//     private $865791x107x1748;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X107X1748other", type="text", nullable=true)
//      */
//     private $865791x107x1748other;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X107X1387", type="string", length=5, nullable=true)
//      */
//     private $865791x107x1387;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X107X1388", type="string", length=5, nullable=true)
//      */
//     private $865791x107x1388;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X107X1428SQ001", type="string", length=5, nullable=true)
//      */
//     private $865791x107x1428sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X107X1428SQ002", type="string", length=5, nullable=true)
//      */
//     private $865791x107x1428sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X107X1428SQ003", type="string", length=5, nullable=true)
//      */
//     private $865791x107x1428sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X107X1428SQ004", type="string", length=5, nullable=true)
//      */
//     private $865791x107x1428sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X107X1428other", type="text", nullable=true)
//      */
//     private $865791x107x1428other;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X108X1389", type="string", length=5, nullable=true)
//      */
//     private $865791x108x1389;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X108X1390", type="string", length=5, nullable=true)
//      */
//     private $865791x108x1390;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X108X1391", type="string", length=5, nullable=true)
//      */
//     private $865791x108x1391;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X108X1392", type="string", length=5, nullable=true)
//      */
//     private $865791x108x1392;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X108X1429", type="string", length=5, nullable=true)
//      */
//     private $865791x108x1429;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X108X1430SQ001", type="string", length=5, nullable=true)
//      */
//     private $865791x108x1430sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X108X1430SQ002", type="string", length=5, nullable=true)
//      */
//     private $865791x108x1430sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X108X1430SQ003", type="string", length=5, nullable=true)
//      */
//     private $865791x108x1430sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X108X1430SQ004", type="string", length=5, nullable=true)
//      */
//     private $865791x108x1430sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X108X1430SQ005", type="string", length=5, nullable=true)
//      */
//     private $865791x108x1430sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X108X1430SQ006", type="string", length=5, nullable=true)
//      */
//     private $865791x108x1430sq006;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X108X1430SQ007", type="string", length=5, nullable=true)
//      */
//     private $865791x108x1430sq007;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X108X1430SQ008", type="string", length=5, nullable=true)
//      */
//     private $865791x108x1430sq008;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X108X1430SQ009", type="string", length=5, nullable=true)
//      */
//     private $865791x108x1430sq009;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X108X1430SQ010", type="string", length=5, nullable=true)
//      */
//     private $865791x108x1430sq010;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X108X1430SQ011", type="string", length=5, nullable=true)
//      */
//     private $865791x108x1430sq011;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X108X1430other", type="text", nullable=true)
//      */
//     private $865791x108x1430other;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X109X1393", type="decimal", nullable=true)
//      */
//     private $865791x109x1393;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X109X1394", type="decimal", nullable=true)
//      */
//     private $865791x109x1394;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X109X1456", type="string", length=5, nullable=true)
//      */
//     private $865791x109x1456;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X109X1457", type="decimal", nullable=true)
//      */
//     private $865791x109x1457;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X109X1458", type="string", length=5, nullable=true)
//      */
//     private $865791x109x1458;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X109X13951", type="string", length=5, nullable=true)
//      */
//     private $865791x109x13951;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X109X13951comment", type="text", nullable=true)
//      */
//     private $865791x109x13951comment;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X109X13952", type="string", length=5, nullable=true)
//      */
//     private $865791x109x13952;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X109X13952comment", type="text", nullable=true)
//      */
//     private $865791x109x13952comment;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X109X13953", type="string", length=5, nullable=true)
//      */
//     private $865791x109x13953;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X109X13953comment", type="text", nullable=true)
//      */
//     private $865791x109x13953comment;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X109X1396SQ001", type="float", nullable=true)
//      */
//     private $865791x109x1396sq001;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X109X1396SQ002", type="float", nullable=true)
//      */
//     private $865791x109x1396sq002;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X109X1397SQ001", type="float", nullable=true)
//      */
//     private $865791x109x1397sq001;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X109X1397SQ002", type="float", nullable=true)
//      */
//     private $865791x109x1397sq002;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X109X1398SQ001", type="float", nullable=true)
//      */
//     private $865791x109x1398sq001;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X109X1398SQ002", type="float", nullable=true)
//      */
//     private $865791x109x1398sq002;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X109X1399SQ001", type="float", nullable=true)
//      */
//     private $865791x109x1399sq001;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X109X1399SQ002", type="float", nullable=true)
//      */
//     private $865791x109x1399sq002;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X109X1459SQ001", type="float", nullable=true)
//      */
//     private $865791x109x1459sq001;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X109X1459SQ002", type="float", nullable=true)
//      */
//     private $865791x109x1459sq002;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X109X1460SQ001", type="float", nullable=true)
//      */
//     private $865791x109x1460sq001;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X109X1460SQ002", type="float", nullable=true)
//      */
//     private $865791x109x1460sq002;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1400", type="decimal", nullable=true)
//      */
//     private $865791x110x1400;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X110X14011", type="string", length=5, nullable=true)
//      */
//     private $865791x110x14011;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X110X14011comment", type="text", nullable=true)
//      */
//     private $865791x110x14011comment;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X110X14012", type="string", length=5, nullable=true)
//      */
//     private $865791x110x14012;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X110X14012comment", type="text", nullable=true)
//      */
//     private $865791x110x14012comment;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X110X14013", type="string", length=5, nullable=true)
//      */
//     private $865791x110x14013;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X110X14013comment", type="text", nullable=true)
//      */
//     private $865791x110x14013comment;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1580SQ001", type="float", nullable=true)
//      */
//     private $865791x110x1580sq001;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1580SQ002", type="float", nullable=true)
//      */
//     private $865791x110x1580sq002;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1583SQ001", type="float", nullable=true)
//      */
//     private $865791x110x1583sq001;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1583SQ002", type="float", nullable=true)
//      */
//     private $865791x110x1583sq002;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1586SQ001", type="float", nullable=true)
//      */
//     private $865791x110x1586sq001;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1586SQ002", type="float", nullable=true)
//      */
//     private $865791x110x1586sq002;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1589SQ001", type="float", nullable=true)
//      */
//     private $865791x110x1589sq001;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1589SQ002", type="float", nullable=true)
//      */
//     private $865791x110x1589sq002;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1592SQ001", type="float", nullable=true)
//      */
//     private $865791x110x1592sq001;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1592SQ002", type="float", nullable=true)
//      */
//     private $865791x110x1592sq002;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1598SQ001", type="float", nullable=true)
//      */
//     private $865791x110x1598sq001;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1598SQ002", type="float", nullable=true)
//      */
//     private $865791x110x1598sq002;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1402", type="decimal", nullable=true)
//      */
//     private $865791x110x1402;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1403", type="decimal", nullable=true)
//      */
//     private $865791x110x1403;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1404", type="decimal", nullable=true)
//      */
//     private $865791x110x1404;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1405", type="decimal", nullable=true)
//      */
//     private $865791x110x1405;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1406", type="decimal", nullable=true)
//      */
//     private $865791x110x1406;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1407", type="decimal", nullable=true)
//      */
//     private $865791x110x1407;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1408", type="decimal", nullable=true)
//      */
//     private $865791x110x1408;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1409", type="decimal", nullable=true)
//      */
//     private $865791x110x1409;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1410", type="decimal", nullable=true)
//      */
//     private $865791x110x1410;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1411", type="decimal", nullable=true)
//      */
//     private $865791x110x1411;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1412", type="decimal", nullable=true)
//      */
//     private $865791x110x1412;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1413", type="decimal", nullable=true)
//      */
//     private $865791x110x1413;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1414", type="decimal", nullable=true)
//      */
//     private $865791x110x1414;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1415", type="decimal", nullable=true)
//      */
//     private $865791x110x1415;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1416", type="decimal", nullable=true)
//      */
//     private $865791x110x1416;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1417", type="decimal", nullable=true)
//      */
//     private $865791x110x1417;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1418", type="decimal", nullable=true)
//      */
//     private $865791x110x1418;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1419", type="decimal", nullable=true)
//      */
//     private $865791x110x1419;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X110X1420", type="decimal", nullable=true)
//      */
//     private $865791x110x1420;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X111X1421", type="decimal", nullable=true)
//      */
//     private $865791x111x1421;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X111X1422", type="decimal", nullable=true)
//      */
//     private $865791x111x1422;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X111X1423", type="decimal", nullable=true)
//      */
//     private $865791x111x1423;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X111X1424", type="decimal", nullable=true)
//      */
//     private $865791x111x1424;

//     /**
//      * @var float
//      *
//      * @ORM\Column(name="865791X112X1431SQ001", type="float", nullable=true)
//      */
//     private $865791x112x1431sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X112X1432", type="string", length=5, nullable=true)
//      */
//     private $865791x112x1432;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X112X1433", type="string", length=5, nullable=true)
//      */
//     private $865791x112x1433;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X112X1434", type="string", length=5, nullable=true)
//      */
//     private $865791x112x1434;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X112X1435", type="string", length=5, nullable=true)
//      */
//     private $865791x112x1435;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X112X1436", type="string", length=5, nullable=true)
//      */
//     private $865791x112x1436;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X112X1437", type="string", length=5, nullable=true)
//      */
//     private $865791x112x1437;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X112X1438", type="string", length=5, nullable=true)
//      */
//     private $865791x112x1438;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X113X1439", type="string", length=5, nullable=true)
//      */
//     private $865791x113x1439;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X113X1440", type="string", length=5, nullable=true)
//      */
//     private $865791x113x1440;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X113X1441SQ001", type="string", length=5, nullable=true)
//      */
//     private $865791x113x1441sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X113X1441SQ002", type="string", length=5, nullable=true)
//      */
//     private $865791x113x1441sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X113X1441SQ003", type="string", length=5, nullable=true)
//      */
//     private $865791x113x1441sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X113X1441SQ004", type="string", length=5, nullable=true)
//      */
//     private $865791x113x1441sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X113X1441SQ005", type="string", length=5, nullable=true)
//      */
//     private $865791x113x1441sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X113X1441SQ006", type="string", length=5, nullable=true)
//      */
//     private $865791x113x1441sq006;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X113X1441SQ007", type="string", length=5, nullable=true)
//      */
//     private $865791x113x1441sq007;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X113X1441SQ008", type="string", length=5, nullable=true)
//      */
//     private $865791x113x1441sq008;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X113X1441SQ009", type="string", length=5, nullable=true)
//      */
//     private $865791x113x1441sq009;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X113X1441SQ010", type="string", length=5, nullable=true)
//      */
//     private $865791x113x1441sq010;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X113X1442SQ001", type="string", length=5, nullable=true)
//      */
//     private $865791x113x1442sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X113X1442SQ002", type="string", length=5, nullable=true)
//      */
//     private $865791x113x1442sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X113X1442SQ003", type="string", length=5, nullable=true)
//      */
//     private $865791x113x1442sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X113X1442SQ004", type="string", length=5, nullable=true)
//      */
//     private $865791x113x1442sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X113X1442SQ005", type="string", length=5, nullable=true)
//      */
//     private $865791x113x1442sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X114X1443", type="string", length=5, nullable=true)
//      */
//     private $865791x114x1443;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X114X1444SQ001", type="string", length=5, nullable=true)
//      */
//     private $865791x114x1444sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X114X1444SQ002", type="string", length=5, nullable=true)
//      */
//     private $865791x114x1444sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X114X1444SQ003", type="string", length=5, nullable=true)
//      */
//     private $865791x114x1444sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X114X1444SQ004", type="string", length=5, nullable=true)
//      */
//     private $865791x114x1444sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X114X1444SQ005", type="string", length=5, nullable=true)
//      */
//     private $865791x114x1444sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X114X1444SQ006", type="string", length=5, nullable=true)
//      */
//     private $865791x114x1444sq006;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X114X1444SQ007", type="string", length=5, nullable=true)
//      */
//     private $865791x114x1444sq007;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X114X1444other", type="text", nullable=true)
//      */
//     private $865791x114x1444other;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X114X1445", type="string", length=5, nullable=true)
//      */
//     private $865791x114x1445;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X114X1446", type="string", length=5, nullable=true)
//      */
//     private $865791x114x1446;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X114X1446other", type="text", nullable=true)
//      */
//     private $865791x114x1446other;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X114X1447", type="string", length=5, nullable=true)
//      */
//     private $865791x114x1447;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X115X1448", type="string", length=5, nullable=true)
//      */
//     private $865791x115x1448;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X115X1449", type="string", length=5, nullable=true)
//      */
//     private $865791x115x1449;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X115X1449other", type="text", nullable=true)
//      */
//     private $865791x115x1449other;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X116X1450", type="string", length=5, nullable=true)
//      */
//     private $865791x116x1450;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X116X1453SQ001", type="string", length=5, nullable=true)
//      */
//     private $865791x116x1453sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X116X1453SQ002", type="string", length=5, nullable=true)
//      */
//     private $865791x116x1453sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X116X1453SQ003", type="string", length=5, nullable=true)
//      */
//     private $865791x116x1453sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X116X1453SQ004", type="string", length=5, nullable=true)
//      */
//     private $865791x116x1453sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X116X1454", type="string", length=5, nullable=true)
//      */
//     private $865791x116x1454;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X116X1455", type="string", length=5, nullable=true)
//      */
//     private $865791x116x1455;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X117X1451SQ001", type="string", length=5, nullable=true)
//      */
//     private $865791x117x1451sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X117X1451SQ002", type="string", length=5, nullable=true)
//      */
//     private $865791x117x1451sq002;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X117X1451SQ003", type="string", length=5, nullable=true)
//      */
//     private $865791x117x1451sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X117X1451SQ004", type="string", length=5, nullable=true)
//      */
//     private $865791x117x1451sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X117X1451SQ005", type="string", length=5, nullable=true)
//      */
//     private $865791x117x1451sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X117X1452SQ001", type="string", length=5, nullable=true)
//      */
//     private $865791x117x1452sq001;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X117X1452SQ003", type="string", length=5, nullable=true)
//      */
//     private $865791x117x1452sq003;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X117X1452SQ004", type="string", length=5, nullable=true)
//      */
//     private $865791x117x1452sq004;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X117X1452SQ005", type="string", length=5, nullable=true)
//      */
//     private $865791x117x1452sq005;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X117X1452SQ006", type="string", length=5, nullable=true)
//      */
//     private $865791x117x1452sq006;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X117X1452SQ007", type="string", length=5, nullable=true)
//      */
//     private $865791x117x1452sq007;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X117X1452SQ008", type="string", length=5, nullable=true)
//      */
//     private $865791x117x1452sq008;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X117X1452SQ009", type="string", length=5, nullable=true)
//      */
//     private $865791x117x1452sq009;

//     /**
//      * @var string
//      *
//      * @ORM\Column(name="865791X117X1452SQ010", type="string", length=5, nullable=true)
//      */
//     private $865791x117x1452sq010;


}
