<?php

namespace App\Classes\Table;

/**
 * Class TableField
 * @package App\Classes\Widget
 */
class TableField
{
    const SORT_TYPE_SORTABLE = 'sortable';
    const SORT_TYPE_NO_SORTABLE = 'no-sortable';
    const SORT_TYPE_DEFAULT = 'default';

    const CLASS_CHECKER = 'checker';

    private $_name;
    private $_size;
    private $_sortType;
    private $_class;

    /**
     * TableField constructor.
     * @param string $name
     * @param int $size
     * @param string $sortType
     * @param string $class
     */
    function __construct($name = '', $size = 0, $sortType = self::SORT_TYPE_DEFAULT, $class = '')
    {
        $this->_name = $name;
        $this->_size = $size;
        $this->_sortType = $sortType;
        $this->_class = $class;
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
     * @return int
     */
    public function getSize()
    {
        return $this->_size;
    }

    /**
     * @param int $size
     */
    public function setSize($size)
    {
        $this->_size = $size;
    }

    /**
     * @return string
     */
    public function getSortType()
    {
        return $this->_sortType;
    }

    /**
     * @param string $sortType
     */
    public function setSortType($sortType)
    {
        $this->_sortType = $sortType;
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
}