<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\ScreenDiagonal;

trait ScreenDiagonalTrait
{
    /**
     * @return ScreenDiagonal
     */
    public function getScreenDiagonal()
    {
        return $this->screenDiagonal;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function screenDiagonal()
    {
        return $this->belongsTo('App\Models\Database\ScreenDiagonal');
    }

    /**
     * @param int $screenDiagonalId
     * @param string $newScreenDiagonal
     */
    public function setScreenDiagonal($screenDiagonalId, $newScreenDiagonal = '')
    {
        $screenDiagonal = $newScreenDiagonal
            ? ScreenDiagonal::firstOrCreate(['name' => $newScreenDiagonal])
            : ScreenDiagonal::find($screenDiagonalId);
        $this->screenDiagonal()->associate($screenDiagonal);
    }
}
