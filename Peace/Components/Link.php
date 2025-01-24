<?php
namespace Peace\Components;

class Link {
   public static function render(string $url, string $rel) {

    return <<<HTML
        <link rel=$rel href=$url />
    HTML;
   }
}