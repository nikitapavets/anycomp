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

    protected $guarded = [];

    public function getLink()
    {
        return sprintf("%s/%s", SpareRepository::getLink(), $this->getId());
    }

    public function getFullName()
    {
        if($this->getSerialNumber()) {
            return sprintf('%s (%s)', $this->getName(), $this->getSerialNumber());
        }
        return $this->getName();
    }
}
