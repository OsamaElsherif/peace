<?php
// this class is for nav creation
class section {
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
}
?>