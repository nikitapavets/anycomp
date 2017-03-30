<?php

namespace App\Traits\GetSet;

trait LinkTrait
{
	/**
	 * @return string
	 */
	public function getLink() {

		return $this->link;
	}

	/**
	 * @param string $link
	 */
	public function setLink($link) {

		$this->link = $link;
	}


}
