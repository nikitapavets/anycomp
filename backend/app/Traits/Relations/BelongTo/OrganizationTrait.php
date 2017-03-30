<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\Organization;

trait OrganizationTrait
{
    /**
     * @return Organization
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * @param int $organizationId
     * @param string $newOrganizationId
     */
    public function setOrganization($organizationId, $newOrganizationId = '')
    {
        $organization = $newOrganizationId
            ? Organization::firstOrCreate(['name' => $newOrganizationId])
            : Organization::find($organizationId);
        $this->organization()->associate($organization);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo('App\Models\Database\Organization');
    }


}
