<?php

namespace App\Traits\Relations\HasMany;

use App\Models\Spare;

trait SparesTrait
{
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function spares()
	{
		return $this->hasMany('App\Models\Spare');
	}

	/**
	 * @return Spare[]
	 */
	public function getSpares() {

		return $this->spares;
	}
}
