<?php
// this is a class for heading from 1:6, and paragaraphs and spands;
class text {
    protected string $text;

    public function __construct($text='') {
        $this->text = $text;
    }
    public function heading(int $level, $class='', $id='', $style='') {
        echo "<h$level class='$class' id='$id' style='$style'>";
        echo $this->text;
        echo "</h$level>";
    }
    public function paragraph($class='', $id='', $style='') {
        echo "<p class='$class' id='$id' style='$style'>";
        echo $this->text;
        echo "</p>";
    }
    public function span($class='', $id='', $style='') {
        echo "<span class='$class' id='$id' style='$style'>";
        echo $this->text;
        echo "</span>";
    }
}
?>