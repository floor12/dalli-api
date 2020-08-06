<?php

namespace floor12\DalliApi;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;

class DalliClient
{
    /**
     * @var ClientInterface
     */
    private $client;
    /**
     * @var string
     */
    private $dalliEndpoint;

    /**
     * DalliClient constructor.
     * @param string $dalliEndpoint
     * @param ClientInterface $client
     */
    public function __construct(string $dalliEndpoint, ClientInterface $client)
    {
        $this->client = $client;
        $this->dalliEndpoint = $dalliEndpoint;
    }

    /**
     * @param string $body Body as XML string
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function sendApiRequest(string $body): ResponseInterface
    {
        $headers = ['Content-type' => 'application/xml'];
        $request = new Request('POST', $this->dalliEndpoint, $headers, $body);
        return $this->client->send($request);
    }
}
