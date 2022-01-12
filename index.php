<?php
// include router library
include('libraries/Routing/router.php');
// include basic html objects
foreach (glob("libraries/objects/*.php") as $filename)
{
    include $filename;
}
// include customized objects
include ('objects/main.php');

$router = new Router();

$router->get('/', function() {
    include('pages/index.php');
});
$router->get('/about', function() {
    echo "about";
});
$router->get('/contact', function() {
    echo "contact";
});

echo $router->resolve($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
?>