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
     * @param string $newOrganization
     */
    public function setOrganization($organizationId, $newOrganization = '')
    {
        $organization = $newOrganization
            ? Organization::firstOrCreate(['name' => $newOrganization])
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
