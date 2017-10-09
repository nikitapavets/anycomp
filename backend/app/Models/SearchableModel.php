<?php

namespace App\Models;

use App\Search\Searchable;
use Illuminate\Database\Eloquent\Model;

class SearchableModel extends Model
{
    const SEARCH = [];

    use Searchable;
}
