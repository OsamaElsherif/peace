<?php
// this class is for header creation
class header {
    protected string $class;
    protected string $id;

    public function __construct($class = '', $id = '') {
        $this->class = $class;
        $this->id = $id;
    }
    public function Create($contains) {
        echo "<header class='$this->class' id='$this->id'>";
        $contains();
        echo "</header>";
    }
}
?>