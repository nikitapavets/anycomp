<?php

namespace App\Models;

use App\Traits\Relations\BelongTo\ClientTrait;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use ClientTrait;
}
