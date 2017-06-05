<?php

namespace App\Traits\Relations\HasMany;

use App\Models\Repair;

trait RepairsTrait
{
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function repairs()
	{
		return $this->hasMany('App\Models\Repair');
	}

	/**
	 * @return Repair[]
	 */
	public function getRepairs() {

		return $this->repairs;
	}
}
