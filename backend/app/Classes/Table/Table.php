<?php

namespace App\Classes\Table;

use App\Collections\TableActionCollection;
use App\Collections\TableFieldCollection;
use App\Collections\TableTabCollection;

class Table
{
    /**
     * @var string
     */
    private $_title;
    /**
     * @var TableTabCollection
     */
    private $_tableTabs;
    /**
     * @var TableFieldCollection
     */
    private $_tableFields;
    /**
     * @var TableActionCollection
     */
    private $_tableActions;

    /**
     * Table constructor.
     * @param string $title
     */
    function __construct($title = '')
    {
        $this->_title = $title;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'title' => $this->getTitle(),
            'table_tabs' => $this->getTableTabs()->toArray(),
            'table_rows' => $this->getTableTabs()->toRowsArray(),
            'table_paginations' => $this->getTableTabs()->toPaginationArray(),
            'table_fields' => $this->getTableFields()->toArray(),
            'table_actions' => $this->getTableActions()->toArray(),
        ];
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->_title = $title;
    }

    /**
     * @return TableTabCollection
     */
    public function getTableTabs()
    {
        return $this->_tableTabs;
    }

    /**
     * @param TableTabCollection $tableTabs
     */
    public function setTableTabs($tableTabs)
    {
        $this->_tableTabs = $tableTabs;
    }

    /**
     * @return TableFieldCollection
     */
    public function getTableFields()
    {
        return $this->_tableFields;
    }

    /**
     * @param TableFieldCollection $tableFields
     */
    public function setTableFields($tableFields)
    {
        $this->_tableFields = $tableFields;
    }

    /**
     * @return TableActionCollection
     */
    public function getTableActions()
    {
        return $this->_tableActions;
    }

    /**
     * @param TableActionCollection $tableActions
     */
    public function setTableActions($tableActions)
    {
        $this->_tableActions = $tableActions;
    }
}