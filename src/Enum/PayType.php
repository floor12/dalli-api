<?php


namespace floor12\DalliApi\Enum;


class PayType
{
    const CASH = 'CASH';
    const CARD = 'CARD';
    const NO = 'NO';

    public static $list = [
      self::CASH => 'Наличными',
      self::CARD => 'Картой',
      self::NO => 'Без оплаты',
    ];
}
