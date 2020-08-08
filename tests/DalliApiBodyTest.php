<?php

namespace floor12\DalliApi\Tests;

use Faker\Factory;
use floor12\DalliApi\Enum\DalliService;
use floor12\DalliApi\Enum\PayType;
use floor12\DalliApi\Exceptions\EmptyApiMethodException;
use floor12\DalliApi\Models\Below;
use floor12\DalliApi\Models\DalliApiBody;
use floor12\DalliApi\Models\Item;
use floor12\DalliApi\Models\Order;
use floor12\DalliApi\Models\Receiver;
use PHPUnit\Framework\TestCase;

class DalliApiBodyTest extends TestCase
{

    public function testEmptyMethod()
    {
        $this->expectException(EmptyApiMethodException::class);
        $this->expectExceptionMessage('Dalli Service API method name is empty.');
        new DalliApiBody(null);
    }

    public function testXmlAllFields()
    {
        $faker = Factory::create('ru_RU');
        $name = $faker->name;
        $address = $faker->streetAddress;
        $intTestValue = rand(1, 10);
        $stringTestValue = $faker->streetAddress;

        $receiver = (new Receiver())
            ->setPerson($name)
            ->setAddress($address);

        $barcode = rand(99999, 9999999);
        $item = new Item();
        $item->setBarcode($barcode);

        $below = (new Below())
            ->setPrice($intTestValue);

        $order = (new Order())->setNumber($intTestValue)
            ->setReceiver($receiver)
            ->setService(DalliService::EXPRESS_PICKUP)
            ->setWeight($intTestValue)
            ->setInstruction($stringTestValue)
            ->setQuantity($intTestValue)
            ->setPaytype(PayType::CARD)
            ->addDeliveryset($below)
            ->addItem($item);

        $testMethodName = 'testMethod1';
        $apiBody = (new DalliApiBody($testMethodName));

        $apiBody->add($order);

        $resultXml = html_entity_decode($apiBody->getAsXmlString());
        $this->assertStringContainsString("<{$testMethodName}>", $resultXml);
        $this->assertStringContainsString("<order number=\"{$intTestValue}\">", $resultXml);
        $this->assertStringContainsString("<receiver>", $resultXml);
        $this->assertStringContainsString("<items>", $resultXml);
        $this->assertStringContainsString("<item ", $resultXml);
        $this->assertStringContainsString("<below ", $resultXml);
    }


    public function testAdditionalParams()
    {
        $paramName1 = 'param1';
        $paramName2 = 'param2';
        $paramValue1 = 'value1';
        $testMethodName = 'testMethod1';
        $apiBody = new DalliApiBody($testMethodName, [$paramName1 => [$paramName2 => $paramValue1]]);
        $resultXml = html_entity_decode($apiBody->getAsXmlString());
        var_dump($resultXml);
        $this->assertStringContainsString("<{$paramName1}><{$paramName2}>{$paramValue1}</{$paramName2}></{$paramName1}>", $resultXml);


    }
}
