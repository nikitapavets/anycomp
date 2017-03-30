<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\Color;

trait ColorBorderTrait
{
    /**
     * @return Color
     */
    public function getColorBorder()
    {
        return $this->colorBorder;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function colorBorder()
    {
        return $this->belongsTo('App\Models\Database\Color', 'color_border_id');
    }

    /**
     * @param int $colorId
     * @param string $newColor
     */
    public function setColorBorder($colorId, $newColor = '')
    {
        $color = $newColor
            ? Color::firstOrCreate(['name' => $newColor])
            : Color::find($colorId);
        $this->colorBorder()->associate($color);
    }
}
