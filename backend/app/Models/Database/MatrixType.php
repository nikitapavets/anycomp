<?php

namespace App\Models\Database;

use App\Models\Database;

class MatrixType extends Database
{
    public function getNameWithDetails()
    {
        if($this->getName()) {
            return 'матрица '.$this->getName();
        }
    }
}
