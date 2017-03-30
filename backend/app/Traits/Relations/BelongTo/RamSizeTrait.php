<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\StorageSize;

trait RamSizeTrait
{
    /**
     * @return StorageSize
     */
    public function getRamSize()
    {
        return $this->ramSize;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ramSize()
    {
        return $this->belongsTo('App\Models\Database\StorageSize', 'ram_size_id');
    }

    /**
     * @param int $ramSizeId
     * @param string $newRamSize
     */
    public function setRamSize($ramSizeId, $newRamSize = '')
    {
        $ramSize = $newRamSize
            ? StorageSize::firstOrCreate(['name' => $newRamSize])
            : StorageSize::find($ramSizeId);
        $this->ramSize()->associate($ramSize);
    }
}
