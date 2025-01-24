<?php
namespace Peace\Components;

use Peace\Components\Utils\Attributes;

class Anchor {
    public static function render(string $classname = null, ?string $id = null, ?string $link, ?callable $callback)
    {
        $attributesString = Attributes::extract($classname, $id);

        $content = $callback();

        return <<<HTML
            <a {$attributesString} href={$link} {$attributesString}>$content</a>
        HTML;
    }
}