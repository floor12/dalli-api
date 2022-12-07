<?php


namespace floor12\DalliApi;


use Exception;
use floor12\DalliApi\Enum\DalliOrderStatus;
use floor12\DalliApi\Models\Item;
use floor12\DalliApi\Models\Response\DalliOrderStatusEvent;

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
     * @var \$1|false|\SimpleXMLElement
     */
    private $xml;
    /**
     * @var DalliOrderStatusEvent[]
     */
    private $statuses;

    /**
     * @param string $xmlBody
     * @throws Exception
     */
    public function __construct(string $xmlBody)
    {
        $this->xml = simplexml_load_string($xmlBody);
        if ($this->xml === false)
            throw new Exception('XML body is not valid.');
        if ($this->xml->order) {

            foreach ($this->xml->order->statushistory->status as $statusItem) {
                $this->statuses[] = new DalliOrderStatusEvent(
                    trim($statusItem[0]),
                    $statusItem['eventstore'],
                    strtotime($statusItem['eventtime']));
            }

            foreach ($this->xml->order->items->item as $item) {
                $orderItem = new Item();
                $orderItem->setBarcode((string)$item['barcode'])
                    ->setQuantity((int)$item['quantity'])
                    ->setReturn(boolval($item['returns']))
                    ->setRetprice((float)$item['retprice']);
                $this->items[$orderItem->_barcode] = $orderItem;
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
        if ($this->statuses) {
            return $this->statuses[0]->getStatusId();
        }
        return null;
    }

    public function getStatusName(): ?string
    {
        if ($this->getStatusId())
            DalliOrderStatus::getLabel($this->getStatusId());
        return null;
    }

    public function getStatusTimestamp(): ?int
    {
        if ($this->statuses) {
            return $this->statuses[0]->getTimestamp();
        }
        return null;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return Item[]
     */
    public function getReturnedItems(): array
    {
        $returned = [];
        foreach ($this->items as $item) {
            if ($item->isReturned())
                $returned[] = $item;
        }
        return $returned;
    }

    public function getOrderHistory(): ?array
    {
        return $this->statuses;
    }

    public function getStatuses(): array
    {
        return $this->statuses;
    }

    public function getExternalBarCode()
    {
        return $this->externalBarCode;
    }
}
