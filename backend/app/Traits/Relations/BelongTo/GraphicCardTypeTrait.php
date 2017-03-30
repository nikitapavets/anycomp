<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\GraphicCardType;

trait GraphicCardTypeTrait
{
    /**
     * @return GraphicCardType
     */
    public function getGraphicCardType()
    {
        return $this->graphicCardType;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function graphicCardType()
    {
        return $this->belongsTo('App\Models\Database\GraphicCardType');
    }

    /**
     * @param int $graphicCardTypeId
     * @param string $newGraphicCardType
     */
    public function setGraphicCardType($graphicCardTypeId, $newGraphicCardType = '')
    {
        $graphicCardType = $newGraphicCardType
            ? GraphicCardType::firstOrCreate(['name' => $newGraphicCardType])
            : GraphicCardType::find($graphicCardTypeId);
        $this->graphicCardType()->associate($graphicCardType);
    }
}
