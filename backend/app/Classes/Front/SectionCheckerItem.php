<?php

namespace App\Classes\Front;


class SectionCheckerItem extends SectionItem
{
    private $checkerValue;

   function __construct($title = '', $value = '', $type = self::TYPE_CHECKER)
   {
       parent::__construct($title, $value, $type);
   }

   public function getCheckerValue()
   {
       return $this->checkerValue;
   }

   public function setCheckerValue($checkerValue)
   {
       $this->checkerValue = (bool)$checkerValue;
   }
}
