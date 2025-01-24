<?php
namespace Peace\Components;

class Label
{
    public static function render($class, $id, $for, $text)
    {
        return '<label class="'.$class.'" id="'.$id.'" for="' . $for . '">' . $text . '</label>';
    }
}