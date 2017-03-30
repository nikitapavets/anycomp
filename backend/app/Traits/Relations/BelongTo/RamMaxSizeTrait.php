<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\StorageSize;

trait RamMaxSizeTrait
{
    /**
     * @return StorageSize
     */
    public function getRamMaxSize()
    {
        return $this->ramMaxSize;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ramMaxSize()
    {
        return $this->belongsTo('App\Models\Database\StorageSize', 'ram_max_size_id');
    }

    /**
     * @param int $ramMaxSizeId
     * @param string $newRamMaxSize
     */
    public function setRamMaxSize($ramMaxSizeId, $newRamMaxSize = '')
    {
        $ramMaxSize = $newRamMaxSize
            ? StorageSize::firstOrCreate(['name' => $newRamMaxSize])
            : StorageSize::find($ramMaxSizeId);
        $this->ramMaxSize()->associate($ramMaxSize);
    }
}
