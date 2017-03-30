<?php

namespace App\Traits\Relations\BelongToMany;

use App\Models\Database\HddType;
use App\Models\Database;

trait HddTypesTrait
{
    /**
     * @return string
     */
    public function getHddTypesLikeString()
    {
        $hddTypesArray = [];
        foreach ($this->getHddTypes() as $hddType) {
            $hddTypesArray[] = $hddType->getName();
        }

        return implode(', ', $hddTypesArray);
    }

    /**
     * @return HddType[]
     */
    public function getHddTypes()
    {
        return $this->hddTypes;
    }

    /**
     * @param string $hddTypesIdsString
     */
    public function setHddTypes($hddTypesIdsString)
    {
        $hddTypesIdsArray = $hddTypesIdsString
            ? explode(',', $hddTypesIdsString)
            : array(Database::NO_SELECTED);
        $this->hddTypes()->sync($hddTypesIdsArray);
    }

    /**
     * @return mixed
     */
    public function hddTypes()
    {
        return $this->belongsToMany('App\Models\Database\HddType');
    }
}
