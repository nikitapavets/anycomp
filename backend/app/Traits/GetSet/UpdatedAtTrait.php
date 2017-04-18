<?php

namespace App\Traits\GetSet;

use Carbon\Carbon;

trait UpdatedAtTrait
{
    public function getUpdatedAt($isSource = false)
    {
        if ($isSource) {
            return $this->updated_at;
        }
        $time = Carbon::parse($this->updated_at);

        return date('d-m-Y', $time->timestamp);
    }
}
