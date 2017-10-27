<?php

namespace App\Classes\Widget;


class Widget
{
    protected $_label;
    protected $_type;
    protected $_name;
    protected $_isRequired;
    protected $_value;
    protected $class;

    /**
     * Widget constructor.
     * @param string $label
     * @param string $name
     * @param string $type
     * @param bool $isRequired
     */
    function __construct($label, $name, $type, $isRequired)
    {
        $this->_label = $label;
        $this->_type = $type;
        $this->_name = $name;
        $this->_isRequired = $isRequired;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->_label;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->_label = $label;
    }

    /**
     * @return bool
     */
    public function isRequired()
    {
        return (bool)$this->_isRequired;
    }

    /**
     * @param bool $isRequired
     */
    public function setRequired($isRequired)
    {
        $this->_isRequired = $isRequired;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->_type = $type;
    }

    /**
     * @return string|int
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * @param string|int $value
     */
    public function setValue($value)
    {
        $this->_value = $value;
    }

    public function getClass()
    {
        return $this->class;
    }

    public function setClass($class)
    {
        $this->class = $class;
    }

    public function toArray()
    {
        return [
          'label' => $this->getLabel(),
          'item' => $this->getType(),
          'name' => $this->getName(),
          'class' => $this->getClass(),
          'required' => $this->isRequired(),
          'value' => $this->getValue(),
        ];
    }
}
