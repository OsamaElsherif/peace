<?php
// this is a class for anchros <a></a>
class anchor {
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
}
?>