<?php
require_once __DIR__ . '/libs/autoload.php';

// Import the Router class
use Peace\Libs\Config;
use Peace\libs\ExceptionHandeler;
use Peace\libs\Logger;
use Peace\libs\Router;
use Peace\Pages\Default\Home;


// load configes
$paths = [
    __DIR__ . '\\Config\\database.php',
    __DIR__ . '\\Config\\app.php'
];

$config = new Config($paths);
$config->load();

global $peaceConfig;
$peaceConfig = $config;

// start a looger instance
$logPath = $config->get('log_path', __DIR__ . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'app.log');
$logger = new Logger($logPath, ['error', 'warning']);

// start excption haneler instance
$exceptionHandeler = new ExceptionHandeler($logger, $config->get('debug')); 

// registeer excption handeler
set_exception_handler(function (\Throwable $exception) use ($exceptionHandeler) {
    $exceptionHandeler->handleException($exception);
});

$router = new Router();


// -------------------------------------- ROUTES --------------------------------------------------

$router->get('/', function () {
    Home::render();
});

$router->dispatch();