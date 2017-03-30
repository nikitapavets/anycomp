<?php

namespace App\Classes\Widget;


class WidgetInput extends Widget
{
    const TYPE_INPUT = 'input';

    const VALUE_TYPE_TEXT = 'text';
    const VALUE_TYPE_PASSWORD = 'password';
    const VALUE_TYPE_HIDDEN = 'hidden';
    const VALUE_TYPE_NUMBER = 'number';
    const VALUE_TYPE_PHONE = 'inp_phone';
    const VALUE_TYPE_HOME_PHONE = 'inp_home_phone';

    const VALIDATION_TYPE_ONLY_RUS = 'only_rus';

    private $_valueType;
    private $validationType;

    function __construct($label = '', $name = '', $isRequired = false)
    {
        parent::__construct($label, $name, self::TYPE_INPUT, (bool)$isRequired);
        $this->_valueType = self::VALUE_TYPE_TEXT;
    }

    public function getValueType()
    {
        return $this->_valueType;
    }

    public function setValueType($valueType)
    {
        switch ($valueType) {
            case self::VALUE_TYPE_PHONE: {
                $this->setClass(self::VALUE_TYPE_PHONE);
                break;
            }
            case self::VALUE_TYPE_HOME_PHONE: {
                $this->setClass(self::VALUE_TYPE_HOME_PHONE);
                break;
            }
            default: {
                $this->_valueType = $valueType;
            }
        }
    }

    public function getValidationType()
    {
        return $this->validationType;
    }

    public function setValidationType($validationType)
    {
        $this->validationType = $validationType;
    }
}
