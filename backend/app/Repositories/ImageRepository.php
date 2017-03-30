<?php

namespace App\Repositories;

use App\Models\Image;

class ImageRepository
{
    /**
     * @param Image[] $images
     * @return array
     */
    public static function getImagesLikeArray($images)
    {
        $imgArray = [];
        foreach ($images as $image) {
            $imgArray[] = config('image.catalog_small_img').$image->getLink();
        }

        return $imgArray;
    }

    /**
     * @param int $productId
     * @param int $productType
     */
    public static function flushDb($productId, $productType)
    {
        foreach (self::getImagesByProductId($productId, $productType) as $image) {
            $image->delete();
        }
    }

    /**
     * @param int $productId
     * @param int $productType
     * @return Image[]
     */
    public static function getImagesByProductId($productId = 0, $productType = 0)
    {
        return Image::ofProduct($productId, $productType)->get();
    }
}
