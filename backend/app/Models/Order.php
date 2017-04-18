<?php

namespace App\Models;

use App\Traits\GetSet\CreatedAtTrait;
use App\Traits\GetSet\IdTrait;
use App\Traits\GetSet\UpdatedAtTrait;
use App\Traits\Relations\BelongTo\ClientTrait;
use App\Traits\Relations\HasMany\OrderProductsTrait;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use IdTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;
    use ClientTrait;
    use OrderProductsTrait;
}
