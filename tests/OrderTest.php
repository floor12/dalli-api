<?php

namespace floor12\DalliApi\Tests;

use Faker\Factory;
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

        $order = new Order();
        $order->setReceiver($receiver);
        $order->setOrderno(123);

        $resultXml = html_entity_decode($order->getAsXmlString());
        $this->assertContains('<order>', $resultXml);
        $this->assertContains('<receiver>', $resultXml);
        $this->assertContains('<address>', $resultXml);

//        var_dump($resultXml);

    }


}
