<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\ScreenAspectRatio;

trait ScreenAspectRatioTrait
{
    /**
     * @return ScreenAspectRatio
     */
    public function getScreenAspectRatio()
    {
        return $this->screenAspectRation;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function screenAspectRation()
    {
        return $this->belongsTo('App\Models\Database\ScreenAspectRatio', 'screen_aspect_ratio_id');
    }

    /**
     * @param int $screenAspectRatioId
     * @param string $newScreenAspectRatio
     */
    public function setScreenAspectRation($screenAspectRatioId, $newScreenAspectRatio = '')
    {
        $screenAspectRatio = $newScreenAspectRatio
            ? ScreenAspectRatio::firstOrCreate(['name' => $newScreenAspectRatio])
            : ScreenAspectRatio::find($screenAspectRatioId);
        $this->screenAspectRation()->associate($screenAspectRatio);
    }
}
