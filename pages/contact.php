<?php
$form = new form('form_class', 'form_id', 'post', '/contact');
$form->Create(function() {
    $label = new text('Email');
    $label->label('lbl', 'lbl');
    $input = form::input('txt', 'txt', 'email', 'text', function() {
        echo "nothing";
    });
});
?>