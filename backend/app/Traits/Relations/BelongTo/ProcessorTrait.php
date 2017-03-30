<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\Processor;

trait ProcessorTrait
{
    /**
     * @return Processor
     */
    public function getProcessor()
    {
        return $this->processor;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function processor()
    {
        return $this->belongsTo('App\Models\Database\Processor');
    }

    /**
     * @param int $processorId
     * @param string $newProcessor
     */
    public function setProcessor($processorId, $newProcessor = '')
    {
        $processor = $newProcessor
            ? Processor::firstOrCreate(['name' => $newProcessor])
            : Processor::find($processorId);
        $this->processor()->associate($processor);
    }
}
