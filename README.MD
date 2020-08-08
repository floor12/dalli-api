# Dalli Service XML API Client

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/floor12/dalli-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/floor12/dalli-api/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/floor12/dalli-api/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/floor12/dalli-api/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/floor12/dalli-api/badges/build.png?b=master)](https://scrutinizer-ci.com/g/floor12/dalli-api/build-status/master)

## Установка

Устанавливаем  модуль через composer. 
Выполняем команду
```bash
$ composer require floor12/dalli-api
```
или добавляем в секцию "required" файла composer.json
```json
"floor12/dalli-api":"dev-master"
```

## Инициализация

```php
use floor12\DalliApi\DalliClient;
use floor12\DalliApi\Enum\DalliApiEndpoint;
$token = 'your_token';
$dalliClient = new DalliClient(DalliApiEndpoint::SPB, $token);
```

## Примеры вызовов

### Отправка заказа в корзину

```php

use floor12\DalliApi\Enum\DalliService;
use floor12\DalliApi\Models\Item;
use floor12\DalliApi\Models\Order;
use floor12\DalliApi\Models\Receiver;
use floor12\DalliApi\Enum\DalliApiMethod;
use floor12\DalliApi\Models\DalliApiBody;
use floor12\DalliApi\DalliClient;
use floor12\DalliApi\Enum\DalliApiEndpoint;


$token = 'your_token';
$dalliClient = new DalliClient(DalliApiEndpoint::SPB, $token);

$apiBody = new DalliApiBody(DalliApiMethod::BASKET_CREATE);

$receiver = (new Receiver())
    ->setPerson('Иванов Иван Иванович')
    ->setAddress('Большая Серпуховская 12-32')
    ->setTown('Москва')
    ->setDate('2020-10-10')
    ->setTimeMin('15:00')
    ->setTimeMax('21:00')
    ->setPhone('79269392399');

$order = (new Order())
    ->setNumber('AXC-12')
    ->setQuantity(1)
    ->setInshprice(1000)
    ->setPrice(1000)
    ->setService(DalliService::EXPRESS_MOSCOW)
    ->setReceiver($receiver);


$item1 = (new Item())
    ->setTitle('Юбка')
    ->setArticle('F2D0001')
    ->setQuantity(1)
    ->setWeight(0.3)
    ->setBarcode('460063453454')
    ->setRetprice(500);

$item2 = (new Item())
    ->setTitle('Кофта')
    ->setArticle('F2D0001')
    ->setQuantity(1)
    ->setWeight(0.3)
    ->setBarcode('460063453454')
    ->setRetprice(500);

$order->addItem($item1);
$order->addItem($item2);

$apiBody->add($order);

$success = !$dalliClient->sendApiRequest($apiBody);
if (!$success)
    foreach ($dalliClient->getErrors() as $error)
        echo $error;

echo $dalliClient->getResponseBody();
```

### Очистка корзины

```php
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
```
