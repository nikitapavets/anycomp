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
        return $this->receptionPlace;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receptionPlace()
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
        $this->receptionPlace()->associate($color);
    }
}
