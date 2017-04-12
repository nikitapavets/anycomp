<?php

namespace App\Classes\Front;


class SectionItem
{
    const TYPE_SIMPLE = 'simple';
    const TYPE_CHECKER = 'checker';

    private $title;
    private $value;
    private $type;

    function __construct($title = '', $value = '', $type = self::TYPE_SIMPLE)
    {
        $this->setTitle($title);
        $this->setValue($value);
        $this->setType($type);
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }
}
