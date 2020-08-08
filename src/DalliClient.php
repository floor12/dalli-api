<?php

namespace floor12\DalliApi;

use floor12\DalliApi\Exceptions\EmptyTokenException;
use floor12\DalliApi\Models\DalliApiBody;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;

class DalliClient
{
    /** @var ClientInterface */
    private $client;
    /** @var string */
    private $dalliEndpoint;
    /** @var array */
    private $errors = [];
    /** @var ResponseInterface */
    private $response;
    /** @var string */
    private $responseBody;
    /** @var string */
    private $authToken;

    /**
     * DalliClient constructor.
     * @param string $dalliEndpoint
     * @param string|null $authToken
     * @param ClientInterface|null $client
     * @throws EmptyTokenException
     */
    public function __construct(string $dalliEndpoint, ?string $authToken, ClientInterface $client = null)
    {
        if (empty($authToken))
            throw new EmptyTokenException();

        $this->client = $client ?? new Client();
        $this->dalliEndpoint = $dalliEndpoint;
        $this->authToken = $authToken;
    }

    /**
     * @param DalliApiBody $bodyObject
     * @return DalliApiBody
     */
    private function addAuthTokenToBody(DalliApiBody $bodyObject): DalliApiBody
    {
        $auth = $bodyObject->mainElement->addChild('auth');
        $auth->addAttribute('token', $this->authToken);
        return $bodyObject;
    }

    /**
     * @return bool
     */
    private function parseErrors(): bool
    {
        $pattern = '/errorMessage=\'(.+)\'/';
        if (!preg_match_all($pattern, $this->responseBody, $matches)) {
            return true;
        }
        $this->errors = $matches[1];
        if ($this->errors[0] === 'Успешно') {
            $this->errors = [];
            return true;
        }
        return false;
    }

    /**
     * @param DalliApiBody $bodyObject
     * @return boolean
     * @throws GuzzleException
     */
    public function sendApiRequest(DalliApiBody $bodyObject): bool
    {
        $bodyObject = $this->addAuthTokenToBody($bodyObject);
        $headers = ['Content-type' => 'application/xml'];
        $request = new Request('POST', $this->dalliEndpoint, $headers, $bodyObject->getAsXmlString());
        $this->response = $this->client->send($request);
        $this->responseBody = (clone $this->response)->getBody()->getContents();
        return $this->parseErrors();
    }

    /**
     * @return array
     */
    public function getErrors(): array
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

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
