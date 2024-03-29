<?php
include_once('types/element.php');

// this class is for nav creation
class nav extends element{
    protected string $class;
    protected string $id;

    public function __construct($class = '', $id = '') {
        $this->class = $class;
        $this->id = $id;
    }
    public function Create($contains) {
        echo "<nav class='$this->class' id='$this->id'>";
        $contains();
        echo "</nav>";
    }

    public static function Build($class="", $id="") {
        return new nav($class, $id);
    }
}
?>