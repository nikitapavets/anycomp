<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\ProcessorCore;

trait ProcessorCoreTrait
{
    /**
     * @return ProcessorCore
     */
    public function getProcessorCore()
    {
        return $this->processorCore;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function processorCore()
    {
        return $this->belongsTo('App\Models\Database\ProcessorCore');
    }

    /**
     * @param int $processorCoreId
     * @param string $newProcessorCore
     */
    public function setProcessorCore($processorCoreId, $newProcessorCore = '')
    {
        $processorCore = $newProcessorCore
            ? ProcessorCore::firstOrCreate(['name' => $newProcessorCore])
            : ProcessorCore::find($processorCoreId);
        $this->processorCore()->associate($processorCore);
    }
}
