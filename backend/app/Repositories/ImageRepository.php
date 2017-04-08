<?php

namespace App\Repositories;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImageRepository
{
    /**
     * @param Image[] $images
     * @param $imageSize
     * @return array
     */
    public static function getImagesLikeArray($images, $imageSize = Image::IMAGE_SIZE_SMALL)
    {
        $imgArray = [];
        foreach ($images as $image) {
            $link = '';
            if($imageSize === Image::IMAGE_SIZE_SMALL) {
                $link = config('image.catalog_small_img').$image->getLink();
            } else if($imageSize === Image::IMAGE_SIZE_BIG) {
                $link = config('image.catalog_big_img').$image->getLink();
            }
            $imgArray[] = $link;
        }

        return $imgArray;
    }

    public static function flushDb($productId, $isGeneralImage = false, $productType = false)
    {
        foreach (self::getImagesByProductId($productId, $productType, $isGeneralImage) as $image) {
            $image->delete();
        }
    }

    /**
     * @param int $productId
     * @param int $productType
     * @param bool $isGeneralImage
     * @return Image[]
     */
    public static function getImagesByProductId($productId = 0, $productType = 0, $isGeneralImage = false)
    {
        return Image::ofProduct($productId, $productType, $isGeneralImage)->get();
    }

    public static function saveImage($productId, $productType, $link, $isGeneral = false, $imageId = null)
    {
        DB::transaction(
            function () use ($productId, $productType, $link, $isGeneral, $imageId) {
                /**
                 * @var Image $image
                 */
                $image = Image::firstOrNew(['id' => $imageId ?? 0]);
                $image->setProductId($productId);
                $image->setProductType($productType);
                $image->setLink($link);
                $image->setIsGeneral($isGeneral);
                $image->save();
            }
        );
    }
}
