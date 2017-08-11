<?php

namespace App\Collections;


use App\Classes\Widget\Widget;
use App\Classes\Widget\WidgetCheckbox;
use App\Classes\Widget\WidgetChosen;
use App\Classes\Widget\WidgetFile;
use App\Classes\Widget\WidgetInput;
use App\Classes\Widget\WidgetSelect;

class WidgetCollection
{
    private $_title;
    private $_widgets;

    /**
     * WidgetCollection constructor.
     * @param string $title
     */
    function __construct($title = '')
    {
        $this->_title = $title;
        $this->_widgets = [];
    }

    /**
     * @param Widget $widget
     */
    public function pushWidget($widget)
    {
        if ($widget instanceof Widget) {
            array_push($this->_widgets, $widget);
        }
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = [];
        $array['title'] = $this->getTitle();
        $array['rows'] = [];
        foreach ($this->getWidgets() as $widget) {
            $row = [];
            $row['label'] = $widget->getLabel();
            $row['item'] = $widget->getType();
            $row['name'] = $widget->getName();
            $row['class'] = $widget->getClass();
            $row['required'] = $widget->isRequired();
            $row['value'] = $widget->getValue();
            if ($widget instanceof WidgetInput) {
                $row['type'] = $widget->getValueType();
                $row['validation_type'] = $widget->getValidationType();
            } elseif ($widget instanceof WidgetSelect) {
                $row['select_gag'] = $widget->getSelectGag();
                $row['select_gag_selected'] = $widget->getSelectGagSelected();
                $row['select_items'] = $widget->getSelectItems();
                $row['add_new'] = $widget->isAllowAdd();
                $row['add_new_name'] = $widget->getAllowAddName();
            }elseif ($widget instanceof WidgetChosen) {
                $row['select_items'] = $widget->getChosenItems();
            }elseif ($widget instanceof WidgetCheckbox) {
                $row['checked'] = $widget->getChecked();
            }elseif ($widget instanceof WidgetFile) {
                $row['value'] = $widget->getValue();
            }
            $array['rows'][] = $row;
        }

        return $array;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->_title = $title;
    }

    /**
     * @return Widget[]
     */
    public function getWidgets()
    {
        return $this->_widgets;
    }
}