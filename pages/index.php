<?php 
$doc = new Doc($css='pages/style.css', $title='peace framework');
$doc->Create('', function() {
    $container = new div('container', 'container');
    $container->Create('', function() {
        $nav = new div('nav', 'nav');
        $nav->Create('background: #2e2e2e; color: #fff;', function() {
            $title = new text('Peace Framework');
            $desc = new text('PHP framework that makes web development more flexible');
            $title->heading(1, 'title', 'title', 'text-align: center;');
            $desc->paragraph('l', 'l', 'text-align: center;');
        });
        $body = new div('body', 'body');
        $body->Create('', function() {
            $description = new section('sec', 'sec');
            $description->Create(function() {
                $heading = new text('About Peace');
                $heading->heading(1, 'h', 'h', 'text-align: center;');
                $text = new text('
                <span class="span">Peace framework</span> is a framework that has sevral reasons to exist, the main 
                reason is for making php development easier without the weird looking of
                HTML and PHP in the same page, or the problem of trying to make the seperate
                with a lot of files in the same site, another reason is JUST FOR FUN, this project
                poped in my mind while I was playing with PHP codes, and I worked on it, I will add
                a lot of things to it as I want it to be the main programming platform for me. However,
                feel free to use it as you want, I will add to it FLASK API handelers for making
                request and soon DJango and FAST API handelers will be added also.
                <br>
                LET PHP DEVELOPERS DEVELOPE IN PEACE.
                ');
                $text->paragraph('txt', 'txt', 'text-align: center;');
            });
        });
        $fotter = new div('fotter', 'fotter');
        $fotter->Create('background: #2e2e2e; color: #fff;', function() {
            $copyright = new text('made by kazagashi');
            $license = new text('MIT Licesnce');
            $copyright->heading(2, 'cc', 'cc', 'text-align: center');
            $license->paragraph('l', 'l', 'text-align: center');
        });
    });
    $script = new script();
    $script->Create(function() {
        echo "console.log('here goes the script that you want to create...');";
    });
});
?>