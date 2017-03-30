<?php

namespace App\Classes\Table;

/**
 * Class TableTabs
 * @package App\Classes\Widget
 */
class TableCell
{
    const CLASS_CHECKER = 'checker';
    const TYPE_POPUP = 'popup';
    const TYPE_EDIT = 'edit';

    private $_value;
    private $_class;
    private $_type;

    function __construct($value, $type = '')
    {
        $this->_value = $value;
        $this->_type = $type;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->_value = $value;
    }

    /**
     * @param string $class
     */
    public function setClass($class)
    {
        $this->_class = $class;
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->_class;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->_type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }
}