<?php
// include router library
include('libraries/Routing/router.php');
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
$router->get('/todo', function() {
    include('pages/todo.php');
});
$router->get('/contact', function() {
    include('pages/contact.php');
});
$router->post('/contact', function() {
    return print_r($_POST);
});

// initilize the routeing
echo $router->resolve($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
?>