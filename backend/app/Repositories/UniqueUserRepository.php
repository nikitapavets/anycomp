<?php

namespace App\Repositories;

use App\Models\Users\UniqueUser;

class UniqueUserRepository
{

    /**
     * @return UniqueUser
     */
    public static function getCurrent()
    {
        return self::getByGuid(self::getGuidFormCookie());
    }

    /**
     * @param int $id
     * @return UniqueUser
     */
    public static function getById($id)
    {
        return UniqueUser::where('id', '=', $id)->first();
    }

    /**
     * @param string $guid
     * @return UniqueUser
     */
    public static function getByGuid($guid)
    {
        return UniqueUser::where('guid', '=', $guid)->first();
    }

    /**
     * @return UniqueUser[]
     */
    public static function getUniqueUsers()
    {
        return UniqueUser::orderBy('id', 'desc')->get();
    }

    /**
     * @param string $guid
     * @return UniqueUser
     */
    public static function storeUniqueUser($guid)
    {
        /**
         * @var UniqueUser $uniqueUser
         */
        $uniqueUser = UniqueUser::firstOrNew(['guid' => $guid]);
        $uniqueUser->setGuid($guid);
        $uniqueUser->setIp($_SERVER['REMOTE_ADDR']);
        $uniqueUser->setUserAgent($_SERVER['HTTP_USER_AGENT']);
        $uniqueUser->save();

        return $uniqueUser;
    }

    /**
     * @return string
     */
    public static function getGuidFormCookie()
    {
        return $_COOKIE[config('cookie.guid')];
    }
}
