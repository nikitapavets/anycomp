<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\MenuConstructor\CatalogSubMenu;

trait CatalogSubMenuTrait
{
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function catalog_sub_menu() {

		return $this->belongsTo('App\Models\MenuConstructor\CatalogSubMenu');
	}

	/**
	 * @return CatalogSubMenu
	 */
	public function getCatalogSubMenu() {

		return $this->catalog_sub_menu;
	}
}
