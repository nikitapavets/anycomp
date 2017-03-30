<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\StorageSize;

trait SsdSizeTrait
{
    /**
     * @return StorageSize
     */
    public function getSsdSize()
    {
        return $this->ssdSize;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ssdSize()
    {
        return $this->belongsTo('App\Models\Database\StorageSize', 'ssd_size_id');
    }

    /**
     * @param int $ssdSizeId
     * @param string $newSsdSize
     */
    public function setSsdSize($ssdSizeId, $newSsdSize = '')
    {
        $ssdSize = $newSsdSize
            ? StorageSize::firstOrCreate(['name' => $newSsdSize])
            : StorageSize::find($ssdSizeId);
        $this->ssdSize()->associate($ssdSize);
    }
}
