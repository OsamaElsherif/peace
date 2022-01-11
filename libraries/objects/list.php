<?php
// this is a class for <ul></ul>
class ul {
    protected string $class;
    protected string $id;

    public function __construct($class = '', $id = '') {
        $this->class = $class;
        $this->id = $id;
    }
    public function Create($contains) {
        echo "<ul class='$this->class' id='$this->id'>";
        $contains();
        echo "</ul>";
    }
}
// this is a class for <li></li>
class li {
    protected string $class;
    protected string $id;

    public function __construct($class = '', $id = '') {
        $this->class = $class;
        $this->id = $id;
    }
    public function Create($contains) {
        echo "<li class='$this->class' id='$this->id'>";
        $contains();
        echo "</li>";
    }
}
?>