<?php

namespace floor12\DalliApi\Tests;

use floor12\DalliApi\Models\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{

    public function testXmlAllFields()
    {
        $quantity = rand(1, 10);
        $mass = rand(1, 10);
        $retprice = rand(1, 10);
        $barcode = rand(1, 10);
        $article = rand(1, 10);


        $item = new Item();
        $item
            ->setArticle($article)
            ->setBarcode($barcode)
            ->setMass($mass)
            ->setQuantity($quantity)
            ->setRetprice($retprice);

        $resultXml = html_entity_decode($item->getAsXmlString());
        $this->assertContains('<item', $resultXml);
        $this->assertContains(" quantity=\"{$quantity}\"", $resultXml);
        $this->assertContains(" mass=\"{$mass}\"", $resultXml);
        $this->assertContains(" retprice=\"{$retprice}\"", $resultXml);
        $this->assertContains(" barcode=\"{$barcode}\"", $resultXml);
        $this->assertContains(" article=\"{$article}\"", $resultXml);
    }

    public function testXml()
    {
        $quantity = rand(1, 10);
        $mass = rand(1, 10);
        $retprice = rand(1, 10);


        $item = new Item();
        $item
            ->setMass($mass)
            ->setQuantity($quantity)
            ->setRetprice($retprice);

        $resultXml = html_entity_decode($item->getAsXmlString());
        $this->assertContains('<item', $resultXml);
        $this->assertContains("quantity=\"{$quantity}\"", $resultXml);
        $this->assertContains("mass=\"{$mass}\"", $resultXml);
        $this->assertContains("retprice=\"{$retprice}\"", $resultXml);
        $this->assertNotContains("barcode", $resultXml);
        $this->assertNotContains("article", $resultXml);
    }
}
