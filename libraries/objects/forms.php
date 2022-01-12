<?php
class form {
    protected string $class = '';
    protected string $id = '';
    protected string $method = '';
    protected string $action = '';

    public function __construct($class = '', $id = '', $method = 'post', $action = '#') {
        $this->class = $class;
        $this->id = $id;
        $this->method = $method;
        $this->action = $action;
    }

    public static function input($class, $id, $name, $type, $contains) {
        echo "<input type='$type' class='$class' id='$id' vlaue='";
        $contains();
        echo "' name='$name'>";
    }
    
    public function Create($contains) {
        echo "<form action='$this->action' method='$this->method' class='$this->class' id='$this->id'>";
        $contains();
        echo "</form>";
    }
}
?>