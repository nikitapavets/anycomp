<?php

namespace App\Models;

use App\Traits\GetSet\CreatedAtTrait;
use App\Traits\GetSet\IdTrait;
use App\Traits\GetSet\UpdatedAtTrait;
use App\Traits\Relations\BelongTo\RepairTrait;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use IdTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;

    const IMG_SRC = "/images/users/no-avatar.png";
    const IMG_SIZE_SMALL = 128;
    const CREATOR_LOGIN = 'n.pavets';

    const SKILL_ADMIN = 'creator';
    const SKILL_ADMIN_NATIVE = 'Администратор';
    const SKILL_DIRECTOR = 'director';
    const SKILL_DIRECTOR_NATIVE = 'Директор';
    const SKILL_WORKER = 'worker';
    const SKILL_WORKER_NATIVE = 'Инженер';
    const SKILL_MANAGER = 'manager';
    const SKILL_MANAGER_NATIVE = 'Менеджер';

    protected $guarded = [
        'login',
        'password',
        'email',
        'created_at',
        'updated_at',
        'skill',
    ];

    protected $fillable = [
        'first_name',
        'second_name',
        'father_name',
        'img',
        'phone',
    ];

    protected $hidden = [
        'password',
        'img'
    ];

    protected $appends = [
        'sf_name',
        'full_name',
        'short_name',
        'skill_native',
        'img_small',
        'img_big',
    ];

    public function getImgBigAttribute()
    {
        return $this->getImg();
    }

    public function getImgSmallAttribute()
    {
        return $this->getImg(self::IMG_SIZE_SMALL);
    }

    public function getSfNameAttribute()
    {
        return $this->second_name . ' ' . $this->first_name;
    }

    public function getFullNameAttribute()
    {
        return $this->second_name . ' ' . $this->first_name . ' ' . $this->father_name;
    }

    public function getShortNameAttribute()
    {
        $second_name = $this->second_name;
        $initials = mb_substr($this->first_name, 0, 1) . ". " . mb_substr($this->father_name, 0, 1) . ".";
        $shortName = $second_name . ' ' . $initials;

        return $shortName;
    }

    public function getRepairsAcceptedAttribute()
    {
        $second_name = $this->second_name;
        $initials = mb_substr($this->first_name, 0, 1) . ". " . mb_substr($this->father_name, 0, 1) . ".";
        $shortName = $second_name . ' ' . $initials;

        return $shortName;
    }

    public function getSkillNativeAttribute()
    {
        switch ($this->skill) {
            case self::SKILL_ADMIN: return self::SKILL_ADMIN_NATIVE;
            case self::SKILL_DIRECTOR: return self::SKILL_DIRECTOR_NATIVE;
            case self::SKILL_WORKER: return self::SKILL_WORKER_NATIVE;
            case self::SKILL_MANAGER: return self::SKILL_MANAGER_NATIVE;
        }
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

    public function getName()
    {
        return $this->sf_name;
    }
}
