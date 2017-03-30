<?php

namespace App\Traits\Relations\HasMany;

use App\Models\CatalogBasket;

trait CatalogBasketTrait
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function baskets()
    {
        return $this->hasMany('App\Models\CatalogBasket');
    }

    /**
     * @return CatalogBasket[]
     */
    public function getCatalogBaskets()
    {

        return $this->baskets;
    }
}
