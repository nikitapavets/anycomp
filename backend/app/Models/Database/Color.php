<?php

namespace App\Models\Database;

use App\Models\Database;

class Color extends Database
{
    public function getNameWithDetails($details)
    {
        return $details.' '.$this->getName();
    }
}
