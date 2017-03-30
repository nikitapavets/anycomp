<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Admin;

trait WorkerTrait
{
    /**
     * @return Admin
     */
    public function getWorker()
    {
        return $this->worker;
    }

    /**
     * @param int $workerId
     */
    public function setWorker($workerId)
    {
        $worker = Admin::find($workerId);
        $this->worker()->associate($worker);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function worker()
    {
        return $this->belongsTo('App\Models\Admin', 'worker_id');
    }
}
