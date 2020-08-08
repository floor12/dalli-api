<?php


namespace floor12\DalliApi;


use floor12\DalliApi\Models\Item;

class OrderStatusDispatcher
{
    /** @var string */
    private $xmlBody;
    /** @var int */
    private $statusTimestamp;
    /** @var string */
    private $statusName;
    /** @var string */
    private $statusId;
    /** @var ?Item[] */
    protected $items = [];

    /**
     * @param string $xmlBody
     */
    public function __construct(string $xmlBody)
    {
        $this->xmlBody = $xmlBody;
        $this->dispatchOrderStatus();
        $this->dispatchItemStatus();
    }

    private function dispatchOrderStatus(): void
    {
        $pattern = '/<status eventtime="(.+)" createtimegmt="(.+)" title="(.+)">(.+)<\/status>/';
        if (preg_match($pattern, $this->xmlBody, $matches)) {
            $this->statusId = $matches[4];
            $this->statusName = $matches[3];
            $this->statusTimestamp = strtotime($matches[1]);
        }
    }

    private function dispatchItemStatus()
    {
        $pattern = '/<item.+barcode="(.+)" a.+returns="(\d)"/';
        if (preg_match_all($pattern, $this->xmlBody, $matches)) {
            for ($i = 0; $i < sizeof($matches[0]); $i++) {
                $barcode = $matches[1][$i];
                $return = boolval($matches[2][$i]);
                $this->items[$barcode] = (new Item())
                    ->setBarcode($barcode)
                    ->setReturn($return);
            }
        }
    }

    /**
     * @param string|int $barcode
     * @return bool|null
     */
    public function isItemReturned($barcode): ?bool
    {
        return ($item = $this->items[$barcode]) ? $item->isReturned() : null;
    }

    public function getStatusId(): string
    {
        return $this->statusId;
    }

    public function getStatusName(): string
    {
        return $this->statusName;
    }

    public function getStatusTimestamp(): int
    {
        return $this->statusTimestamp;
    }

    /**
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
