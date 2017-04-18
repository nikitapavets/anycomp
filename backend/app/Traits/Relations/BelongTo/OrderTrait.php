<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Order;

trait OrderTrait
{
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function order() {

		return $this->belongsTo('App\Models\Order');
	}

	/**
	 * @return Order
	 */
	public function getOrder() {

		return $this->order;
	}

    public function setOrder(Order $order)
    {
        $this->order()->associate($order);
    }
}
