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
        $this->assertEquals(DalliOrderStatus::COMPLETE, $dispatcher->getStatusId());
        $this->assertEquals(DalliOrderStatus::getLabel(DalliOrderStatus::COMPLETE), $dispatcher->getStatusName());
        $this->assertEquals(strtotime('2020-09-16 16:46:00'), $dispatcher->getStatusTimestamp());
        $this->assertEquals('Заявка отменена', $dispatcher->getDeliveredTo());
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
