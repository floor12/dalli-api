<?php

namespace floor12\DalliApi\Models\Response;

class DalliOrderStatusEvent
{
    /**
     * @var string
     */
    private $statusId;
    /**
     * @var string
     */
    protected $eventStore;
    /**
     * @var int
     */
    private $timestamp;

    public function __construct(
        string $statusId,
        string $eventStore,
        int    $timestamp,
    )
{
    $this->statusId = $statusId;
    $this->eventStore = $eventStore;
    $this->timestamp = $timestamp;
}


    public function getStatusId(): string
    {
        return $this->statusId;
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function getEventStore(): string
    {
        return $this->eventStore;
    }
}