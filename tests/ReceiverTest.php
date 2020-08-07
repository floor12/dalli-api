<?php

namespace floor12\DalliApi\Tests;

use Faker\Factory;
use floor12\DalliApi\Models\Receiver;
use PHPUnit\Framework\TestCase;

class ReceiverTest extends TestCase
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

        $resultXml = html_entity_decode($receiver->getAsXmlString());

        $this->assertStringContainsString('<receiver>', $resultXml);
        $this->assertStringContainsString("<person>$name</person>", $resultXml);
        $this->assertStringContainsString("<address>$address</address>", $resultXml);
        $this->assertStringContainsString("<date>$date</date>", $resultXml);
        $this->assertStringContainsString("<zipcode>$zipcode</zipcode>", $resultXml);
        $this->assertStringContainsString("<phone>$phone</phone>", $resultXml);
        $this->assertStringContainsString("<town>$town</town>", $resultXml);
        $this->assertStringContainsString("<time_max>$timeMax</time_max>", $resultXml);
        $this->assertStringContainsString("<time_min>$timeMin</time_min>", $resultXml);
    }
}
