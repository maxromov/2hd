<?php

namespace api\Entity;

class Order
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $creationDate;

    /**
     * @var string
     */
    protected $deliveryAddress;

    /**
     * @var integer
     */
    protected $sellerId;

    /**
     * @var integer
     */
    protected $courierId;

    /**
     * @var integer
     */
    protected $packageCost;

    /**
     * @var integer
     */
    protected $deliveryCost;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTime $creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }

    public function setDeliveryAddress($deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    public function getSellerId()
    {
        return $this->sellerId;
    }

    public function setSellerId($sellerId)
    {
        $this->sellerId = $sellerId;
    }

    public function getCourierId()
    {
        return $this->courierId;
    }

    public function setCourierId($courierId)
    {
        $this->courierId = $courierId;
    }

    public function getPackageCost()
    {
        return $this->packageCost;
    }

    public function setPackageCost($packageCost)
    {
        $this->packageCost = $packageCost;
    }

    public function getDeliveryCost()
    {
        return $this->deliveryCost;
    }

    public function setDeliveryCost($deliveryCost)
    {
        $this->deliveryCost = $deliveryCost;
    }
}
