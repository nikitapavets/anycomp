<?php

namespace App\Models;

use App\Interfaces\GeneralMobel;
use App\Repositories\SpareRepository;
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

    protected $guarded = [];
    protected $appends = ['full_name'];

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
            return sprintf('%s (%s)',
                $name,
                $this->getSerialNumber());
        }
        return $name;
    }

    public function getFullNameAttribute()
    {
        return $this->getFullName();
    }
}