<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\Year;

trait YearTrait
{
    /**
     * @return Year
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function year()
    {
        return $this->belongsTo('App\Models\Database\Year');
    }

    /**
     * @param int $yearId
     * @param string $newYear
     */
    public function setYear($yearId, $newYear = '')
    {
        $year = $newYear
            ? Year::firstOrCreate(['name' => $newYear])
            : Year::find($yearId);
        $this->year()->associate($year);
    }
}
