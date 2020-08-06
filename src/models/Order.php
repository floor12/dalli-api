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
    /** @var int */
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
     */
    public function setReceiver(Receiver $receiver)
    {
        $this->receiver = $receiver;
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
     */
    public function setService(int $service)
    {
        $this->service = $service;
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
     */
    public function setWeight(float $weight)
    {
        $this->weight = $weight;
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
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getPaytype(): int
    {
        return $this->paytype;
    }

    /**
     * @param int $paytype
     */
    public function setPaytype(int $paytype)
    {
        $this->paytype = $paytype;
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
     */
    public function setPrice(float $price)
    {
        $this->price = $price;
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
     */
    public function setPriced(float $priced)
    {
        $this->priced = $priced;
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
     */
    public function setInshprice(float $inshprice)
    {
        $this->inshprice = $inshprice;
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
     */
    public function setUpsnak(string $upsnak)
    {
        $this->upsnak = $upsnak;
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
     */
    public function setInstruction(string $instruction)
    {
        $this->instruction = $instruction;
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
     */
    public function setDeliveryset(array $deliveryset)
    {
        $this->deliveryset = $deliveryset;
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
     */
    public function setItems(array $items)
    {
        $this->items = $items;
    }

    /**
     * @param Item $item
     */
    public function addItem(Item $item)
    {
        $this->items[] = $item;
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
     */
    public function setOrderno(int $orderno)
    {
        $this->orderno = $orderno;
    }

}
