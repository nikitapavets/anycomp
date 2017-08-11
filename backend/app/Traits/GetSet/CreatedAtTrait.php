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

        return date('d.m.Y', $time->timestamp);
    }


    public function getCreatedAtForInput()
    {
        return Carbon::parse($this->created_at);
    }

    /**
     * @return string
     */
    public function getCreatedAtFull()
    {
        $time = Carbon::parse($this->created_at);

        return date('d.m.Y H:i', $time->timestamp);
    }

    /**
     * @return string
     */
    public function getCreatedAtDay()
    {
        $time = Carbon::parse($this->created_at);

        return date('d', $time->timestamp);
    }

    /**
     * @return string
     */
    public function getCreatedAtMonth()
    {
        $time = Carbon::parse($this->created_at);

        return date('m', $time->timestamp);
    }

    /**
     * @return string
     */
    public function getCreatedAtYear()
    {
        $time = Carbon::parse($this->created_at);

        return date('Y', $time->timestamp);
    }

}
