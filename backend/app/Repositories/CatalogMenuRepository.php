<?php

namespace App\Repositories;

use App\Models\MenuConstructor\CatalogMenu;

class CatalogMenuRepository
{
	/**
	 * @return CatalogMenu[]
	 */
	public static function getCatalogMenus() {

		return CatalogMenu::orderBy('priority')->get();
	}

	/**
	 * @param string $ids
	 * @param string $delimiter
	 */
	public static function unsetDb($ids, $delimiter = ',') {

		$arrayIds = explode($delimiter, $ids);

		foreach ($arrayIds as $id) {
			CatalogMenu::getById($id)->delete();
		}
	}

	/**
	 * @return array
	 */
	public static function makeCatalogMenu() {

		$menu = [];
		foreach (CatalogMenuRepository::getCatalogMenus() as $catalogMenu) {
			$subMenu = array();
			foreach ($catalogMenu->getCatalogSubMenus() as $catalogSubMenu) {
				$additionMenu = array();
				foreach ($catalogSubMenu->getCatalogAdditionMenus() as $catalogAdditionMenu){
					$additionMenu[] = array(
						'value' => $catalogAdditionMenu->getName(),
						'link' => $catalogAdditionMenu->getLink(),
					);
				}
				$subMenu[] = array(
					'value' => $catalogSubMenu->getName(),
					'link' => $catalogSubMenu->getLink(),
					'menuItems' => $additionMenu
				);
			}
			$menu[] = array(
				'value' => $catalogMenu->getName(),
				'menuItems' => $subMenu
			);
		}
		return $menu;
	}
}