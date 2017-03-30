<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\Color;

trait ColorRoofTrait
{
    /**
     * @return Color
     */
    public function getColorRoof()
    {
        return $this->colorRoof;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function colorRoof()
    {
        return $this->belongsTo('App\Models\Database\Color', 'color_roof_id');
    }

    /**
     * @param int $colorId
     * @param string $newColor
     */
    public function setColorRoof($colorId, $newColor = '')
    {
        $color = $newColor
            ? Color::firstOrCreate(['name' => $newColor])
            : Color::find($colorId);
        $this->colorRoof()->associate($color);
    }
}
