<?php
Doc::Build($css='pages/style.css', $title="testing", $script="")->Create("", function() {
    div::Build("divy", "divid")->Create("", function() {
        anchor::Build("anchor", "anchorid")->Create("localhost:80", function() {
            echo "Hooy!";
        }); // .anchor
        form::Build("formy", "formid", "post", "#")->Create(function() {
            form::input("inputy", "inputid", "name", "text", function() {});
        }); // .formy 
    }); // .divy
    text::Build("texty", "textid")->heading(2, "Hello, World!", ""); // h2
    text::Build("texty", "textid")->span("Hello, World! from a span!", ""); // span
    text::Build("texty", "textid")->paragraph("Hello, World! from a paragraph!", ""); // paragraph
    text::Build("texty", "textid")->label("Hello, World! from a label!", ""); // label
}); // Doc
?>