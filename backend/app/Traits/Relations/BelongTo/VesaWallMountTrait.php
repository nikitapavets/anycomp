<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\VesaWallMount;

trait VesaWallMountTrait
{
    /**
     * @return VesaWallMount
     */
    public function getVesaWallMount()
    {
        return $this->vesaWallMount;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vesaWallMount()
    {
        return $this->belongsTo('App\Models\Database\VesaWallMount');
    }

    /**
     * @param int $vesaWallMountId
     * @param string $newVesaWallMount
     */
    public function setVesaWallMount($vesaWallMountId, $newVesaWallMount = '')
    {
        $vesaWallMount = $newVesaWallMount
            ? VesaWallMount::firstOrCreate(['name' => $newVesaWallMount])
            : VesaWallMount::find($vesaWallMountId);
        $this->vesaWallMount()->associate($vesaWallMount);
    }
}
