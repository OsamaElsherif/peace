<?php
namespace Peace\Components;

use Peace\Components\Utils\Attributes;

class Image {
    public static function render(string $classname = null, ?string $id = null, ?string $imgPath)
    {
        $attributesString = Attributes::extract($classname, $id);

        return <<<HTML
            <img {$attributesString} src={$imgPath} />
        HTML;
    }
}