# PEACE Framework
### php Framework that makes web development in php easy for work with.
|| Note : It is just a project that's made for fun ||
<br>
## How to get it
to use it just clone this project and make your pages in the index.php file
<br>
## Documintation
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
