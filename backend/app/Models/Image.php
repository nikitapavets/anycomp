<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    const PRODUCT_TYPE_TV = 1;
    const PRODUCT_TYPE_NOTEBOOK = 2;

    public static function storeDb($productId, $productType, $link, $id = null)
    {
        $item = $id ? self::getById($id) : new self;
        $item->setProductId($productId);
        $item->setProductType($productType);
        $item->setLink($link);
        $id ? $item->update() : $item->save();
    }

    /**
     * @param $id
     * @return self
     */
    public static function getById($id)
    {
        return self::find($id);
    }

    /**
     * @param int $id
     */
    public function setProductId($id)
    {
        $this->product_id = $id;
    }

    /**
     * @param int $type
     */
    public function setProductType($type)
    {
        $this->product_type = $type;
    }

    /**
     * @param string $link
     */
    public function setLink($link)
    {
        $this->path = $link;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->path;
    }

    public function scopeOfProduct($query, $productId, $productType)
    {
        return $query->where('product_id', $productId)
            ->where('product_type', $productType);
    }
}
