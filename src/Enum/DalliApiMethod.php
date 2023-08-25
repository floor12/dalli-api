<?php


namespace floor12\DalliApi\Enum;


class DalliApiMethod
{
    const BASKET_CREATE = 'basketcreate';
    const BASKET_UPDATE = 'editbasket';
    const BASKET_GET = 'getbasket';
    const BASKET_CLEAR = 'removebasket';
    const BASKET_CONFIRM = 'sendbasket';
    const ACT = 'getact';
    const STICKERS = 'stickers';
    const ORDER_STATUS = 'statusreq';
    const SERVICES_LIST = 'services';
    const PVZ_LIST = 'pvzlist';
    const POINTS_INFO = 'pointsInfo';
    const DELIVERY_COST = 'deliverycost';
    const DELIVERY_INTERVALS = 'intervals';
}
