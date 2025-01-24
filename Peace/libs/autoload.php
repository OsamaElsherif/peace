<?php
spl_autoload_register(function ($class) {
    $prefix = 'Peace\\';
    $base_dir = __DIR__ . DIRECTORY_SEPARATOR;
    $len = strlen($prefix);

    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
     // convert namespace to full path
    $file = $base_dir . str_replace('\\', DIRECTORY_SEPARATOR, $relative_class) . '.php';
    //remove the lib from the path since it is inside the base_dir.
    $file = str_replace(DIRECTORY_SEPARATOR.'libs'.DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR, $file);
    
    if (file_exists($file)) {
        require $file;
    }
});