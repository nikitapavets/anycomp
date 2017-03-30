<?php

namespace App\Models;


class Worker extends Admin
{
    public static function getAll()
    {
        return Admin::where('login', '!=', self::CREATOR_LOGIN)
            ->get();
    }
}