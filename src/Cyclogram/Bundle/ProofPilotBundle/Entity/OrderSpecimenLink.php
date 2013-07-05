<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderSpecimenLink
 *
 * @ORM\Table(name="order_specimen_link")
 * @ORM\Entity
 */
class OrderSpecimenLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="order_test_link_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $orderTestLinkId;

    /**
     * @var \Specimen
     *
     * @ORM\ManyToOne(targetEntity="Specimen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="specimen_id", referencedColumnName="specimen_id")
     * })
     */
    private $specimen;

    /**
     * @var \Orders
     *
     * @ORM\ManyToOne(targetEntity="Orders")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="order_id", referencedColumnName="order_id")
     * })
     */
    private $order;



    /**
     * Get orderTestLinkId
     *
     * @return integer 
     */
    public function getOrderTestLinkId()
    {
        return $this->orderTestLinkId;
    }

    /**
     * Set specimen
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Specimen $specimen
     * @return OrderSpecimenLink
     */
    public function setSpecimen(\Cyclogram\Bundle\ProofPilotBundle\Entity\Specimen $specimen = null)
    {
        $this->specimen = $specimen;
    
        return $this;
    }

    /**
     * Get specimen
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Specimen 
     */
    public function getSpecimen()
    {
        return $this->specimen;
    }

    /**
     * Set order
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Orders $order
     * @return OrderSpecimenLink
     */
    public function setOrder(\Cyclogram\Bundle\ProofPilotBundle\Entity\Orders $order = null)
    {
        $this->order = $order;
    
        return $this;
    }

    /**
     * Get order
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Orders 
     */
    public function getOrder()
    {
        return $this->order;
    }
}