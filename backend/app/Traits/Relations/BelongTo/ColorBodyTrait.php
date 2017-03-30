<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\Color;

trait ColorBodyTrait
{
    /**
     * @return Color
     */
    public function getColorBody()
    {
        return $this->colorBody;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function colorBody()
    {
        return $this->belongsTo('App\Models\Database\Color', 'color_body_id');
    }

    /**
     * @param int $colorId
     * @param string $newColor
     */
    public function setColorBody($colorId, $newColor = '')
    {
        $color = $newColor
            ? Color::firstOrCreate(['name' => $newColor])
            : Color::find($colorId);
        $this->colorBody()->associate($color);
    }
}
