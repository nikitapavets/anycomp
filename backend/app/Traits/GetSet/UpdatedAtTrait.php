<?php

namespace App\Traits\GetSet;

use Carbon\Carbon;

trait UpdatedAtTrait
{
    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        $time = Carbon::parse($this->updated_at);

        return date('d-m-Y', $time->timestamp);
    }
}
