<?php 
Doc::Build($css='pages/style.css', $title='peace framework')->Create('', function() {
    div::Build('container', 'container')->Create('', function() {
        div::Build('nav', 'nav')->Create('background: #2e2e2e; color: #fff;', function() {
            text::Build('title', 'title')->heading(1, "Peace Framework", "text-align: center;");
            text::Build('l', 'l')->paragraph('PHP framework that makes web development more flexible', 'text-align: center;');
        });
        div::Build('body', 'body')->Create('', function() {
            section::Build('sec', 'sec')->Create(function() {
                text::Build('h', 'h')->heading(1, "About Peace", "text-align: center;");
                text::Build('txt', 'txt')->paragraph(
                    '<span class="span">Peace framework</span> is a framework that has sevral reasons to exist, the main 
                    reason is for making php development easier without the weird looking of
                    HTML and PHP in the same page, or the problem of trying to make the seperate
                    with a lot of files in the same site, another reason is JUST FOR FUN, this project
                    poped in my mind while I was playing with PHP codes, and I worked on it, I will add
                    a lot of things to it as I want it to be the main programming platform for me. However,
                    feel free to use it as you want, I will add to it FLASK API handelers for making
                    request and soon DJango and FAST API handelers will be added also.
                    <br>
                    LET PHP DEVELOPERS DEVELOPE IN PEACE.
                    ', 'text-align: center;');
            });
        });
        div::Build('fotter', 'fotter')->Create('background: #2e2e2e; color: #fff;', function() {
            text::Build('cc', 'cc')->heading(2, "made by OsamaElsherif", 'text-align: center;');
            text::Build('l', 'l')->paragraph("MIT Licence", 'text-align: center;');
        });
    });
    script::Build()->Create(function() {
        echo "console.log('here goes the script that you want to create...');";
    });
});
?>