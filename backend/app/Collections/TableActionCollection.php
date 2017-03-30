<?php

namespace App\Collections;

use App\Classes\Table\TableAction;

/**
 * Class TableActionCollection
 * @package App\Collections
 */
class TableActionCollection
{
    private $_tableActions;

    /**
     * TableActionCollection constructor.
     */
    function __construct()
    {
        $this->_tableActions = [];
    }

    /**
     * @param TableAction $tableAction
     */
    public function pushTableAction($tableAction)
    {
        if ($tableAction instanceof TableAction) {
            array_push($this->_tableActions, $tableAction);
        }
    }

    /**
     * @return TableAction[]
     */
    public function getTableActions()
    {
        return $this->_tableActions;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $tableActionArray = [];
        foreach ($this->getTableActions() as $tableAction) {
            $tableActionArray[] = [
                'action_type' => $tableAction->getType(),
                'action_form' => $tableAction->getForm(),
                'action_link' => $tableAction->getLink(),
            ];
        }
        return $tableActionArray;
    }
}