<?php

namespace App\Models\Database;

use App\Models\Database;

class Year extends Database
{
    public function getNameWithDetails()
    {
        if($this->getName()) {
            return $this->getName() . ' г.';
        }
    }
}
