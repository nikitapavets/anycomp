<?php

namespace App\Models;

use App\Traits\GetSet\CreatedAtTrait;
use App\Traits\GetSet\IdTrait;
use App\Traits\GetSet\UpdatedAtTrait;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use IdTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;

    const IMG_SRC = "/images/users/no-avatar.png";
    const CREATOR_LOGIN = 'n.pavets';

    const SKILL_ADMIN = 'creator';
    const SKILL_DIRECTOR = 'director';
    const SKILL_WORKER = 'worker';
    const SKILL_MANAGER = 'manager';

    protected $appends = [
        'sf_name',
    ];

    public function getSfNameAttribute()
    {
        return $this->second_name . ' ' . $this->first_name;
    }

    /**
     * @return Admin
     */
    public static function getAuthAdmin()
    {
        $admin_id = json_decode($_COOKIE['user']);

        return self::where('id', '=', $admin_id)->first();
    }

    /**
     * @param string $login
     * @param string $password
     * @return Admin
     */
    public function checkAdmin($login, $password)
    {
        $admin = $this
            ->where('login', '=', $login)
            ->where('password', '=', $password)
            ->first();

        return $admin;
    }

    public function getName()
    {
        return $this->getSFName();
    }

    public function getSFName()
    {
        return $this->second_name . ' ' . $this->first_name;
    }

    public function getFullName()
    {
        return $this->second_name . ' ' . $this->first_name . ' ' . $this->father_name;
    }

    public function getShortName()
    {
        $second_name = $this->second_name;
        $initials = mb_substr($this->first_name, 0, 1) . ". " . mb_substr($this->father_name, 0, 1) . ".";
        $shortName = $second_name . ' ' . $initials;

        return $shortName;
    }

    public function getImg($image_size = '')
    {
        if(!$this->img) {
            return config('constants.NO_AVATAR_SRC');
        }
        if (!$image_size) {
            return $this->img;
        } else {
            $image_scr = substr($this->img, 0, -4);
            $image_scr .= '_' . $image_size . 'x' . $image_size . substr($this->img, -4);

            return $image_scr;
        }
    }

    public function getSkill()
    {
        $skill = '';
        switch ($this->skill) {
            case self::SKILL_ADMIN:
                $skill = 'Администратор';
                break;
            case self::SKILL_DIRECTOR:
                $skill = 'Директор';
                break;
            case self::SKILL_WORKER:
                $skill = 'Инженер';
                break;
            case self::SKILL_MANAGER:
                $skill = 'Менеджер';
                break;
        }
        return $skill;
    }
}
