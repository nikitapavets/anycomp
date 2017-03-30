<?php

namespace App\Classes\Table;

/**
 * Class TablePopupLinkItem
 * @package App\Classes\Table
 */
class TablePopupInlineLinkItem extends TablePopupLinkItem
{
    private $dataAction;
    private $dataId;
    private $dataSelected;

    /**
     * TablePopupLinkItem constructor.
     * @param string $type
     * @param string $value
     * @param string $form
     */
    function __construct($type = '', $value = '', $form = self::FORM_LINK)
    {
        parent::__construct($type, $value, $form);
    }

    public function getDataAction()
    {
        return $this->dataAction;
    }

    public function setDataAction($dataAction)
    {
        $this->dataAction = $dataAction;
    }

    public function getDataId()
    {
        return $this->dataId;
    }

    public function setDataId($dataId)
    {
        $this->dataId = $dataId;
    }

    public function getDataSelected()
    {
        return $this->dataSelected;
    }

    public function setDataSelected($dataSelected)
    {
        $this->dataSelected = $dataSelected;
    }
}