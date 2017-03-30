<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\ScreenType;

trait ScreenTypeTrait
{
    /**
     * @return ScreenType
     */
    public function getScreenType()
    {
        return $this->screenType;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function screenType()
    {
        return $this->belongsTo('App\Models\Database\ScreenType');
    }

    /**
     * @param int $screenTypeId
     * @param string $newScreenType
     */
    public function setScreenType($screenTypeId, $newScreenType = '')
    {
        $screenType = $newScreenType
            ? ScreenType::firstOrCreate(['name' => $newScreenType])
            : ScreenType::find($screenTypeId);
        $this->screenType()->associate($screenType);
    }
}
