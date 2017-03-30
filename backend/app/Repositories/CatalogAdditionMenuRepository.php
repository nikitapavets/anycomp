<?php

namespace App\Repositories;

use App\Models\MenuConstructor\CatalogAdditionMenu;

class CatalogAdditionMenuRepository
{
    /**
     * @return CatalogAdditionMenu[]
     */
    public static function getCatalogAdditionMenus()
    {
        return CatalogAdditionMenu::orderBy('priority')->get();
    }

    /**
     * @param string $ids
     * @param string $delimiter
     */
    public static function unsetDb($ids, $delimiter = ',')
    {
        $arrayIds = explode($delimiter, $ids);

        foreach ($arrayIds as $id) {
            CatalogAdditionMenu::getById($id)->delete();
        }
    }
}