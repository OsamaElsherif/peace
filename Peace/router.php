<?php
require_once __DIR__ . '/libs/autoload.php';

// Import the Router class
use Peace\Libs\Config;
use Peace\libs\Router;
use Peace\Pages\Default\Home;

$router = new Router();

$paths = [
    __DIR__ . '\\Config\\database.php'
];
$config = new Config($paths);
$config->load();

global $peaceConfig;
$peaceConfig = $config;

// -------------------------------------- ROUTES --------------------------------------------------

$router->get('/', function () {
    Home::render();
});

$router->dispatch();