<?php

use floor12\DalliApi\DalliClient;
use floor12\DalliApi\Enum\DalliApiEndpoint;
use floor12\DalliApi\Enum\DalliApiMethod;
use floor12\DalliApi\Models\DalliApiBody;
use floor12\DalliApi\OrderStatusDispatcher;

$token = 'your_token';
$dalliClient = new DalliClient(DalliApiEndpoint::SPB, $token);

$apiBody = new DalliApiBody(DalliApiMethod::ORDER_STATUS);

$success = $dalliClient->sendApiRequest($apiBody);

if (!$success)
    foreach ($dalliClient->getErrors() as $error)
        echo $error;

$dispatcher = new OrderStatusDispatcher($dalliClient->getResponseBody());

echo $dispatcher->getStatusId();
echo $dispatcher->getStatusName();
echo $dispatcher->getStatusTimestamp();

foreach ($dispatcher->getItems() as $item) {
    echo $item->_barcode;
    echo $item->isReturned();
}
