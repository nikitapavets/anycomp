<?php

namespace App\Collections;

use App\Classes\Table\TableField;

/**
 * Class TableFieldCollection
 * @package App\Classes\Collections
 */
class TableFieldCollection
{
    private $_tableFields;

    /**
     * TableFieldCollection constructor.
     */
    function __construct()
    {
        $this->_tableFields = [];
    }

    /**
     * @param TableField $tableField
     */
    public function pushTableField($tableField)
    {
        if ($tableField instanceof TableField) {
            array_push($this->_tableFields, $tableField);
        }
    }

    /**
     * @return TableField[]
     */
    public function getTableFields()
    {
        return $this->_tableFields;
    }

    /**
     * @return array
     */
    public  function toArray()
    {
        $tableFieldsArray = [];
        foreach ($this->getTableFields() as $tableField) {
            $tableFieldsArray[] = [
                'field_name' => $tableField->getName(),
                'field_sort_type' => $tableField->getSortType(),
                'field_size' => $tableField->getSize(),
                'field_class' => $tableField->getClass(),
            ];
        }
        return $tableFieldsArray;
    }
}