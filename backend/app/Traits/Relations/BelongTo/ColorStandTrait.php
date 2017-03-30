<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\Color;

trait ColorStandTrait
{
    /**
     * @return Color
     */
    public function getColorStand()
    {
        return $this->colorStand;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function colorStand()
    {
        return $this->belongsTo('App\Models\Database\Color', 'color_stand_id');
    }

    /**
     * @param int $colorId
     * @param string $newColor
     */
    public function setColorStand($colorId, $newColor = '')
    {
        $color = $newColor
            ? Color::firstOrCreate(['name' => $newColor])
            : Color::find($colorId);
        $this->colorStand()->associate($color);
    }
}
