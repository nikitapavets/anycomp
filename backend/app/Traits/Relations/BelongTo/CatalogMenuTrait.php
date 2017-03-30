<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\MenuConstructor\CatalogMenu;

trait CatalogMenuTrait
{
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function catalog_menu() {

		return $this->belongsTo('App\Models\MenuConstructor\CatalogMenu');
	}

	/**
	 * @return CatalogMenu
	 */
	public function getCatalogMenu() {

		return $this->catalog_menu;
	}
}
