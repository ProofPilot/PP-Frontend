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
 * TestFields
 *
 * @ORM\Table(name="test_fields")
 * @ORM\Entity
 */
class TestFields
{
    /**
     * @var integer
     *
     * @ORM\Column(name="field_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $fieldId;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var \TestStory
     *
     * @ORM\ManyToOne(targetEntity="TestStory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="story_id", referencedColumnName="id"),
     *   @ORM\JoinColumn(name="lang_id", referencedColumnName="langid")
     * })
     */
    private $story;



    public function getFieldId()
    {
        return $this->fieldId;
    }

    public function setFieldId($fieldId)
    {
        $this->fieldId = $fieldId;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getStory()
    {
        return $this->story;
    }

    public function setStory($story)
    {
        $this->story = $story;
    }
}