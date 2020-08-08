<?php


namespace floor12\DalliApi\Models;


class Order extends BaseXmlObject
{
    /** @var int */
    public $_number;
    /** @var Receiver */
    public $receiver;
    /** @var int */
    public $service;
    /** @var float */
    public $weight;
    /** @var int */
    public $quantity;
    /** @var string */
    public $paytype;
    /** @var float */
    public $price;
    /** @var float */
    public $priced;
    /** @var float */
    public $inshprice;
    /** @var string */
    public $upsnak;
    /** @var string */
    public $instruction;
    /** @var array */
    public $deliveryset = [];
    /** @var array */
    public $items = [];

    /**
     * @param mixed $receiver
     * @return Order
     * @return Order
     */
    public function setReceiver(Receiver $receiver)
    {
        $this->receiver = $receiver;
        return $this;
    }

    /**
     * @param int $service
     * @return Order
     * @return Order
     */
    public function setService(int $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * @param float $weight
     * @return Order
     * @return Order
     */
    public function setWeight(float $weight)
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @param int $quantity
     * @return Order
     * @return Order
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @param string $paytype
     * @return Order
     * @return Order
     */
    public function setPaytype(string $paytype)
    {
        $this->paytype = $paytype;
        return $this;
    }

    /**
     * @param float $price
     * @return Order
     * @return Order
     */
    public function setPrice(float $price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @param float $priced
     * @return Order
     * @return Order
     */
    public function setPriced(float $priced)
    {
        $this->priced = $priced;
        return $this;
    }

    /**
     * @param float $inshprice
     * @return Order
     * @return Order
     */
    public function setInshprice(float $inshprice)
    {
        $this->inshprice = $inshprice;
        return $this;
    }

    /**
     * @param string $upsnak
     * @return Order
     * @return Order
     */
    public function setUpsnak(string $upsnak): self
    {
        $this->upsnak = $upsnak;
        return $this;
    }

    /**
     * @param string $instruction
     * @return Order
     * @return Order
     */
    public function setInstruction(string $instruction): self
    {
        $this->instruction = $instruction;
        return $this;
    }

    /**
     * @param array $deliveryset
     * @return Order
     * @return Order
     */
    public function setDeliveryset(array $deliveryset): self
    {
        $this->deliveryset = $deliveryset;
        return $this;
    }

    /**
     * @param Below $below
     * @return Order
     */
    public function addDeliveryset(Below $below): self
    {
        $this->deliveryset[] = $below;
        return $this;
    }

    /**
     * @param Item[] $items
     * @return Order
     * @return Order
     */
    public function setItems(array $items): self
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @param Item $item
     * @return Order
     * @return Order
     */
    public function addItem(Item $item): self
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * @param int $_number
     * @return Order
     * @return Order
     */
    public function setNumber(int $_number): self
    {
        $this->_number = $_number;
        return $this;
    }

}
