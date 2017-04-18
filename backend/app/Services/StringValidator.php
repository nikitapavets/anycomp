<?php

namespace App\Services;


class StringValidator
{
    public static function clearStr($data)
    {
        return trim($data);
    }

    public static function validateStr($data, $oldData)
    {
        if (isset($data)) {
            return self::clearStr($data);
        } else {
            return $oldData;
        }
    }
}