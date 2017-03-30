<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\MatrixType;

trait MatrixTypeTrait
{
    /**
     * @return MatrixType
     */
    public function getMatrixType()
    {
        return $this->matrixType;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function matrixType()
    {
        return $this->belongsTo('App\Models\Database\MatrixType', 'matrix_type_id');
    }

    /**
     * @param int $matrixTypeId
     * @param string $newMatrixType
     */
    public function setMatrixType($matrixTypeId, $newMatrixType = '')
    {
        $matrixType = $newMatrixType
            ? MatrixType::firstOrCreate(['name' => $newMatrixType])
            : MatrixType::find($matrixTypeId);
        $this->matrixType()->associate($matrixType);
    }
}
