<?php

namespace floor12\DalliApi\Tests;

use floor12\DalliApi\Models\Below;
use PHPUnit\Framework\TestCase;

class BelowTest extends TestCase
{
    public function testXmlAllFields()
    {
        $testValue = rand(1, 10);
        $below = new Below();
        $below
            ->setAbovePrice($testValue)
            ->setBelow($testValue)
            ->setBelowSum($testValue)
            ->setPrice($testValue)
            ->setReturnPrice($testValue);

        $resultXml = html_entity_decode($below->getAsXmlString());
        $this->assertContains('<below', $resultXml);
        $this->assertContains("above_price=\"{$testValue}\"", $resultXml);
        $this->assertContains("return_price=\"{$testValue}\"", $resultXml);
        $this->assertContains("below=\"{$testValue}\"", $resultXml);
        $this->assertContains("below_sum=\"{$testValue}\"", $resultXml);
        $this->assertContains("price=\"{$testValue}\"", $resultXml);
    }

    public function testXmlFewFields()
    {
        $testValue = rand(1, 10);
        $below = new Below();
        $below
            ->setAbovePrice($testValue)
            ->setBelow($testValue);

        $resultXml = html_entity_decode($below->getAsXmlString());
        $this->assertContains('<below', $resultXml);
        $this->assertContains(" below=\"{$testValue}\"", $resultXml);
        $this->assertContains(" above_price=\"{$testValue}\"", $resultXml);
        $this->assertNotContains(" return_price=\"{$testValue}\"", $resultXml);
        $this->assertNotContains(" below_sum=\"{$testValue}\"", $resultXml);
        $this->assertNotContains(" price=\"{$testValue}\"", $resultXml);
    }
}
