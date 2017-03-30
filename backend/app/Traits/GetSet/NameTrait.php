<?php

namespace App\Traits\GetSet;

trait NameTrait
{
	/**
	 * @return string
	 */
	public function getName() {

		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {

		$this->name = $name;
	}
}
