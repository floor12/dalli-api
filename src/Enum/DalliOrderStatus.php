<?php


namespace floor12\DalliApi\Enum;


class DalliOrderStatus extends SimpleEnum
{
    const NEW = 'NEW';
    const ACCEPTED = 'ACCEPTED';
    const INVENTORY = 'INVENTORY';
    const DEPARTURING = 'DEPARTURING';
    const DEPARTURE = 'DEPARTURE';
    const DELIVERY = 'DELIVERY';
    const COURIERDELIVERED = 'COURIERDELIVERED';
    const COMPLETE = 'COMPLETE';
    const PARTIALLY = 'PARTIALLY';
    const COURIERRETURN = 'COURIERRETURN';
    const CANCELED = 'CANCELED';
    const RETURNING = 'RETURNING';
    const RETURNED = 'RETURNED';
    const CONFIRM = 'CONFIRM';
    const DATECHANGE = 'DATECHANGE';
    const NEWPICKUP = 'NEWPICKUP';
    const UNCONFIRM = 'UNCONFIRM';
    const PICKUPREADY = 'PICKUPREADY';

    public static $list = [
        self::NEW => 'Новый',
        self::ACCEPTED => 'Получен складом',
        self::INVENTORY => 'Инвентаризация',
        self::DEPARTURING => 'Планируется отправка',
        self::DEPARTURE => 'Отправлено со склада',
        self::DELIVERY => 'Выдан курьеру на доставку',
        self::COURIERDELIVERED => 'Доставлен (предварительно)',
        self::COMPLETE => 'Доставлен',
        self::PARTIALLY => 'Доставлен частично',
        self::COURIERRETURN => 'Возвращено курьером',
        self::RETURNING => 'Возврат/отмена',
        self::RETURNED => 'Планируется возврат',
        self::CONFIRM => 'Согласована доставка',
        self::DATECHANGE => 'Перенос',
        self::NEWPICKUP => 'Создан забор',
        self::UNCONFIRM => 'Не удалось согласовать доставку',
        self::PICKUPREADY => 'Готов к выдаче',
        self::CANCELED => 'Отказ клиента',
    ];

}
