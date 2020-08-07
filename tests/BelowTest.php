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
        $this->assertStringContainsString('<below', $resultXml);
        $this->assertStringContainsString("above_price=\"{$testValue}\"", $resultXml);
        $this->assertStringContainsString("return_price=\"{$testValue}\"", $resultXml);
        $this->assertStringContainsString("below=\"{$testValue}\"", $resultXml);
        $this->assertStringContainsString("below_sum=\"{$testValue}\"", $resultXml);
        $this->assertStringContainsString("price=\"{$testValue}\"", $resultXml);
    }

    public function testXmlFewFields()
    {
        $testValue = rand(1, 10);
        $below = new Below();
        $below
            ->setAbovePrice($testValue)
            ->setBelow($testValue);

        $resultXml = html_entity_decode($below->getAsXmlString());
        $this->assertStringContainsString('<below', $resultXml);
        $this->assertStringContainsString(" below=\"{$testValue}\"", $resultXml);
        $this->assertStringContainsString(" above_price=\"{$testValue}\"", $resultXml);
        $this->assertStringNotContainsString(" return_price=\"{$testValue}\"", $resultXml);
        $this->assertStringNotContainsString(" below_sum=\"{$testValue}\"", $resultXml);
        $this->assertStringNotContainsString(" price=\"{$testValue}\"", $resultXml);
    }
}
