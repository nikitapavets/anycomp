<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\ScreenSurface;

trait ScreenSurfaceTrait
{
    /**
     * @return ScreenSurface
     */
    public function getScreenSurface()
    {
        return $this->screenSurface;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function screenSurface()
    {
        return $this->belongsTo('App\Models\Database\ScreenSurface');
    }

    /**
     * @param int $screenSurfaceId
     * @param string $newScreenSurface
     */
    public function setScreenSurface($screenSurfaceId, $newScreenSurface = '')
    {
        $screenSurface = $newScreenSurface
            ? ScreenSurface::firstOrCreate(['name' => $newScreenSurface])
            : ScreenSurface::find($screenSurfaceId);
        $this->screenSurface()->associate($screenSurface);
    }
}
