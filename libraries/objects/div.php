<?php
// this is a class for creating a <div></div>
class div {
    protected string $class = '';
    protected string $id = '';

    public function __construct($class = '', $id = '') {
        $this->class = $class;
        $this->id = $id;
    }
    public function Create($style='', $contains) {
        echo "<div class='$this->class' id='$this->id' style='$style'>";
        $contains();
        echo "</div>";
    }
}
?>