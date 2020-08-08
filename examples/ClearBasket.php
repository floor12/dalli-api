<?php

use floor12\DalliApi\DalliClient;
use floor12\DalliApi\Enum\DalliApiEndpoint;
use floor12\DalliApi\Enum\DalliApiMethod;
use floor12\DalliApi\Models\DalliApiBody;

$token = 'your_token';
$dalliClient = new DalliClient(DalliApiEndpoint::SPB, $token);

$apiBody = new DalliApiBody(DalliApiMethod::BASKET_CLEAR);

$success = $dalliClient->sendApiRequest($apiBody);

if (!$success)
    foreach ($dalliClient->getErrors() as $error)
        echo $error;

echo $dalliClient->getResponseBody();
