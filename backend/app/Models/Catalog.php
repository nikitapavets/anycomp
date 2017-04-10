<?php

namespace App\Models;

use App\Traits\GetSet\CreatedAtTrait;
use App\Traits\GetSet\DeletedAtTrait;
use App\Traits\GetSet\IdTrait;
use App\Traits\GetSet\ModelTrait;
use App\Traits\GetSet\UpdatedAtTrait;
use App\Traits\Relations\BelongTo\BrandTrait;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\ImageRepository;
use Intervention\Image\ImageManagerStatic as ImageManager;

class Catalog extends Model
{
    protected $guarded = [];

    use IdTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;
    use DeletedAtTrait;
    use BrandTrait;
    use ModelTrait;

    public function IncreaseLookups()
    {
        $this->increment('page_lookups');
    }

    public function getLookups()
    {
        return $this->page_lookups;
    }

    public function getLink($systemName, $customModel = '')
    {
        $model = str_replace(
            [' ', '-'],
            ['-', '~'],
            str_replace(
                '/',
                'chr47',
                strtolower($this->getModel())
            )
        );
        if ($customModel) {
            $customModel = '?config='.str_replace(
                    [' ', '-'],
                    ['-', '~'],
                    str_replace(
                        '/',
                        'chr47',
                        strtolower($customModel)
                    )
                );
        }

        return $systemName.'/'.strtolower($this->getBrand()->getName()).'/'.$model.$customModel;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getBigImage($productType)
    {
        $generalImages = $this->getImages($productType, true);
        if (!count($generalImages)) {
            return '';
        }

        return config('image.catalog_big_img').$generalImages[0]->getLink();
    }

    public function getBigImages($productType)
    {
        $images = self::getImages($productType);
        $imagesPath = [];
        foreach ($images as $image) {
            $imagesPath[] = config('image.catalog_big_img').$image->getLink();
        }

        return $imagesPath;
    }

    /**
     * @param int $productType
     * @param bool $isGeneralImage
     * @return Image[]
     */
    public function getImages($productType, $isGeneralImage = false)
    {
        return ImageRepository::getImagesByProductId($this->getId(), $productType, $isGeneralImage);
    }

    public function getSmallImage($productType)
    {
        $generalImages = $this->getImages($productType, true);
        if (!count($generalImages)) {
            return '';
        }

        return config('image.catalog_small_img').$generalImages[0]->getLink();
    }

    public function setImages($images, $isGeneral = false, $productType = false)
    {
        ImageRepository::flushDb($this->getId(), $isGeneral, $productType);
        if ($images) {
            $images = explode(',', $images);
            $photo_num = 0;
            foreach ($images as $image) {
                if (strpos($image, '/tmp/') === false) {
                    ImageRepository::saveImage(
                        $this->getId(),
                        $productType,
                        substr($image, strripos($image, '/') + 1),
                        $isGeneral
                    );
                } else {
                    // small image
                    $img = ImageManager::make($_SERVER['DOCUMENT_ROOT'].$image);
                    $img->resize(
                        256,
                        null,
                        function ($constraint) {
                            $constraint->aspectRatio();
                        }
                    );
                    $img_path = $_SERVER['DOCUMENT_ROOT'].config('image.catalog_small_img');
                    $img_name = time().$photo_num.'.jpg';
                    $img->save($img_path.$img_name, 100);
                    // big image
                    $img = ImageManager::make($_SERVER['DOCUMENT_ROOT'].$image);
                    $img->resize(
                        1024,
                        null,
                        function ($constraint) {
                            $constraint->aspectRatio();
                        }
                    );
                    $img_path = $_SERVER['DOCUMENT_ROOT'].config('image.catalog_big_img');
                    $img->save($img_path.$img_name, 100);
                    ImageRepository::saveImage($this->getId(), $productType, $img_name, $isGeneral);
                }
                $photo_num++;
            }
        }
    }
}
