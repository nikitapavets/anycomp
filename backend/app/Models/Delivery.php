<?php

namespace App\Models;

use App\Interfaces\GeneralMobel;
use App\Repositories\DeliveryRepository;
use App\Traits\GetSet\CreatedAtTrait;
use App\Traits\GetSet\IdTrait;
use App\Traits\Relations\BelongTo\WorkerTrait;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model implements GeneralMobel
{
    use IdTrait;
    use CreatedAtTrait;
    use WorkerTrait;

    protected $guarded = [];

    public function getLink()
    {
        return sprintf("%s/%s", DeliveryRepository::getLink(), $this->getId());
    }

    public function getName()
    {
        return $this->getCreatedAt();
    }
}
