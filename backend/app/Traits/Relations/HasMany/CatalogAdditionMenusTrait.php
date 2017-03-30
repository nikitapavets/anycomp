<?php

namespace App\Traits\Relations\HasMany;

use App\Models\MenuConstructor\CatalogAdditionMenu;

trait CatalogAdditionMenusTrait
{
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function catalog_addition_menus()
	{
		return $this->hasMany('App\Models\MenuConstructor\CatalogAdditionMenu');
	}

	/**
	 * @return CatalogAdditionMenu[]
	 */
	public function getCatalogAdditionMenus() {

		return $this->catalog_addition_menus;
	}
}
