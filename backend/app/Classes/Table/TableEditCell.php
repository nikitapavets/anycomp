<?php

namespace App\Classes\Table;

class TableEditCell extends TableCell
{

    private $data_id;

    function __construct($value, $type = self::TYPE_EDIT)
    {
        parent::__construct($value, $type);
    }

    public function getDataId()
    {
        return $this->data_id;
    }

    public function setDataId($id)
    {
        $this->data_id = $id;
    }
}