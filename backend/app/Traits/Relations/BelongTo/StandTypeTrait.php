<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\StandType;

trait StandTypeTrait
{
    /**
     * @return StandType
     */
    public function getStandType()
    {
        return $this->standType;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function standType()
    {
        return $this->belongsTo('App\Models\Database\StandType');
    }

    /**
     * @param int $standTypeId
     * @param string $newStandType
     */
    public function setStandType($standTypeId, $newStandType = '')
    {
        $standType = $newStandType
            ? StandType::firstOrCreate(['name' => $newStandType])
            : StandType::find($standTypeId);
        $this->standType()->associate($standType);
    }
}
