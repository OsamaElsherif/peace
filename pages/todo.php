<?php
include_once('libraries/JS/Vanilla/javascript.php');
$btn = form::input('btn', 'btn', 'vanilla', 'button', function() {
    echo "test";
});
$btn->apply_script(function($e) {
    $txt = form::input('txt', 'txt', 'vanilla', 'text', function() {
        echo "items";
    });
    
    // starting the javascript
    $js = new javascript();
    $change = $js->style($e, 'backgroundColor', 'red');
    $getValue = $js->getValue($txt);
    $var = $js->var('t', $getValue);
    $m = $js->console_log('t');
    $js->jsfunction('funcy', $change, $var, $m);
    $js->addEventLisiner($e, 'click', 'funcy');
    $js->run();
});
?>