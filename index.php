<?php
// include router library
include('libraries/Routing/router.php');
// include database library
include('libraries/database/connection.php');
// include basic html objects library
foreach (glob("libraries/objects/*.php") as $filename)
{
    include $filename;
}
// include customized objects
include ('objects/main.php');

// start the router 
$router = new Router();

// routes
$router->get('/', function() {
    include('pages/index.php');
});

$router->get('/test', function() {
    include('pages/test.php');
}); 

// initilize the routeing
echo $router->resolve($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
?>