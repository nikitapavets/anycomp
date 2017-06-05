<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Models\Worker;

class AdminRepository
{
    /**
     * @return Admin[]
     */
    public static function getRepairAdmins()
    {
        return Admin::where('login', '!=', Admin::CREATOR_LOGIN)
            ->get();
    }

    /**
     * @return Admin[]
     */
    public static function getAdmins()
    {
        return Admin::orderBy('id', 'asc')->get();
    }

    public static function adminToArray(Admin $admin)
    {
        return [
            'id' => $admin->getId(),
            'second_name' => $admin->getSecondName(),
            'first_name' => $admin->getFirstName(),
            'father_name' => $admin->getFatherName(),
            'full_name' => $admin->getFullName(),
            'email' => $admin->getEmail(),
            'image' => $admin->getImg(128),
            'phone' => $admin->getPhone(),
            'skill' => $admin->getSkill(),
            'created_at' => $admin->getCreatedAt(),
            'updated_at' => $admin->getUpdatedAt(),
        ];
    }

    /**
     * @param Admin[] $admins
     * @return array
     */
    public static function adminsToArray($admins)
    {
        return $admins->map(function ($item) {
            return self::adminToArray($item);
        });
    }
}
