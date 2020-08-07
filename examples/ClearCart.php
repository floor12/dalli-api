<?php

use floor12\DalliApi\DalliClient;
use floor12\DalliApi\Enum\DalliApiEndpoint;
use floor12\DalliApi\Enum\DalliApiMethod;
use floor12\DalliApi\Models\DalliApiBody;

$dalliClient = new DalliClient(DalliApiEndpoint::SPB);

$token = '<ваш token>';
$apiBody = new DalliApiBody(DalliApiMethod::BASKET_CLEAR, $token);

if (!$dalliClient->sendApiRequest($apiBody->getAsXmlString()))
    foreach ($dalliClient->getErrors() as $error)
        echo $error;
