<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Catalog\Tv;

trait TvTrait
{
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function tv() {

		return $this->belongsTo('App\Models\Catalog\Tv');
	}

	/**
	 * @return Tv
	 */
	public function getTv() {

		return $this->tv;
	}

    /**
     * @param Tv $tv
     */
    public function setTv($tv)
    {
        $this->tv()->associate($tv);
    }
}
