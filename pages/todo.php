<?php
include_once('libraries/JS/Vanilla/javascript.php');
$btn = form::input('btn', 'btn', 'vanilla', 'submit', function() {
    echo "test";
});

// starting the javascript
$js = new javascript();
$js->addEventLisiner($btn, 'click', 'funcy');
$change = $js->style($btn, 'backgroundColor', 'red');
$m = $js->console_log('test from vanilla');
$js->jsfunction('funcy', $change, $m);
$js->run();
?>