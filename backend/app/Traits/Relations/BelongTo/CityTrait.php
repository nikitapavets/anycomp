<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\City;

trait CityTrait
{
    /**
     * @return City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param int $cityId
     * @param string $newCity
     */
    public function setCity($cityId, $newCity = '')
    {
        $city = $newCity
            ? City::firstOrCreate(['name' => $newCity])
            : City::find($cityId);
        $this->city()->associate($city);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo('App\Models\Database\City');
    }
}
