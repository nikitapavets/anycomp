<?php

namespace App\Classes\Widget;


class WidgetDatePicker extends Widget
{
    const TYPE_DATE_PICKER = 'datePicker';

    function __construct($label = '', $name = '', $isRequired = false, $type = self::TYPE_DATE_PICKER)
    {
        parent::__construct($label, $name, $type, (bool)$isRequired);
    }
}
