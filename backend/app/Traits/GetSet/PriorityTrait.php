<?php

namespace App\Traits\GetSet;

trait PriorityTrait
{
	/**
	 * @return double
	 */
	public function getPriority() {

		return $this->priority;
	}

	/**
	 * @param double $priority
	 */
	public function setPriority($priority) {

		$this->priority = $priority;
	}
}
