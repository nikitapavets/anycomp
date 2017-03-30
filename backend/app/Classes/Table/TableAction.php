<?php

namespace App\Classes\Table;

class TableAction
{
    const TYPE_CREATE = 'create';
    const TYPE_UPDATE = 'update';
    const TYPE_DELETE = 'delete';

    const FORM_INLINE = 'inline';
    const FORM_EXTERNAL = 'external';

    private $_type;
    private $_form;
    private $_link;

    function __construct($type, $form = self::FORM_EXTERNAL, $link = '')
    {
        $this->_type = $type;
        $this->_form = $form;
        $this->_link = $link;
    }

    public function getType()
    {
        return $this->_type;
    }

    public function setType($type)
    {
        $this->_type = $type;
    }

    public function getForm()
    {
        return $this->_form;
    }

    public function setForm($form)
    {
        $this->_form = $form;
    }

    public function getLink()
    {
        return $this->_link;
    }

    public function setLink($link)
    {
        $this->_link = $link;
    }
}
