<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\StorageSize;

trait HddSizeTrait
{
    /**
     * @return StorageSize
     */
    public function getHddSize()
    {
        return $this->hddSize;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hddSize()
    {
        return $this->belongsTo('App\Models\Database\StorageSize', 'hdd_size_id');
    }

    /**
     * @param int $hddSizeId
     * @param string $newHddSize
     */
    public function setHddSize($hddSizeId, $newHddSize = '')
    {
        $hddSize = $newHddSize
            ? StorageSize::firstOrCreate(['name' => $newHddSize])
            : StorageSize::find($hddSizeId);
        $this->hddSize()->associate($hddSize);
    }
}
