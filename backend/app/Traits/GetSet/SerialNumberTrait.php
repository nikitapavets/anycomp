<?php

namespace App\Traits\GetSet;

trait SerialNumberTrait
{
	public function getSerialNumber() {

		return $this->serial_number;
	}

	public function setSerialNumber($serialNumber) {

		$this->serial_number = $serialNumber;
	}
}
