<?php

namespace floor12\DalliApi;

use GuzzleHttp\Client;
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
    /** @var array */
    private $errors = [];
    /** @var ResponseInterface */
    private $response;
    /** @var string */
    private $responseBody;

    /**
     * DalliClient constructor.
     * @param string $dalliEndpoint
     * @param ClientInterface|null $client
     */
    public function __construct(string $dalliEndpoint, ClientInterface $client = null)
    {
        $this->client = $client ?? new Client();
        $this->dalliEndpoint = $dalliEndpoint;
    }

    /**
     * @return bool
     */
    private function parseErrors(): bool
    {
        $pattern = '/errorMessage=\'(.+)\'/';
        if (preg_match_all($pattern, $this->responseBody, $matches)) {
            $this->errors = $matches[1];
            return false;
        }
        return true;
    }

    /**
     * @param string $body Body as XML string
     * @return boolean
     * @throws GuzzleException
     */
    public function sendApiRequest(string $body): bool
    {
        $headers = ['Content-type' => 'application/xml'];
        $request = new Request('POST', $this->dalliEndpoint, $headers, $body);
        $this->response = $this->client->send($request);
        $this->responseBody = $this->response->getBody()->getContents();
        return $this->parseErrors();
    }

    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return string
     */
    public function getResponseBody(): string
    {
        return $this->responseBody;
    }
}
