<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Delivery;

trait DeliveryTrait
{
    /**
     * @return Delivery
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * @param Delivery $delivery
     */
    public function setDelivery(Delivery $delivery)
    {
        $this->delivery()->associate($delivery);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function delivery()
    {
        return $this->belongsTo('App\Models\Delivery');
    }
}
