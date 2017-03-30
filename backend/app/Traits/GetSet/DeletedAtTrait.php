<?php

namespace App\Traits\GetSet;

trait DeletedAtTrait
{
    /**
     * @return string
     */
    public function getDeteledAt() {

        return $this->deleted_at;
    }

}
