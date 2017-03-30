<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\CursorControlType;

trait CursorControlTypeTrait
{
    /**
     * @return CursorControlType
     */
    public function getCursorControlType()
    {
        return $this->CursorControlType;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cursorControlType()
    {
        return $this->belongsTo('App\Models\Database\CursorControlType');
    }

    /**
     * @param int $cursorControlTypeId
     * @param string $newCursorControlType
     */
    public function setCursorControlType($cursorControlTypeId, $newCursorControlType = '')
    {
        $cursorControlType = $newCursorControlType
            ? CursorControlType::firstOrCreate(['name' => $newCursorControlType])
            : CursorControlType::find($cursorControlTypeId);
        $this->cursorControlType()->associate($cursorControlType);
    }
}
