<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\ProcessorStage;

trait ProcessorStageTrait
{
    /**
     * @return ProcessorStage
     */
    public function getProcessorStage()
    {
        return $this->processorStage;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function processorStage()
    {
        return $this->belongsTo('App\Models\Database\ProcessorStage');
    }

    /**
     * @param int $processorStageId
     * @param string $newProcessorStage
     */
    public function setProcessorStage($processorStageId, $newProcessorStage = '')
    {
        $processorStage = $newProcessorStage
            ? ProcessorStage::firstOrCreate(['name' => $newProcessorStage])
            : ProcessorStage::find($processorStageId);
        $this->processorStage()->associate($processorStage);
    }
}
