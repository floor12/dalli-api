<?php


namespace floor12\DalliApi\Models;


class Order extends XmlObject
{
    /** @var int */
    protected $orderno;
    /** @var Receiver */
    protected $receiver;
    /** @var int */
    protected $service;
    /** @var float */
    protected $weight;
    /** @var int */
    protected $quantity;
    /** @var string */
    protected $paytype;
    /** @var float */
    protected $price;
    /** @var float */
    protected $priced;
    /** @var float */
    protected $inshprice;
    /** @var string */
    protected $upsnak;
    /** @var string */
    protected $instruction;
    /** @var array */
    protected $deliveryset = [];
    /** @var array */
    protected $items = [];

    /**
     * @return mixed
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

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
     * @return int
     */
    public function getService(): int
    {
        return $this->service;
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
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
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
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
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
     * @return string
     */
    public function getPaytype(): string
    {
        return $this->paytype;
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
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
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
     * @return float
     */
    public function getPriced(): float
    {
        return $this->priced;
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
     * @return float
     */
    public function getInshprice(): float
    {
        return $this->inshprice;
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
     * @return string
     */
    public function getUpsnak(): string
    {
        return $this->upsnak;
    }

    /**
     * @param string $upsnak
     * @return Order
     * @return Order
     */
    public function setUpsnak(string $upsnak)
    {
        $this->upsnak = $upsnak;
        return $this;
    }

    /**
     * @return string
     */
    public function getInstruction(): string
    {
        return $this->instruction;
    }

    /**
     * @param string $instruction
     * @return Order
     * @return Order
     */
    public function setInstruction(string $instruction)
    {
        $this->instruction = $instruction;
        return $this;
    }

    /**
     * @return array
     */
    public function getDeliveryset(): array
    {
        return $this->deliveryset;
    }

    /**
     * @param array $deliveryset
     * @return Order
     * @return Order
     */
    public function setDeliveryset(array $deliveryset)
    {
        $this->deliveryset = $deliveryset;
        return $this;
    }

    /**
     * @param Below $below
     * @return Order
     */
    public function addDeliveryset(Below $below)
    {
        $this->deliveryset[] = $below;
        return $this;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param Item[] $items
     * @return Order
     * @return Order
     */
    public function setItems(array $items)
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @param Item $item
     * @return Order
     * @return Order
     */
    public function addItem(Item $item)
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * @return int
     */
    public function getOrderno(): int
    {
        return $this->orderno;
    }

    /**
     * @param int $orderno
     * @return Order
     * @return Order
     */
    public function setOrderno(int $orderno): self
    {
        $this->orderno = $orderno;
        return $this;
    }

}
