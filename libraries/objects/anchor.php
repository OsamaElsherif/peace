<?php
include_once('types/element.php');

// this is a class for anchros <a></a>
class anchor extends element {
    protected string $class;
    protected string $id;

    public function __construct($class = '', $id = '') {
        $this->class = $class;
        $this->id = $id;
    }
    public function Create($link, $contains) {
        echo "<a href='$link' class='$this->class' id='$this->id'>";
        $contains();
        echo "</a>";
    }

    public static function Build($class="", $id="") {
        return new anchor($class, $id);
    }
}
?>