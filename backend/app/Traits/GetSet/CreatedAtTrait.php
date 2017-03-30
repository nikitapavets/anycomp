<?php

namespace App\Traits\GetSet;

use Carbon\Carbon;

trait CreatedAtTrait
{
    /**
     * @return string
     */
    public function getCreatedAt()
    {
        $time = Carbon::parse($this->created_at);

        return date('d-m-Y', $time->timestamp);
    }

}
