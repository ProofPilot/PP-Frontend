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
