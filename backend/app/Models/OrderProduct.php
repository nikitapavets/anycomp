<?php

namespace App\Models;

use App\Models\Catalog\Notebook;
use App\Models\Catalog\Tv;
use App\Traits\Relations\BelongTo\OrderTrait;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use OrderTrait;

    public function getProductType()
    {
        return $this->product_type;
    }

    public function setProductType($productType)
    {
        $this->product_type = $productType;
    }

    public function setProduct($productId)
    {
        switch ($this->getProductType()) {
            case Notebook::ORDER_TYPE: {
                $notebook = Notebook::find($productId);
                $this->notebook()->associate($notebook);
                break;
            }
            case Tv::ORDER_TYPE: {
                $tv = Tv::find($productId);
                $this->tv()->associate($tv);
                break;
            }
        }
    }

    private function tv()
    {
        return $this->belongsTo('App\Models\Catalog\Tv', 'product_id');
    }

    private function notebook()
    {
        return $this->belongsTo('App\Models\Catalog\Notebook', 'product_id');
    }
}
