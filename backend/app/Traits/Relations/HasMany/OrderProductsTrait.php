<?php

namespace App\Traits\Relations\HasMany;

use App\Models\OrderProduct;

trait OrderProductsTrait
{
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function orderProducts()
	{
		return $this->hasMany('App\Models\OrderProduct');
	}

	/**
	 * @return OrderProduct[]
	 */
	public function getOrderProducts() {

		return $this->orderProducts;
	}
}
