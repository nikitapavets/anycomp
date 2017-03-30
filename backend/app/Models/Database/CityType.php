<?php

namespace App\Models\Database;

use App\Models\Database;
use Illuminate\Http\Request;

class CityType extends Database
{
    /**
     * @param bool $details
     * @return string
     */
    public function getShortName($details = false)
    {
        if($this->isSelected()) {
            return $this->short_name;
        } else {
            return $details ? 'Выбор' : '';
        }
    }

    /**
     * @param string $shortName
     */
    public function setShortName($shortName)
    {
        $this->short_name = $shortName;
    }

    public static function store(Request $request)
    {
        /**
         * @var self $cityType
         */
        $cityType = self::firstOrNew(['id' => $request->cityTypeId ?? 0]);
        $cityType->setName($request->cityTypeName);
        $cityType->setShortName($request->cityTypeShortName);
        $cityType->save();
    }
}
