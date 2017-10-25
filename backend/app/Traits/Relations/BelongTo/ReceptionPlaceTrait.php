<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\ReceptionPlace;

trait ReceptionPlaceTrait
{
    /**
     * @return ReceptionPlace
     */
    public function getReceptionPlace()
    {
        return $this->reception_place;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reception_place()
    {
        return $this->belongsTo('App\Models\Database\ReceptionPlace', 'reception_place_id');
    }

    /**
     * @param int $receptionPlaceId
     * @param string $newReceptionPlace
     */
    public function setReceptionPlace($receptionPlaceId, $newReceptionPlace = '')
    {
        $color = $newReceptionPlace
            ? ReceptionPlace::firstOrCreate(['name' => $newReceptionPlace])
            : ReceptionPlace::find($receptionPlaceId);
        $this->reception_place()->associate($color);
    }
}
