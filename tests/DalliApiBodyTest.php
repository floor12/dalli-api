<?php

namespace floor12\DalliApi\Tests;

use Faker\Factory;
use floor12\DalliApi\Enum\DalliService;
use floor12\DalliApi\Enum\PayType;
use floor12\DalliApi\Models\Below;
use floor12\DalliApi\Models\DalliApiBody;
use floor12\DalliApi\Models\Item;
use floor12\DalliApi\Models\Order;
use floor12\DalliApi\Models\Receiver;
use PHPUnit\Framework\TestCase;

class DalliApiBodyTest extends TestCase
{
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
        $authToken = 'dsfasdfawefwe';
        $apiBody = (new DalliApiBody($testMethodName, $authToken));

        $apiBody->add($order);

        $resultXml = html_entity_decode($apiBody->getAsXmlString());
        $this->assertStringContainsString("<{$testMethodName}>", $resultXml);
        $this->assertStringContainsString("<auth token=\"{$authToken}\"/>", $resultXml);
        $this->assertStringContainsString("<order number=\"{$intTestValue}\">", $resultXml);
        $this->assertStringContainsString("<receiver>", $resultXml);
        $this->assertStringContainsString("<items>", $resultXml);
        $this->assertStringContainsString("<item ", $resultXml);
        $this->assertStringContainsString("<below ", $resultXml);
    }
}
