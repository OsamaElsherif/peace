<?php
namespace Peace\Components;

class Script {
     public static function render(string $src) {
        return <<<HTML
            <script src=$src></script>
        HTML;
     }
}