<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\ComputerType;

trait ComputerTypeTrait
{
    /**
     * @return ComputerType
     */
    public function getComputerType()
    {
        return $this->computerType;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function computerType()
    {
        return $this->belongsTo('App\Models\Database\ComputerType');
    }

    /**
     * @param int $computerTypeId
     * @param string $newComputerType
     */
    public function setComputerType($computerTypeId, $newComputerType = '')
    {
        $computerType = $newComputerType ? ComputerType::firstOrCreate(
            ['name' => $newComputerType]
        ) : ComputerType::find($computerTypeId);
        $this->computerType()->associate($computerType);
    }
}
