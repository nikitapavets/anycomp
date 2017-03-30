<?php

namespace App\Traits\Relations\BelongTo;

use App\Models\Database\Category;

trait CategoryTrait
{
    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param int $categoryId
     * @param string $newCategory
     */
    public function setCategory($categoryId, $newCategory = '')
    {
        $category = $newCategory
            ? Category::firstOrCreate(['name' => $newCategory])
            : Category::find($categoryId);
        $this->category()->associate($category);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Database\Category');
    }
}
