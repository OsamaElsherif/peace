<?php
namespace Peace\Components;

use Peace\Components\Utils\Attributes;

class Heading {
    public static function render(?string $classname = null, ?string $id = null, ?string $text = null, ?string $level = null) {
        $attributesString = Attributes::extract($classname, $id);
        
        return <<<HTML
            <h$level {$attributesString}>$text</h$level>
        HTML;
    }
}