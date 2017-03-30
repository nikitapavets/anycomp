<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\RamType;

trait RamTypeTrait
{
    /**
     * @return RamType
     */
    public function getRamType()
    {
        return $this->ramType;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ramType()
    {
        return $this->belongsTo('App\Models\Database\RamType');
    }

    /**
     * @param int $ramTypeId
     * @param string $newRamType
     */
    public function setRamType($ramTypeId, $newRamType = '')
    {
        $ramType = $newRamType
            ? RamType::firstOrCreate(['name' => $newRamType])
            : RamType::find($ramTypeId);
        $this->ramType()->associate($ramType);
    }
}
