<?php

namespace App\Models;

use App\Traits\GetSet\CreatedAtTrait;
use App\Traits\GetSet\DeletedAtTrait;
use App\Traits\GetSet\IdTrait;
use App\Traits\Relations\BelongTo\CategoryTrait;
use App\Traits\Relations\BelongTo\TvTrait;
use App\Traits\Relations\BelongTo\UniqueUserTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatalogBasket extends Model
{
    use SoftDeletes;

	use IdTrait;
	use UniqueUserTrait;
	use CategoryTrait;
	use TvTrait;
	use CreatedAtTrait;
	use DeletedAtTrait;

    protected $dates = ['deleted_at'];
}
