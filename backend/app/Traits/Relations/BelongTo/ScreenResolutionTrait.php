<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\ScreenResolution;

trait ScreenResolutionTrait
{
    /**
     * @return ScreenResolution
     */
    public function getScreenResolution()
    {
        return $this->screenResolution;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function screenResolution()
    {
        return $this->belongsTo('App\Models\Database\ScreenResolution');
    }

    /**
     * @param int $screenResolutionId
     * @param string $newScreenResolution
     */
    public function setScreenResolution($screenResolutionId, $newScreenResolution = '')
    {
        $screenResolution = $newScreenResolution
            ? ScreenResolution::firstOrCreate(['name' => $newScreenResolution])
            : ScreenResolution::find($screenResolutionId);
        $this->screenResolution()->associate($screenResolution);
    }
}
