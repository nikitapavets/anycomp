<?php

namespace App\Classes\Widget;


use App\Models\Catalog;
use App\Repositories\ImageRepository;

class WidgetFile extends Widget
{
    const TYPE_FILE = 'file';

    function __construct($label = '', $name = '', $isRequired = false)
    {
        parent::__construct($label, $name, self::TYPE_FILE, (bool)$isRequired);
    }

    /**
     * @param Catalog $catalogProduct
     * @param $catalogProductType
     */
    public function setValue($catalogProduct, $catalogProductType = false)
    {
        if ($catalogProduct) {
            $value = ImageRepository::getImagesLikeArray(
                ImageRepository::getImagesByProductId($catalogProduct->getId(), $catalogProductType)
            );
            parent::setValue($value);
        }
    }
}
