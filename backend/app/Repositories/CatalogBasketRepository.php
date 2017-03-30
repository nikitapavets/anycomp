<?php

namespace App\Repositories;

use App\Models\CatalogBasket;
use App\Models\Database\Category;
use App\Models\Users\UniqueUser;

class CatalogBasketRepository
{
    /**
     * @param int $id
     * @return CatalogBasket
     */
    public static function getById($id)
    {
        return CatalogBasket::where('id', '=', $id)->first();
    }

    /**
     * @return CatalogBasket[]
     */
    public static function getAll()
    {
        return CatalogBasket::withTrashed()
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * @param int $id
     */
    public static function unsetById($id)
    {
        self::getById($id)->delete();
    }

    /**
     * @param string $ids
     * @param string $delimiter
     */
    public static function unsetByIds($ids, $delimiter = ',')
    {
        $arrayIds = explode($delimiter, $ids);
        foreach ($arrayIds as $id) {
            self::unsetById($id);
        }
    }

    /**
     * @param UniqueUser $uniqueUser
     * @param Category $category
     * @param $product
     * @return CatalogBasket
     */
    public static function store($uniqueUser, $category, $product)
    {
        $catalogBasket = new CatalogBasket();
        $catalogBasket->setUniqueUser($uniqueUser);
        $catalogBasket->setCategory($category);
        $catalogBasket->setTv($product);
        $catalogBasket->save();

        return $catalogBasket;
    }
}