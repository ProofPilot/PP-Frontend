<?php

namespace Cyclogram\SexProBundle\Entity;

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