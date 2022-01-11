<?php
// this class is for fotter creation
class fotter {
    protected string $class;
    protected string $id;

    public function __construct($class = '', $id = '') {
        $this->class = $class;
        $this->id = $id;
    }
    public function Create($contains) {
        echo "<fotter class='$this->class' id='$this->id'>";
        $contains();
        echo "</fotter>";
    }
}
?>