<?php
include_once('types/element.php');

// this class is for nav creation
class section extends element {
    protected string $class;
    protected string $id;

    public function __construct($class = '', $id = '') {
        $this->class = $class;
        $this->id = $id;
    }
    public function Create($contains) {
        echo "<section class='$this->class' id='$this->id'>";
        $contains();
        echo "</section>";
    }

    public static function Build($class="", $id="") {
        return new section($class, $id);
    }
}
?>