<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\GraphicCard;

trait GraphicCardTrait
{
    /**
     * @return GraphicCard
     */
    public function getGraphicCard()
    {
        return $this->graphicCard;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function graphicCard()
    {
        return $this->belongsTo('App\Models\Database\GraphicCard');
    }

    /**
     * @param int $graphicCardId
     * @param string $newGraphicCard
     */
    public function setGraphicCard($graphicCardId, $newGraphicCard = '')
    {
        $graphicCard = $newGraphicCard
            ? GraphicCard::firstOrCreate(['name' => $newGraphicCard])
            : GraphicCard::find($graphicCardId);
        $this->graphicCard()->associate($graphicCard);
    }
}
