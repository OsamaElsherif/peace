<?php
namespace Peace\Components;

use Peace\Components\Utils\Attributes;
class Span
{
    public static function render(string $classname = null, ?string $id = null, ?string $text = null)
    {
        $attributesString = Attributes::extract($classname, $id);

        return <<<HTML
            <span {$attributesString}>$text</span>
        HTML;
    }
}