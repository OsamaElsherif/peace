# PEACE Framework
### php Framework that makes web development in php easy for work with.
|| Note : It is just a project that's made for fun ||
<br>
## How to get it
to use it just clone this project and make your pages in the index.php file
<br>
## Documintation
you create your pages in the pages directory `pages/` <br>
and you create your routes in the `index.php` you have to use a get, and post methods in the routes, you can find these functions in the `index.php`<br>
every html tag is an object
<br>
to initialize the DOCUMENT : -
```php
$document = new DOC($css='stylefile.css', $script='scriptfile.js', $title='pagetitle');
$document->Create($class='body_class', function() {
    // your page conetents goes here
});
```
in the page content you can write HTML as an echo result, or you can create your own object in `objects/main.php`, or use the objects that's exist
to create a div
```php
$div = new div($class='', $script='');
$div->Create($style='', function() {
    // your div contents
});
```
to create a text
```php
$text = new text("your text is here");
// to create from h1 to h6, level is the heading level from 1 to 6
$text->heading($level=1, $class='classname', $id='idname', $style='');
// to create a paragraph
$text->heading($class='classname', $id='idname', $style='');
// to create a span
$text->heading($class='classname', $id='idname', $style='');
```
and all the other objects is working like that exactly, you can find it in `libraries/objects/`

### for using the JavaScript
```php
$js = new javascript();
```
remeber that you've to include the javascript library in this file <br>
`*Note :: * VanillaJS library is still under development, so for now it is supporting EventListeners and some essentals`
to use the eventlistener
```php
// changing the element color
$change = $js->style(element element, 'CSS Proberty', 'value');
// getting the value from an input object
$getValue = $js->getValue(input element);
// assign a variable
$var = $js->var('variable_name', $getValue);
// console_log
$msg = $js->console_log('t');
// creating the function
$js->jsfunction('function_name', $change, $var, $m);
// creating the event listener for this element
$js->addEventLisiner(elenent elenebt, 'Event', 'function_name');
//running this script
$js->run();
```
EX :
```php
// creating a btn 'input object'
$btn = form::input('btn', 'btn', 'vanilla', 'button', function() {
    echo "test";
});
// applying script in this object
// $e is this element object 'must be added'
$btn->apply_script(function($e) {
    // creating a text 'input object'
    $txt = form::input('txt', 'txt', 'vanilla', 'text', function() {
        echo "items";
    });
    
    // starting the javascript
    $js = new javascript();
    // changing the color
    $change = $js->style($e, 'backgroundColor', 'red');
    // getting the value of the text
    $getValue = $js->getValue($txt);
    // assing the value to a variable
    $var = $js->var('t', $getValue);
    // printing the variable name in the console
    $m = $js->console_log('t');
    // making a function from the above scripts
    $js->jsfunction('funcy', $change, $var, $m);
    // creating the listenr on this btn
    $js->addEventLisiner($e, 'click', 'funcy');
    // running the script
    $js->run();
});
```
Using the odbc for connecting to the database
```php
$conn = new connection('Drivaer Name', 'Server', 'Database');
$conn->connect('username', 'password');
```
For making a query to the database
```php
$query = new query('SQL statment');
$exec = $conn->exec($query);
```
if the query was selecting data from the database, you can use fetching methods
```php
// fetchAll method expects 2 argumetns, as default the second argument is set to 'array' but you can set it to 'json',
// you can set the type in the second argment
$result_ALL = $query::fetchAll($exec);
// or you can fetch one record as an opject class using fetch method
$result_ONE = $query::fetch($exec);
// if you want to feed all the results in a table you can use the autoComplete method for the table object
$table = new table('table_class', 'table_id');
$t = $table->autoCreate($result_ALL);
```
