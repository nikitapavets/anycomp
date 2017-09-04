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
     * @param $deliveryId
     */
    public function setDelivery($deliveryId)
    {
        $this->delivery()->associate(Delivery::findOrFail($deliveryId));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function delivery()
    {
        return $this->belongsTo('App\Models\Delivery');
    }
}
