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

    public function testSendApiRequest()
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
        $dalliClient->sendApiRequest($body);
        $this->assertEquals(1, sizeof($container));
        /** @var Request $request */
        $request = $container[0]['request'];
        $this->assertEquals($testEndpoint, $request->getUri());
        $this->assertEquals($body, $request->getBody());
        $this->assertEquals('application/xml', $request->getHeader('Content-type')[0]);
    }
}
