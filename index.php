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
$router->get('/info', function() {
    return phpinfo();
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
$router->get('/sql', function() {
    $conn = new connection('ODBC Driver 17 for SQL Server', 'localhost', 'NABTA');
    $conn->connect('sa', 'Osama_3502');
    $query = new query("SELECT * FROM [User]");
    $exec = $conn->exec($query);
    // echo "<pre>";
    $res = query::fetchAll($exec);
    // print_r(array_keys($res[0]));
    $table = new table('table_class', 'table_id');
    $t = $table->autoCreate($res);
    // echo "</pre>";
});

// initilize the routeing
echo $router->resolve($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
?>