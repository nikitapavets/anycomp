<?php

namespace App\Models\Database;

use App\Models\Database;

class StorageSize extends Database
{
    public function getNameWithDetails()
    {
        if($this->getName()) {
            return $this->getName() . ' Гб';
        }
    }
}
