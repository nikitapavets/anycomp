<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    const PRODUCT_TYPE_TV = 1;
    const PRODUCT_TYPE_NOTEBOOK = 2;

    const IMAGE_SIZE_SMALL = 1;
    const IMAGE_SIZE_BIG = 2;

    protected $guarded = [];

    public function setProductId($id)
    {
        $this->product_id = $id;
    }

    public function setProductType($type)
    {
        $this->product_type = $type;
    }

    public function setLink($link)
    {
        $this->path = $link;
    }

    public function getLink()
    {
        return $this->path;
    }

    public function isGeneral()
    {
        $this->is_general;
    }

    public function setIsGeneral($isGeneral)
    {
        $this->is_general = $isGeneral ? 1 : 0;
    }

    public function scopeOfProduct($query, $productId, $productType, $isGeneralImage)
    {
        return $query->where('product_id', $productId)
            ->where('product_type', $productType)
            ->where('is_general', $isGeneralImage ? 1 : 0);
    }
}
