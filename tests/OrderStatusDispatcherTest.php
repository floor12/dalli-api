<?php

namespace floor12\DalliApi\Tests;

use floor12\DalliApi\Enum\DalliOrderStatus;
use floor12\DalliApi\OrderStatusDispatcher;
use PHPUnit\Framework\TestCase;

class OrderStatusDispatcherTest extends TestCase
{
    protected $xmlBody = '<?xml version="1.0" encoding="UTF-8"?>
<statusreq count="1">
	<order orderno="TEST_1000" ordercode="997086" givencode="W772911">
		<receiver>
			<company>Тестовая заявка СПБ</company>
			<person>Тестовая заявка СПБ</person>
			<phone>+79035432346 rufionov@gmail.com</phone>
			<zipcode/>
			<town code="1">Москва город</town>
			<address>Тестовская</address>
			<date>2017-10-26</date>
			<time_min>11:00:00</time_min>
			<time_max>16:00:00</time_max>
		</receiver>
		<weight>0.7</weight>
		<quantity>1</quantity>
		<paytype>NO</paytype>
		<service>11</service>
		<price>0.00</price>
		<inshprice>500.00</inshprice>
		<enclosure/>
		<instruction>ЭТО ТЕСТОВАЯ ЗАЯВКА! ОБРАБОТКА НЕ ТРЕБУЕТСЯ</instruction>
		<deliveryprice total="5.50"/>
		<status eventtime="2017-10-25 13:51:28" createtimegmt="2017-10-25 10:51:28" title="Отправлено со склада">DEPARTURE</status>
		<deliveredto>Заявка отменена</deliveredto>
		<delivereddate/>
		<deliveredtime/>
		<items>
			<item quantity="1" mass="0.10" retprice="0.00" VATrate="0" barcode="123" article="" returns="0"> - Тестовая товарная позиция</item>
			<item quantity="2" mass="0.10" retprice="0.00" VATrate="0" barcode="323" article="" returns="0"> - Тестовая товарная позиция 2</item>
			<item quantity="3" mass="0.10" retprice="0.00" VATrate="0" barcode="4234231" article="" returns="1"> - Тестовая товарная позиция 3</item>
			<item quantity="1" mass="0.10" retprice="0.00" VATrate="0" barcode="" article="" returns="1">Доставка</item>
		</items>
	</order>
</statusreq>';

    public function testDispatchOrderStatus()
    {
        $dispatcher = new OrderStatusDispatcher($this->xmlBody);
        $this->assertEquals(DalliOrderStatus::DEPARTURE, $dispatcher->getStatusId());
        $this->assertEquals(DalliOrderStatus::getLabel(DalliOrderStatus::DEPARTURE), $dispatcher->getStatusName());
        $this->assertEquals(strtotime('2017-10-25 13:51:28'), $dispatcher->getStatusTimestamp());
    }

    public function testDispatchItemStatus()
    {
        $dispatcher = new OrderStatusDispatcher($this->xmlBody);
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
