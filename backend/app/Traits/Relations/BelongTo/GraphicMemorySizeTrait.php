<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\StorageSize;

trait GraphicMemorySizeTrait
{
    /**
     * @return StorageSize
     */
    public function getGraphicMemorySize()
    {
        return $this->graphicMemorySize;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function graphicMemorySize()
    {
        return $this->belongsTo('App\Models\Database\StorageSize', 'graphic_memory_size_id');
    }

    /**
     * @param int $graphicMemorySizeId
     * @param string $newGraphicMemorySize
     */
    public function setGraphicMemorySize($graphicMemorySizeId, $newGraphicMemorySize = '')
    {
        $graphicMemorySize = $newGraphicMemorySize
            ? StorageSize::firstOrCreate(['name' => $newGraphicMemorySize])
            : StorageSize::find($graphicMemorySizeId);
        $this->graphicMemorySize()->associate($graphicMemorySize);
    }
}
