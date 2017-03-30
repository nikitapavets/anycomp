<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\Material;

trait MaterialRoofTrait
{
    /**
     * @return Material
     */
    public function getMaterialRoof()
    {
        return $this->materialRoof;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function materialRoof()
    {
        return $this->belongsTo('App\Models\Database\Material', 'material_roof_id');
    }

    /**
     * @param int $materialId
     * @param string $newMaterial
     */
    public function setMaterialRoof($materialId, $newMaterial = '')
    {
        $material = $newMaterial
            ? Material::firstOrCreate(['name' => $newMaterial])
            : Material::find($materialId);
        $this->materialRoof()->associate($material);
    }
}
