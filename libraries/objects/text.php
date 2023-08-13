<?php
include_once('types/element.php');

// this is a class for heading from 1:6, and paragaraphs and spands;
class text extends element {
    protected string $class;
    protected string $id;

    public function __construct($class='', $id='') {
        $this->class = $class;
        $this->id = $id;
    }
    public function heading(int $level, $text='', $style) {
        echo "<h$level class='$this->class' id='$this->id' style='$style'>";
        echo $text;
        echo "</h$level>";
    }
    public function paragraph($text='', $style='') {
        echo "<p class='$this->class' id='$this->id' style='$style'>";
        echo $text;
        echo "</p>";
    }
    public function span($text='', $style='') {
        echo "<span class='$this->class' id='$this->id' style='$style'>";
        echo $text;
        echo "</span>";
    }
    public function label($text='', $style='') {
        echo "<label class='$this->class' id='$this->id' style='$style'>$text</label>";
    }

    public static function Build($class="", $id="") {
        return new Text($class, $id);
    }
}
?>