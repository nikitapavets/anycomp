<?php

namespace App\Models\Repair;

use App\Traits\GetSet\CreatedAtTrait;
use App\Traits\GetSet\IdTrait;
use App\Traits\GetSet\PriceTrait;
use App\Traits\Relations\BelongTo\RepairTrait;
use Illuminate\Database\Eloquent\Model;

class RepairDescription extends Model
{
    use IdTrait;
    use CreatedAtTrait;
    use PriceTrait;
    use RepairTrait;

    protected $guarded = [];

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }
}
