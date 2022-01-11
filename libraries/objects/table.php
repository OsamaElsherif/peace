<?php
// these classes are for table creations
class table {
    protected string $class;
    protected string $id;

    public function __construct($class = '', $id = '') {
        $this->class = $class;
        $this->id = $id;
    }
    public function Create($contains) {
        echo "<table class='$this->class' id='$this->id'>";
        $contains();
        echo "</table>";
    }
}
class thead {
    protected string $class;
    protected string $id;

    public function __construct($class = '', $id = '') {
        $this->class = $class;
        $this->id = $id;
    }
    public function Create($contains) {
        echo "<thead class='$this->class' id='$this->id'>";
        $contains();
        echo "</thead>";
    }
}
class tbody {
    protected string $class;
    protected string $id;

    public function __construct($class = '', $id = '') {
        $this->class = $class;
        $this->id = $id;
    }
    public function Create($contains) {
        echo "<tbody class='$this->class' id='$this->id'>";
        $contains();
        echo "</tbody>";
    }
}
class tr {
    protected string $class;
    protected string $id;

    public function __construct($class = '', $id = '') {
        $this->class = $class;
        $this->id = $id;
    }
    public function Create($contains) {
        echo "<tr class='$this->class' id='$this->id'>";
        $contains();
        echo "</tr>";
    }
}
class td {
    protected string $class;
    protected string $id;

    public function __construct($class = '', $id = '') {
        $this->class = $class;
        $this->id = $id;
    }
    public function Create($contains) {
        echo "<td class='$this->class' id='$this->id'>";
        $contains();
        echo "</td>";
    }
}
?>