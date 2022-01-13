<?php
include_once('libraries/JS/Vanilla/javascript.php');
$btn = form::input('btn', 'btn', 'vanilla', 'button', function() {
    echo "test";
});
$btn->apply_script(function($e) {
    // starting the javascript
    $js = new javascript();
    $change = $js->style($e, 'backgroundColor', 'red');
    $m = $js->console_log('test from vanilla');
    $js->jsfunction('funcy', $change, $m);
    $js->addEventLisiner($e, 'click', 'funcy');
    $js->run();
});
?>