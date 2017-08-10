<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Repair;

trait RepairTrait
{
    /**
     * @return Repair
     */
    public function getRepair()
    {
        return $this->repair;
    }

    /**
     * @param Repair $repair
     */
    public function setRepair(Repair $repair)
    {
        $this->repair()->associate($repair);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function repair()
    {
        return $this->belongsTo('App\Models\Repair');
    }
}
