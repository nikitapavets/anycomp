<?php

namespace App\Models;

use App\Interfaces\GeneralMobel;
use App\Repositories\SpareRepository;
use App\Traits\GetSet\ConfigTrait;
use App\Traits\GetSet\CreatedAtTrait;
use App\Traits\GetSet\IdTrait;
use App\Traits\GetSet\NameTrait;
use App\Traits\GetSet\PriceTrait;
use App\Traits\GetSet\QuantityTrait;
use App\Traits\GetSet\SerialNumberTrait;
use App\Traits\Relations\BelongTo\BrandTrait;
use App\Traits\Relations\BelongTo\CategoryTrait;
use App\Traits\Relations\BelongTo\DeliveryTrait;
use App\Traits\Relations\BelongTo\OrganizationTrait;
use Illuminate\Database\Eloquent\Model;

class Spare extends Model implements GeneralMobel
{
    use IdTrait;
    use CreatedAtTrait;
    use OrganizationTrait;
    use DeliveryTrait;
    use QuantityTrait;
    use PriceTrait;
    use NameTrait;
    use SerialNumberTrait;
    use CategoryTrait;
    use BrandTrait;
    use ConfigTrait;

    protected $guarded = [
        'delivery_id',
        'organization_id',
        'category_id',
        'brand_id',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'serial_number',
        'quantity',
        'price',
        'owner_number',
        'config',
    ];

    protected $hidden = [
        'delivery_id',
        'organization_id',
        'category_id',
        'brand_id',
        'updated_at',
    ];

    protected $appends = [
        'full_name'
    ];

    /**-------- Relations --------*/

    public function repairs()
    {
        return $this->belongsToMany('App\Models\Repair')->withPivot('id');
    }

    /**-------- Customs --------*/

    /**
     * @return Repair []
     */
    public function getRepairs() {
        return $this->repairs;
    }

    public function getLink()
    {
        return sprintf("%s/%s", SpareRepository::getLink(), $this->getId());
    }

    public function getFullName()
    {
        $name = sprintf('%s %s %s',
            $this->getCategory()->getName(),
            $this->getBrand()->getName(),
            $this->getName());

        if($this->getSerialNumber()) {
            $name = sprintf('%s (%s)',
                $name,
                $this->getSerialNumber());
        }

        $name = sprintf('%s %s',
            $name,
            $this->getConfig());

        if($this->getOwnerNumber()) {
            $name = sprintf('%s #%s',
                $name,
                $this->getOwnerNumber());
        }

        return $name;
    }

    public function getFullNameAttribute()
    {
        return $this->getFullName();
    }

    public function getOwnerNumber()
    {
        return $this->owner_number;
    }

    public function hasInStock()
    {
        $repairsWithThisSpareCount = count($this->getRepairs());
        $realQuantityInStock = $this->getQuantity() - $repairsWithThisSpareCount;

        return !!$realQuantityInStock;
    }
}
