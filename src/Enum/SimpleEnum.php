<?php


namespace floor12\DalliApi\Enum;


 class SimpleEnum
{
    /** @var array */
    public static $list = [];

    /**
     * @param int|string $value
     * @return string|null
     */
    public static function getLabel($value): ?string
    {
        return static::$list[$value] ?? null;
    }
}
