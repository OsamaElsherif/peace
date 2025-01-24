<?php
namespace Peace\Components;

use Peace\Components\Utils\Attributes;

class Input
{
    public static function render(
        ?string $classname = null, 
        ?string $id = null, 
        ?string $type = null, 
        ?string $name = null, 
        ?string $value = null, 
        ?string $placeholder = null
        )
    {
        $attributesString = Attributes::extract($classname, $id);

        return <<<HTML
            <input {$attributesString} type=$type name=$name placeholder="$placeholder" $value="$value" />
        HTML;
    }
}