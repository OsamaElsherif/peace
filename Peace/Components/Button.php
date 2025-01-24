<?php
namespace Peace\Components;

use Peace\Components\Utils\Attributes;

class Button {
    public static function render(?string $classname = null, ?string  $id = null, ?string $text = null)
    {
        $attributesString = Attributes::extract($classname, $id);

        return <<<HTML
        <button {$attributesString}>$text</button>
        HTML;
    }
}