<?php

namespace App\Classes\Table;

/**
 * Class TablePopupLinkItem
 * @package App\Classes\Table
 */
class TablePopupLinkItem extends TablePopupItem
{
    const FORM_LINK = 'link';
    const TARGET_BLANK = '_blank';

    private $_link_href;
    private $_link_target;

    /**
     * TablePopupLinkItem constructor.
     * @param string $type
     * @param string $value
     * @param string $form
     */
    function __construct($type = '', $value = '', $form = self::FORM_LINK)
    {
        parent::__construct($type, $value, $form);

        $this->_link_target = self::TARGET_BLANK;
    }

    /**
     * @return string
     */
    public function getLinkHref()
    {
        return $this->_link_href;
    }

    /**
     * @param string $linkHref
     */
    public function setLinkHref($linkHref)
    {
        $this->_link_href = $linkHref;
    }

    /**
     * @return string
     */
    public function getLinkTarget()
    {
        return $this->_link_target;
    }

    /**
     * @param string $linkTarget
     */
    public function setLinkTarget($linkTarget)
    {
        $this->_link_target = $linkTarget;
    }
}