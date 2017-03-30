<?php

namespace App\Repositories;

use App\Models\Admin;

class AdminRepository
{
    /**
     * @return Admin[]
     */
    public static function getRepairAdmins()
    {
        return Admin::where('skill', '=', 'worker')->get();
    }
}
