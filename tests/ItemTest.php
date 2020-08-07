<?php

namespace floor12\DalliApi\Tests;

use floor12\DalliApi\Models\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{

    public function testXmlAllFields()
    {
        $quantity = rand(1, 10);
        $weight = rand(1, 10);
        $retprice = rand(1, 10);
        $barcode = rand(1, 10);
        $article = rand(1, 10);
        $title = 'Кросовки';

        $item = new Item();
        $item
            ->setTitle($title)
            ->setArticle($article)
            ->setBarcode($barcode)
            ->setweight($weight)
            ->setQuantity($quantity)
            ->setRetprice($retprice);

        $resultXml = html_entity_decode($item->getAsXmlString());
        $this->assertStringContainsString('<item', $resultXml);
        $this->assertStringContainsString(" quantity=\"{$quantity}\"", $resultXml);
        $this->assertStringContainsString(" weight=\"{$weight}\"", $resultXml);
        $this->assertStringContainsString(" retprice=\"{$retprice}\"", $resultXml);
        $this->assertStringContainsString(" barcode=\"{$barcode}\"", $resultXml);
        $this->assertStringContainsString(" article=\"{$article}\"", $resultXml);
        $this->assertStringContainsString(">{$title}<", $resultXml);
    }

    public function testXml()
    {
        $quantity = rand(1, 10);
        $weight = rand(1, 10);
        $retprice = rand(1, 10);


        $item = new Item();
        $item
            ->setweight($weight)
            ->setQuantity($quantity)
            ->setRetprice($retprice);

        $resultXml = html_entity_decode($item->getAsXmlString());
        $this->assertStringContainsString('<item', $resultXml);
        $this->assertStringContainsString("quantity=\"{$quantity}\"", $resultXml);
        $this->assertStringContainsString("weight=\"{$weight}\"", $resultXml);
        $this->assertStringContainsString("retprice=\"{$retprice}\"", $resultXml);
        $this->assertStringNotContainsString("barcode", $resultXml);
        $this->assertStringNotContainsString("article", $resultXml);
    }
}
