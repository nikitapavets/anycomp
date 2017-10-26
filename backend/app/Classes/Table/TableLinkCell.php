<?php

namespace App\Classes\Table;

/**
 * Class TableLinkCell
 * @package App\Classes\Table
 */
class TableLinkCell extends TableCell
{
    const TYPE_LINK = 'link';
    const TARGET_SELF = '_self';
    const TARGET_BLANK = '_blank';

    private $_link_href;
    private $_link_target;
    private $_link_class;

    function __construct($value, $target = self::TARGET_BLANK, $type = self::TYPE_LINK)
    {
        parent::__construct($value, $type);

        $this->_link_target = $target;
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
    public function getLinkHref()
    {
        return $this->_link_href;
    }

    /**
     * @param string $linkTarget
     */
    public function setLinkTarget($linkTarget)
    {
        $this->_link_target = $linkTarget;
    }

    /**
     * @return string
     */
    public function getLinkTarget()
    {
        return $this->_link_target;
    }

    /**
     * @param string $linkClass
     */
    public function setLinkClass($linkClass)
    {
        $this->_link_class = $linkClass;
    }

    /**
     * @return string
     */
    public function getLinkClass()
    {
        return $this->_link_class;
    }
}