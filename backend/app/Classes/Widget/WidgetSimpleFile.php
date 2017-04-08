<?php

namespace App\Classes\Widget;

use App\Models\Catalog;
use App\Repositories\ImageRepository;

class WidgetSimpleFile extends WidgetFile
{
    const TYPE_SIMPLE_FILE = 'simpleFile';

    function __construct($label = '', $name = '', $type = self::TYPE_SIMPLE_FILE, $isRequired = false)
    {
        parent::__construct($label, $name, $type, $isRequired);
    }

    public function setValue($catalogProduct, $catalogProductType = false, $isGeneralImage = true)
    {
        parent::setValue($catalogProduct, $catalogProductType, $isGeneralImage);
    }
}
