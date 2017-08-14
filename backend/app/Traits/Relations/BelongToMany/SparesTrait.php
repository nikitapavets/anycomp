<?php

namespace App\Traits\Relations\BelongToMany;

use App\Models\Spare;

trait SparesTrait
{

    /**
     * @return Spare[]
     */
    public function getSpares()
    {
        return $this->spares;
    }

    public function setSpares($sparesIds)
    {
        return $this->spares()->sync($sparesIds);
    }

    public function addSpare($spareId)
    {
        return $this->spares()->attach($spareId);
    }

    public function removeSpare($spareId)
    {
        return $this->spares()->detach($spareId);
    }

    /**
     * @return mixed
     */
    public function spares()
    {
        return $this->belongsToMany('App\Models\Spare')->withPivot('id');
    }
}
