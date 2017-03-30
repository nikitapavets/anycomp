<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\CityType;

trait CityTypeTrait
{
    /**
     * @return CityType
     */
    public function getCityType()
    {
        return $this->cityType;
    }

    /**
     * @param int $cityTypeId
     * @param string $newCityType
     */
    public function setCityType($cityTypeId, $newCityType = '')
    {
        $cityType = $newCityType
            ? CityType::firstOrCreate(['name' => $newCityType])
            : CityType::find($cityTypeId);
        $this->cityType()->associate($cityType);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cityType()
    {
        return $this->belongsTo('App\Models\Database\CityType');
    }
}
