<?php
namespace Peace\Components;

use Peace\Components\Utils\Attributes;

class Form
{
    public static function render(?string $classname = null, ?string $id = null, ?string $action = null, ?string $method = null, ?callable $callback = null)
    {
        $attributesString = Attributes::extract($classname, $id);

        $content = $callback();

        return <<<HTML
            <form {$attributesString} action=$action method=$method>' . $content. '</form>
        HTML;
    }
}