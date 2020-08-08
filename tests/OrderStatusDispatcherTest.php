<?php

namespace floor12\DalliApi\Tests;

use floor12\DalliApi\Enum\DalliOrderStatus;
use floor12\DalliApi\OrderStatusDispatcher;
use PHPUnit\Framework\TestCase;

class OrderStatusDispatcherTest extends TestCase
{

    public function testDispatchOrderStatus()
    {
        $xmlBody = file_get_contents(__DIR__ . '/_data/orderStatusBody.xml');
        $dispatcher = new OrderStatusDispatcher($xmlBody);
        $this->assertEquals(DalliOrderStatus::DEPARTURE, $dispatcher->getStatusId());
        $this->assertEquals(DalliOrderStatus::getLabel(DalliOrderStatus::DEPARTURE), $dispatcher->getStatusName());
        $this->assertEquals(strtotime('2017-10-25 13:51:28'), $dispatcher->getStatusTimestamp());
    }

    public function testDispatchItemStatus()
    {
        $xmlBody = file_get_contents(__DIR__ . '/_data/orderStatusBody.xml');
        $dispatcher = new OrderStatusDispatcher($xmlBody);
        $items = $dispatcher->getItems();
        $this->assertEquals(3, sizeof($items));
        $this->assertFalse($items['123']->isReturned());
        $this->assertFalse($items['323']->isReturned());
        $this->assertTrue($items['4234231']->isReturned());
        $this->assertFalse($dispatcher->isItemReturned('123'));
        $this->assertFalse($dispatcher->isItemReturned('323'));
        $this->assertTrue($dispatcher->isItemReturned('4234231'));
        $this->assertNull($dispatcher->isItemReturned('asdsas'));
    }
}
