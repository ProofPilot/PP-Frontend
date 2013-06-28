<?php

namespace Cyclogram\SexProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity
 */
class Orders
{
    /**
     * @var integer
     *
     * @ORM\Column(name="order_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $orderId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="order_datetime", type="datetime", nullable=true)
     */
    private $orderDatetime;

    /**
     * @var string
     *
     * @ORM\Column(name="order_tracking_number", type="string", length=45, nullable=true)
     */
    private $orderTrackingNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="order_shipped_datetime", type="datetime", nullable=true)
     */
    private $orderShippedDatetime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="order_delivered_datetime", type="datetime", nullable=true)
     */
    private $orderDeliveredDatetime;

    /**
     * @var float
     *
     * @ORM\Column(name="order_shipping_cost", type="float", nullable=true)
     */
    private $orderShippingCost;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="order_fulfilled_datetime", type="datetime", nullable=true)
     */
    private $orderFulfilledDatetime;

    /**
     * @var \Status
     *
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="status_id")
     * })
     */
    private $status;

    /**
     * @var \Courier
     *
     * @ORM\ManyToOne(targetEntity="Courier")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="courier_id", referencedColumnName="courier_id")
     * })
     */
    private $courier;

    /**
     * @var \CourierProduct
     *
     * @ORM\ManyToOne(targetEntity="CourierProduct")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="courier_product_id", referencedColumnName="courier_product_id")
     * })
     */
    private $courierProduct;

    /**
     * @var \Participant
     *
     * @ORM\ManyToOne(targetEntity="Participant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="participant_id", referencedColumnName="participant_id")
     * })
     */
    private $participant;

    /**
     * @var \Study
     *
     * @ORM\ManyToOne(targetEntity="Study")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="study_id", referencedColumnName="study_id")
     * })
     */
    private $study;



    /**
     * Get orderId
     *
     * @return integer 
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Set orderDatetime
     *
     * @param \DateTime $orderDatetime
     * @return Orders
     */
    public function setOrderDatetime($orderDatetime)
    {
        $this->orderDatetime = $orderDatetime;
    
        return $this;
    }

    /**
     * Get orderDatetime
     *
     * @return \DateTime 
     */
    public function getOrderDatetime()
    {
        return $this->orderDatetime;
    }

    /**
     * Set orderTrackingNumber
     *
     * @param string $orderTrackingNumber
     * @return Orders
     */
    public function setOrderTrackingNumber($orderTrackingNumber)
    {
        $this->orderTrackingNumber = $orderTrackingNumber;
    
        return $this;
    }

    /**
     * Get orderTrackingNumber
     *
     * @return string 
     */
    public function getOrderTrackingNumber()
    {
        return $this->orderTrackingNumber;
    }

    /**
     * Set orderShippedDatetime
     *
     * @param \DateTime $orderShippedDatetime
     * @return Orders
     */
    public function setOrderShippedDatetime($orderShippedDatetime)
    {
        $this->orderShippedDatetime = $orderShippedDatetime;
    
        return $this;
    }

    /**
     * Get orderShippedDatetime
     *
     * @return \DateTime 
     */
    public function getOrderShippedDatetime()
    {
        return $this->orderShippedDatetime;
    }

    /**
     * Set orderDeliveredDatetime
     *
     * @param \DateTime $orderDeliveredDatetime
     * @return Orders
     */
    public function setOrderDeliveredDatetime($orderDeliveredDatetime)
    {
        $this->orderDeliveredDatetime = $orderDeliveredDatetime;
    
        return $this;
    }

    /**
     * Get orderDeliveredDatetime
     *
     * @return \DateTime 
     */
    public function getOrderDeliveredDatetime()
    {
        return $this->orderDeliveredDatetime;
    }

    /**
     * Set orderShippingCost
     *
     * @param float $orderShippingCost
     * @return Orders
     */
    public function setOrderShippingCost($orderShippingCost)
    {
        $this->orderShippingCost = $orderShippingCost;
    
        return $this;
    }

    /**
     * Get orderShippingCost
     *
     * @return float 
     */
    public function getOrderShippingCost()
    {
        return $this->orderShippingCost;
    }

    /**
     * Set orderFulfilledDatetime
     *
     * @param \DateTime $orderFulfilledDatetime
     * @return Orders
     */
    public function setOrderFulfilledDatetime($orderFulfilledDatetime)
    {
        $this->orderFulfilledDatetime = $orderFulfilledDatetime;
    
        return $this;
    }

    /**
     * Get orderFulfilledDatetime
     *
     * @return \DateTime 
     */
    public function getOrderFulfilledDatetime()
    {
        return $this->orderFulfilledDatetime;
    }

    /**
     * Set status
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status
     * @return Orders
     */
    public function setStatus(\Cyclogram\Bundle\ProofPilotBundle\Entity\Status $status = null)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Status 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set courier
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Courier $courier
     * @return Orders
     */
    public function setCourier(\Cyclogram\Bundle\ProofPilotBundle\Entity\Courier $courier = null)
    {
        $this->courier = $courier;
    
        return $this;
    }

    /**
     * Get courier
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Courier 
     */
    public function getCourier()
    {
        return $this->courier;
    }

    /**
     * Set courierProduct
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\CourierProduct $courierProduct
     * @return Orders
     */
    public function setCourierProduct(\Cyclogram\Bundle\ProofPilotBundle\Entity\CourierProduct $courierProduct = null)
    {
        $this->courierProduct = $courierProduct;
    
        return $this;
    }

    /**
     * Get courierProduct
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\CourierProduct 
     */
    public function getCourierProduct()
    {
        return $this->courierProduct;
    }

    /**
     * Set participant
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participant
     * @return Orders
     */
    public function setParticipant(\Cyclogram\Bundle\ProofPilotBundle\Entity\Participant $participant = null)
    {
        $this->participant = $participant;
    
        return $this;
    }

    /**
     * Get participant
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Participant 
     */
    public function getParticipant()
    {
        return $this->participant;
    }

    /**
     * Set study
     *
     * @param \Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study
     * @return Orders
     */
    public function setStudy(\Cyclogram\Bundle\ProofPilotBundle\Entity\Study $study = null)
    {
        $this->study = $study;
    
        return $this;
    }

    /**
     * Get study
     *
     * @return \Cyclogram\Bundle\ProofPilotBundle\Entity\Study 
     */
    public function getStudy()
    {
        return $this->study;
    }
}