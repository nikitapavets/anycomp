<?php

namespace App\Classes\Widget;


use App\Models\Catalog;
use App\Models\Image;
use App\Repositories\ImageRepository;

class WidgetFile extends Widget
{
    const TYPE_FILE = 'file';

    function __construct($label = '', $name = '', $type = self::TYPE_FILE, $isRequired = false)
    {
        parent::__construct($label, $name, $type, (bool)$isRequired);
    }

    /**
     * @param Catalog $catalogProduct
     * @param bool $catalogProductType
     * @param bool $isGeneralImage
     */
    public function setValue($catalogProduct, $catalogProductType = false, $isGeneralImage = false)
    {
        if ($catalogProduct) {
            $value = ImageRepository::getImagesLikeArray(
                ImageRepository::getImagesByProductId($catalogProduct->getId(), $catalogProductType, $isGeneralImage),
                $isGeneralImage ? Image::IMAGE_SIZE_BIG : Image::IMAGE_SIZE_SMALL
            );
            parent::setValue($value);
        }
    }
}
