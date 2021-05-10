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
    /** @var string */
    private $paymentType;
    /** @var string */
    private $deliveredTo;
    /** @var string */
    private $externalBarCode;

    /**
     * @param string $xmlBody
     */
    public function __construct(string $xmlBody)
    {
        $this->xmlBody = $xmlBody;
        $this->dispatchOrderStatus();
        $this->dispatchItemStatus();
        $this->dispatchPaymentType();
        $this->dispatchExternalBarCode();
        $this->dispatchDeliveredTo();
    }

    private function dispatchOrderStatus(): void
    {
        $pattern = '/<status eventtime="(.+)" createtimegmt="(.+)" title="(.+)">([A-Z]*)<\/status>[\s]*(<d|<statushis)/';
        if (preg_match($pattern, $this->xmlBody, $matches)) {
            $this->statusId = $matches[4];
            $this->statusName = $matches[3];
            $this->statusTimestamp = strtotime($matches[1]);
        }
    }

    private function dispatchDeliveredTo(): void
    {
        $pattern = '/<deliveredto>(.+)<\/deliveredto>/';
        if (preg_match($pattern, $this->xmlBody, $matches)) {
            $this->deliveredTo = $matches[1];
        }
    }

    private function dispatchPaymentType(): void
    {
        $pattern = '/<paytype>([A-Z]*)<\/paytype>/';
        if (preg_match($pattern, $this->xmlBody, $matches)) {
            $this->paymentType = $matches[1];
        }
    }

    private function dispatchExternalBarCode(): void
    {
        $pattern = '/<outstrbarcode>([A-Z0-9]*)<\/outstrbarcode>/';
        if (preg_match($pattern, $this->xmlBody, $matches)) {
            $this->externalBarCode = $matches[1];
        }
    }

    private function dispatchItemStatus()
    {
        $pattern = '#barcode="(\d+)" returns="(\d+)"#';
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
    public function getReturnedItems(): array
    {
        return $this->items;
    }

    /**
     * @return string
     */
    public function getPaymentType(): string
    {
        return $this->paymentType;
    }

    /**
     * @return string
     */
    public function getDeliveredTo(): ?string
    {
        return $this->deliveredTo;
    }

    /**
     * @return string|null
     */
    public function getExternalBarCode(): ?string
    {
        return $this->externalBarCode;
    }
}
