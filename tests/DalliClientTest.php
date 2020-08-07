<?php

namespace floor12\DalliApi\Tests;

use floor12\DalliApi\DalliClient;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class DalliClientTest extends TestCase
{

    public function testSendApiRequestSuccess()
    {
        $testEndpoint = 'https://testendpoint.com';
        $body = 'test body';

        $container = [];
        $history = Middleware::history($container);
        $mock = new MockHandler([new Response(200, ['Content-Length' => strlen($body)]),]);
        $handlerStack = HandlerStack::create($mock);
        $handlerStack->push($history);
        $httpClient = new Client(['handler' => $handlerStack]);
        $dalliClient = new DalliClient($testEndpoint, $httpClient);
        $this->assertTrue($dalliClient->sendApiRequest($body));
        $this->assertEquals(1, sizeof($container));
        /** @var Request $request */
        $request = $container[0]['request'];
        $this->assertEquals($testEndpoint, $request->getUri());
        $this->assertEquals($body, $request->getBody());
        $this->assertEquals('application/xml', $request->getHeader('Content-type')[0]);
    }


    public function testSendApiRequestErrors()
    {
        $testEndpoint = 'https://testendpoint.com';
        $body = '<?xml version="1.0" encoding="UTF-8"?><basketcreate><order number=\'188\'>
        <error error=\'number\' errorCode=\'33\' errorMessage=\'Ошибка 1\' />
        <error error=\'number\' errorCode=\'33\' errorMessage=\'Ошибка 2\' />
        </order></basketcreate>';

        $container = [];
        $history = Middleware::history($container);
        $mock = new MockHandler([new Response(200, ['Content-Length' => strlen($body)], $body)]);
        $handlerStack = HandlerStack::create($mock);
        $handlerStack->push($history);
        $httpClient = new Client(['handler' => $handlerStack]);
        $dalliClient = new DalliClient($testEndpoint, $httpClient);
        $this->assertFalse($dalliClient->sendApiRequest('body'));

        $this->assertEquals(2, sizeof($dalliClient->getErrors()));
        $this->assertEquals('Ошибка 1', $dalliClient->getErrors()[0]);
        $this->assertEquals('Ошибка 2', $dalliClient->getErrors()[1]);

    }
}
