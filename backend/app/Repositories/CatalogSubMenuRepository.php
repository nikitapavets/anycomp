<?php

namespace App\Repositories;

use App\Models\MenuConstructor\CatalogSubMenu;

class CatalogSubMenuRepository
{
	/**
	 * @return CatalogSubMenu[]
	 */
	public static function getCatalogSubMenus() {

		return CatalogSubMenu::orderBy('priority')->get();
	}

	/**
	 * @param string $ids
	 * @param string $delimiter
	 */
	public static function unsetDb($ids, $delimiter = ',') {

		$arrayIds = explode($delimiter, $ids);

		foreach ($arrayIds as $id) {
			CatalogSubMenu::getById($id)->delete();
		}
	}
}