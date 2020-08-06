<?php

namespace floor12\DalliApi\Tests;

use Faker\Factory;
use floor12\DalliApi\Enum\DalliService;
use floor12\DalliApi\Enum\PayType;
use floor12\DalliApi\Models\Below;
use floor12\DalliApi\Models\Item;
use floor12\DalliApi\Models\Order;
use floor12\DalliApi\Models\Receiver;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{

    public function testXml()
    {
        $faker = Factory::create('ru_RU');
        $name = $faker->name;
        $address = $faker->streetAddress;
        $date = $faker->date();
        $town = $faker->city;
        $zipcode = $faker->postcode;
        $phone = $faker->phoneNumber;
        $timeMin = $faker->time('H:i');
        $timeMax = $faker->time('H:i');

        $intTestValue = rand(1, 10);
        $stringTestValue = $faker->streetAddress;

        $receiver = new Receiver();
        $receiver
            ->setPerson($name)
            ->setAddress($address)
            ->setDate($date)
            ->setZipcode($zipcode)
            ->setPhone($phone)
            ->setTown($town)
            ->setTimeMax($timeMax)
            ->setTimeMin($timeMin);


        $barcode = rand(99999, 9999999);
        $item = new Item();
        $item->setBarcode($barcode);

        $below = (new Below())
            ->setPrice($intTestValue);

        $order = new Order();

        $order->setOrderno(123)
            ->setReceiver($receiver)
            ->setService(DalliService::EXPRESS_PICKUP)
            ->setWeight($intTestValue)
            ->setQuantity($intTestValue)
            ->setPaytype(PayType::CARD)
            ->setPrice($intTestValue)
            ->setPriced($intTestValue)
            ->setInshprice($intTestValue)
            ->setUpsnak($intTestValue)
            ->setInstruction($stringTestValue)
            ->addDeliveryset($below)
            ->addItem($item);

        $resultXml = html_entity_decode($order->getAsXmlString());
        $this->assertContains('<order>', $resultXml);
        $this->assertContains('<items>', $resultXml);
        $this->assertContains('<deliveryset>', $resultXml);
        $this->assertContains("<item quantity=\"1\" barcode=\"{$barcode}\"/>", $resultXml);
        $this->assertContains("<below price=\"{$intTestValue}\"/>", $resultXml);
        $this->assertContains('<receiver>', $resultXml);
        $this->assertContains('<address>', $resultXml);
    }


}
