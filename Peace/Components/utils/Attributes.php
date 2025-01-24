<?php
namespace Peace\Components\Utils;

class   Attributes {
    public static function extract($classname, $id) {
        $attributes = [];

        if ($classname !== null && $classname !== '') {
            $attributes[] = 'class="' . htmlspecialchars($classname, ENT_QUOTES, 'UTF-8') . '"';
        }

        if ($id !== null && $id !== '') {
            $attributes[] = 'id="' . htmlspecialchars($id, ENT_QUOTES, 'UTF-8') . '"';
        }

        return implode(' ', $attributes);
    }
}