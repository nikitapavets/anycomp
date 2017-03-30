<?php

namespace App\Classes\Table;

use App\Collections\TableRowsCollection;

/**
 * Class TableTabs
 * @package App\Classes\Widget
 */
class TableTab
{
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    private $_name;
    private $_status;
    /**
     * @var TableRowsCollection
     */
    private $_rows;

    /**
     * TableTab constructor.
     * @param string $name
     * @param string $status
     */
    function __construct($name, $status = self::STATUS_INACTIVE)
    {
        $this->_name = $name;
        $this->_status = $status;
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
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param $status
     */
    public function setStatus($status)
    {
        $this->_status = $status;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->_status;
    }

    /**
     * @param TableRowsCollection $rows
     */
    public function setRows($rows)
    {
        $this->_rows = $rows;
    }

    /**
     * @return TableRowsCollection
     */
    public function getRows()
    {
        return $this->_rows;
    }
}