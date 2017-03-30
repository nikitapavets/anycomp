<?php

namespace App\Models\Database;

use App\Models\Database;

class Organization extends Database
{
	/**
	 * @return bool
	 */
	public function isOrganization() {

		return $this->getId() != self::NO_SELECTED;
	}

	/**
	 * @param bool $details
	 * @return string
	 */
	public function getName($details = false)
	{
		if($this->isOrganization()) {
			return parent::getName();
		} else {
			return $details ? 'Нет организации' : '';
		}
	}
}
