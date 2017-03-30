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
            ' ',
            '-',
            str_replace('/', 'chr47', strtolower($customModel ? $customModel : $this->getModel()))
        );

        return '/catalog/'.$systemName.'/'.strtolower($this->getBrand()->getName()).'/'.$model;
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
        if (!count($this->getImages($productType))) {
            return '';
        }

        return config('image.catalog_big_img').$this->getImages($productType)[0]->getLink();
    }

    /**
     * @param int $productType
     * @return Image[]
     */
    public function getImages($productType)
    {
        return ImageRepository::getImagesByProductId($this->getId(), $productType);
    }

    public function getSmallImage($productType)
    {
        if (!count($this->getImages($productType))) {
            return '';
        }

        return config('image.catalog_small_img').$this->getImages($productType)[0]->getLink();
    }

    public function setImages($images, $productType)
    {
        ImageRepository::flushDb($this->getId(), $productType);
        if ($images) {
            $images = explode(',', $images);
            $photo_num = 0;
            foreach ($images as $image) {
                if (strpos($image, '/tmp/') === false) {
                    Image::storeDb($this->getId(), $productType, substr($image, strripos($image, '/') + 1));
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
                    Image::storeDb($this->getId(), $productType, $img_name);
                }
                $photo_num++;
            }
        }
    }

}
