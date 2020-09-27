<?php


namespace floor12\DalliApi;


use floor12\DalliApi\Models\Item;

class OrderStatusDispatcher
{
    /** @var Item[] */
    protected $items = [];
    /** @var string */
    private $xmlBody;
    /** @var int|null */
    private $statusTimestamp;
    /** @var string|null */
    private $statusName;
    /** @var string|null */
    private $statusId;

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
        $pattern = '/<status eventtime="(.+)" createtimegmt="(.+)" title="(.+)">([A-Z]*)<\/status>(<d|<statushis)/';
        if (preg_match($pattern, $this->xmlBody, $matches)) {
            $this->statusId = $matches[4];
            $this->statusName = $matches[3];
            $this->statusTimestamp = strtotime($matches[1]);
        }
    }

    private function dispatchItemStatus()
    {
        $pattern = '#<item.*?barcode="(.*?)".*?returns="(.*?)"#';
        if (preg_match_all($pattern, $this->xmlBody, $matches)) {
            $itemsCount = sizeof($matches[0]);
            for ($i = 0; $i < $itemsCount; $i++) {
                $barcode = $matches[1][$i];
                if (empty($barcode))
                    continue;
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
        if (isset($this->items[$barcode]))
            return $this->items[$barcode]->isReturned();
        return null;
    }

    public function getStatusId(): ?string
    {
        return $this->statusId;
    }

    public function getStatusName(): ?string
    {
        return $this->statusName;
    }

    public function getStatusTimestamp(): ?int
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
