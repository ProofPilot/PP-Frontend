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

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TestStory
 *
 * @ORM\Table(name="test_story")
 * @ORM\Entity
 */
class TestStory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="langid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $langid;

    /**
     * @var string
     *
     * @ORM\Column(name="desc", type="string", length=255, nullable=true)
     */
    private $desc;



    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getLangid()
    {
        return $this->langid;
    }

    public function setLangid($langid)
    {
        $this->langid = $langid;
    }

    public function getDesc()
    {
        return $this->desc;
    }

    public function setDesc($desc)
    {
        $this->desc = $desc;
    }
}