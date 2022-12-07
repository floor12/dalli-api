<?php

namespace floor12\DalliApi\Tests;

use floor12\DalliApi\Enum\DalliOrderStatus;
use floor12\DalliApi\OrderStatusDispatcher;
use PHPUnit\Framework\TestCase;

class OrderStatusDispatcherTest extends TestCase
{

    public function testStatusHistory()
    {
        $xmlBody = file_get_contents(__DIR__ . '/_data/orderStatusBody.xml');
        $dispatcher = new OrderStatusDispatcher($xmlBody);
        $history = $dispatcher->getOrderHistory();
        $this->assertTrue(is_array($history));
        $this->assertTrue(count($history) === 5);
        $this->assertEquals($history[0]->getStatusId(), DalliOrderStatus::COMPLETE);
        $this->assertEquals($history[1]->getStatusId(), DalliOrderStatus::DEPARTURE);
        $this->assertEquals($history[2]->getStatusId(), DalliOrderStatus::DEPARTURING);
        $this->assertEquals($history[3]->getStatusId(), DalliOrderStatus::ACCEPTED);
        $this->assertEquals($history[4]->getStatusId(), DalliOrderStatus::NEW);

    }

    public function testDispatchItemStatus()
    {
        $xmlBody = file_get_contents(__DIR__ . '/_data/orderStatusBody.xml');
        $dispatcher = new OrderStatusDispatcher($xmlBody);
        $items = $dispatcher->getItems();
        $this->assertEquals(3, sizeof($items));
        $this->assertEquals(1, sizeof($dispatcher->getReturnedItems()));
    }
}
