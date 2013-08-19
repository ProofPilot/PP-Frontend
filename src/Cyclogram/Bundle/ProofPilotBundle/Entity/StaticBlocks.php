<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StaticBlocks
 *
 * @ORM\Table(name="static_blocks")
 * @ORM\Entity(repositoryClass="Cyclogram\Bundle\ProofPilotBundle\Repository\StaticBlocksRepository")
 */
class StaticBlocks
{
    /**
     * @var string
     *
     * @ORM\Column(name="block_name", type="string", length=45, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $blockName;

    /**
     * @var string
     *
     * @ORM\Column(name="block_content", type="text", nullable=true)
     */
    private $blockContent;

    /**
     * @var \Language
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Language")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="language", referencedColumnName="language_id")
     * })
     */
    private $language;



    public function getBlockName()
    {
        return $this->blockName;
    }

    public function setBlockName($blockName)
    {
        $this->blockName = $blockName;
    }

    public function getBlockContent()
    {
        return $this->blockContent;
    }

    public function setBlockContent($blockContent)
    {
        $this->blockContent = $blockContent;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
    }
}
