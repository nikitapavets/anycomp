<?php

namespace App\Classes\Widget;


class WidgetCheckbox extends Widget
{
    const TYPE_CHECKBOX = 'checkbox';

    function __construct($label = '', $name = '', $isRequired = false)
    {
        parent::__construct($label, $name, self::TYPE_CHECKBOX, (bool)$isRequired);
    }

    public function getChecked()
    {
        return $this->getValue() ? 'checked' : '';
    }
}
