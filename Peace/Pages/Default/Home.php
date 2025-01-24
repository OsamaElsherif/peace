<?php
namespace Peace\Pages\Default;

use Peace\Components\Anchor;
use Peace\Components\Heading;
use Peace\Layouts\HomeLayout;
use Peace\Components\Div;
use Peace\Components\Image;
use Peace\Components\Link;

class Home
{
    private static string $imgPath;
    public static function render(){
        HomeLayout::render(
            (
                Div::render("container", null, function () {
                    return Heading::render("text", null, "Welcome in Peace Framework 🕊🎇.", 1);
                }) .
                Div::render("container", null, function () {
                    return "<div>Here is your place for writing a simple php, with Peace core-framework, with no force for any file Arch, <br>
                            you can make ".self::span('(MVC, MVVM, DDD, etc.)', 'options')."want more power! <br>
                            you can use whatever you want ".self::span('template engines, ORMs, Routing systems, etc.', 'options')." <br>
                            just download it and write a bridge to bind it with the CORE Peace system and you will use it as you want. <br>
                            want to go simple ?! easy, use CORE peace systems. <br>
                            want to know more !!</div>";
                }) .
                self::linkSection()
            ),
            [
                Link::render("/assets/css/style.css", "stylesheet")
            ],
            [],
            []);   
    }

    private static function span(string $text, $class): string {
        // custom span element as a function
        return "<span class=$class>$text</span>";
    }

    private static function linkSection() {
        return (
            Div::render("container row", null, function() {
                return (
                    self::roundLinkButton("/assets/images/icons/github.png", "https://github.com/OsamaElsherif") .
                    self::roundLinkButton("/assets/images/icons/medium.png", "https://medium/OsamaElsherif/Peace") .
                    self::roundLinkButton("/assets/images/icons/youtube.png", "https://youtube.com/PeaceFramework")
                );
            })
        );
    }

    private static function roundLinkButton(string $imgPath, string $url) {
        self::$imgPath = $imgPath;
        return (
            Anchor::render("link", null, $url, function() {
                return Div::render("rBtn", null, function() {
                    return Image::render("sm-icon", null, self::$imgPath);
                });
            })
        );
    }
}