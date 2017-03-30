<?php

namespace App\Traits\Relations\BelongToMany;

use App\Models\Database\TvTuner;
use App\Models\Database;

trait TvTunersTrait
{
    /**
     * @return string
     */
    public function getTvTunersLikeString()
    {
        $tvTunersArray = [];
        foreach ($this->getTvTuners() as $tvTuner) {
            $tvTunersArray[] = $tvTuner->getName();
        }

        return implode(', ', $tvTunersArray);
    }

    /**
     * @return TvTuner[]
     */
    public function getTvTuners()
    {
        return $this->tvTuners;
    }

    /**
     * @param string $tvTunersIdsString
     */
    public function setTvTuners($tvTunersIdsString)
    {
        $tvTunersIdsArray = $tvTunersIdsString
            ? explode(',', $tvTunersIdsString)
            : array(Database::NO_SELECTED);
        $this->tvTuners()->sync($tvTunersIdsArray);
    }

    /**
     * @return mixed
     */
    public function tvTuners()
    {
        return $this->belongsToMany('App\Models\Database\TvTuner');
    }
}
