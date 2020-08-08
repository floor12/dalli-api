<?php

namespace floor12\DalliApi\Tests;

use floor12\DalliApi\DalliClient;
use floor12\DalliApi\Exceptions\EmptyTokenException;
use floor12\DalliApi\Models\DalliApiBody;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class DalliClientTest extends TestCase
{

    public function testEmptyToken()
    {
        $this->expectException(EmptyTokenException::class);
        $this->expectExceptionMessage('Dalli Service auth token is empty.');
        new DalliClient('testEndpoint', '');
    }

    public function testSendApiRequestSuccess()
    {
        $testEndpoint = 'https://testendpoint.com';
        $testToken = 'tokenForTest';

        $body = new DalliApiBody('testApiMethod');

        $container = [];
        $history = Middleware::history($container);
        $mock = new MockHandler([new Response(200, ['Content-Length' => 0]),]);
        $handlerStack = HandlerStack::create($mock);
        $handlerStack->push($history);
        $httpClient = new Client(['handler' => $handlerStack]);
        $dalliClient = new DalliClient($testEndpoint, $testToken, $httpClient);
        $this->assertTrue($dalliClient->sendApiRequest($body));
        $this->assertEquals(1, sizeof($container));
        /** @var Request $request */
        $request = $container[0]['request'];
        $this->assertEquals($testEndpoint, $request->getUri());
        $this->assertContains($testToken, $request->getBody()->getContents());
        $this->assertEquals('application/xml', $request->getHeader('Content-type')[0]);
    }


    public function testSendApiRequestErrors()
    {
        $testEndpoint = 'https://testendpoint.com';
        $testToken = 'tokenForTest';

        $body = new DalliApiBody('testApiMethod');

        $responseBody = '<?xml version="1.0" encoding="UTF-8"?><basketcreate><order number=\'188\'>
        <error error=\'number\' errorCode=\'33\' errorMessage=\'Ошибка 1\' />
        <error error=\'number\' errorCode=\'33\' errorMessage=\'Ошибка 2\' />
        </order></basketcreate>';

        $container = [];
        $history = Middleware::history($container);
        $mock = new MockHandler([new Response(200, ['Content-Length' => strlen($responseBody)], $responseBody)]);
        $handlerStack = HandlerStack::create($mock);
        $handlerStack->push($history);
        $httpClient = new Client(['handler' => $handlerStack]);
        $dalliClient = new DalliClient($testEndpoint, $testToken, $httpClient);

        $this->assertFalse($dalliClient->sendApiRequest($body));
        $this->assertEquals(2, sizeof($dalliClient->getErrors()));
        $this->assertEquals('Ошибка 1', $dalliClient->getErrors()[0]);
        $this->assertEquals('Ошибка 2', $dalliClient->getErrors()[1]);
    }

    public function testSendApiRequestErrorZero()
    {
        $testEndpoint = 'https://testendpoint.com';
        $testToken = 'tokenForTest';

        $body = new DalliApiBody('testApiMethod');

        $responseBody = "<order number='136' barcode='S1215444'><error error='order' errorCode='0' errorMessage='Успешно' /></order>";

        $container = [];
        $history = Middleware::history($container);
        $mock = new MockHandler([new Response(200, ['Content-Length' => strlen($responseBody)], $responseBody)]);
        $handlerStack = HandlerStack::create($mock);
        $handlerStack->push($history);
        $httpClient = new Client(['handler' => $handlerStack]);
        $dalliClient = new DalliClient($testEndpoint, $testToken, $httpClient);

        $this->assertTrue($dalliClient->sendApiRequest($body));
        $this->assertEquals(0, sizeof($dalliClient->getErrors()));
        }
}
