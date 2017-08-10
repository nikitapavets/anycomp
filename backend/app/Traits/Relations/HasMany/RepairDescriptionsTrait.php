<?php

namespace App\Traits\Relations\HasMany;

use App\Models\Repair\RepairDescription;

trait RepairDescriptionsTrait
{
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function repairDescriptions()
	{
		return $this->hasMany('App\Models\Repair\RepairDescription');
	}

	/**
	 * @return RepairDescription[]
	 */
	public function getRepairDescriptions() {

		return $this->repairDescriptions;
	}
}
