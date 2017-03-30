<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\Material;

trait MaterialBodyTrait
{
    /**
     * @return Material
     */
    public function getMaterialBody()
    {
        return $this->materialBody;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function materialBody()
    {
        return $this->belongsTo('App\Models\Database\Material', 'material_body_id');
    }

    /**
     * @param int $materialId
     * @param string $newMaterial
     */
    public function setMaterialBody($materialId, $newMaterial = '')
    {
        $material = $newMaterial
            ? Material::firstOrCreate(['name' => $newMaterial])
            : Material::find($materialId);
        $this->materialBody()->associate($material);
    }
}
