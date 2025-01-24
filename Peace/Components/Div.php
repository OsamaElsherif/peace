<?php
namespace Peace\Components;

use Peace\Components\Utils\Attributes;

class Div
{
    /**
     * Creates an HTML div element.
     *
     * @param string|null $classname  The CSS class name(s) for the div.
     * @param string|null $id       The HTML id for the div.
     * @param string|null $content   The HTML content within the div.
     * @return string  The generated HTML div element.
     */

    public static function render(?string $classname = null, ?string $id = null, ?callable $callback = null): string
    {
        $attributesString = Attributes::extract($classname, $id);

        return "<div {$attributesString}>{$callback()}</div>";
    }
}