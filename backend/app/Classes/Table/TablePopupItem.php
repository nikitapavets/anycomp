<?php

namespace App\Classes\Table;

/**
 * Class TablePopupItem
 * @package App\Classes\Table
 */
class TablePopupItem
{
    const TYPE_PHONE = 'phone';
    const TYPE_PHONE_HOME = 'phone_home';
    const TYPE_FULL_NAME = 'full_name';
    const TYPE_ORGANIZATION = 'organization';
    const TYPE_ADDRESS = 'address';
    const TYPE_HASH = 'hash';
    const TYPE_CODE = 'code';
    const TYPE_BOX = 'box';
    const TYPE_SET = 'set';
    const TYPE_DEFECT = 'defect';
    const TYPE_WORKER = 'worker';
    const TYPE_EDIT = 'edit';
    const TYPE_XLS = 'xls';
    const TYPE_STATUS = 'status';
    const TYPE_COMMENT = 'comment';
    const TYPE_PLACE = 'place';

    const FORM_TEXT = 'text';

    const CLASS_REPAIR_STATUS = 'popUp__changeStatus';

    private $_type;
    private $_form;
    private $_value;
    private $_class;

    /**
     * TablePopupItem constructor.
     * @param string $type
     * @param string $value
     * @param string $form
     */
    function __construct($type = '', $value = '', $form = self::FORM_TEXT)
    {
        $this->_type = $type;
        $this->_value = $value;
        $this->_form = $form;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->_value = $value;
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
     * @return string
     */
    public function getForm()
    {
        return $this->_form;
    }

    /**
     * @param string $form
     */
    public function setForm($form)
    {
        $this->_form = $form;
    }

    public function getClass()
    {
        return $this->_class;
    }

    public function setClass($class)
    {
        $this->_class = $class;
    }
}