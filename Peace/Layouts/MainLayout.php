<?php
namespace Peace\Layouts;

class MainLayout {

    public static function render($callback, array $links, array $head_scripts, array $body_scripts) {
        echo self::html(function () use ($callback, $links, $head_scripts, $body_scripts) {
            if (is_callable($callback)) {
                $content = $callback();
            }
            $content = $callback;
            return self::head($links, $head_scripts) . self::body($content, $body_scripts);
        });
    }

    protected static function html($callback) {
        $content = $callback();
        return <<<HTML
        <!DOCTYPE html>
        <html>
            $content
        </html>
        HTML;
    }

    protected static function head(array $links, array $scripts) {
        echo <<<HTML
        <head>
            <title>Peace</title>
        HTML;
        for ($i = 0; $i < count($links); $i++) {
            echo $links[$i];
        }
        for ($i = 0; $i < count($scripts); $i++) {
            echo $scripts[$i];
        }
        echo <<<HTML
        </head>
        HTML;
    }

    protected static function body($content, array $scripts) {
        echo <<<HTML
        <body>
            $content
        HTML;
        for ($i = 0; $i < count($scripts); $i++) {
            echo $scripts[$i];
        }
        echo <<<HTML
        </body>
        HTML;
    }
}