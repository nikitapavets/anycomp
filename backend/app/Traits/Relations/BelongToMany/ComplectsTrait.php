<?php

namespace App\Traits\Relations\BelongToMany;

use App\Models\Database\Complect;
use App\Models\Database;

trait ComplectsTrait
{
    /**
     * @return string
     */
    public function getComplectsLikeString()
    {
        $complectsArray = [];
        foreach ($this->getComplects() as $complect) {
            $complectsArray[] = $complect->getName();
        }

        return implode(', ', $complectsArray);
    }

    /**
     * @return Complect[]
     */
    public function getComplects()
    {
        return $this->complects;
    }

    /**
     * @param string $complectsIdsString
     */
    public function setComplects($complectsIdsString)
    {
        $complectsIdsArray = $complectsIdsString
            ? explode(',', $complectsIdsString)
            : array(Database::NO_SELECTED);
        $this->complects()->sync($complectsIdsArray);
    }

    /**
     * @return mixed
     */
    public function complects()
    {
        return $this->belongsToMany('App\Models\Database\Complect');
    }
}
