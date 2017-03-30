<?php

namespace App\Traits\Relations\HasMany;

use App\Models\MenuConstructor\CatalogSubMenu;

trait CatalogSubMenusTrait
{
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function catalog_sub_menus()
	{
		return $this->hasMany('App\Models\MenuConstructor\CatalogSubMenu');
	}

	/**
	 * @return CatalogSubMenu[]
	 */
	public function getCatalogSubMenus() {

		return $this->catalog_sub_menus;
	}
}
