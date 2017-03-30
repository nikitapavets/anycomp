<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Users\UniqueUser;

trait UniqueUserTrait
{
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function uniqueUser()
    {
		return $this->belongsTo('App\Models\Users\UniqueUser');
	}

	/**
	 * @return UniqueUser
	 */
	public function getUniqueUser()
    {
		return $this->uniqueUser;
	}

    /**
     * @param UniqueUser $uniqueUser
     */
	public function setUniqueUser($uniqueUser)
    {
        $this->uniqueUser()->associate($uniqueUser);
    }
}
