<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\Brand;

trait BrandTrait
{
    /**
     * @return Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param int $brandId
     * @param string $newBrandName
     */
    public function setBrand($brandId, $newBrandName = '')
    {
        $brand = $newBrandName
            ? Brand::firstOrCreate(['name' => $newBrandName])
            : Brand::find($brandId);
        $this->brand()->associate($brand);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo('App\Models\Database\Brand');
    }
}
