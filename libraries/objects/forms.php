<?php
include_once('types/element.php');

class input extends element {
    public string $id;
    public string $class;
    public string $name;
    
    public function __construct($id, $class, $name) {
        $this->id = $id;
        $this->class = $class;
        $this->name = $name;
    } 
}
class form extends element {
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

    public static function input($class, $id, $name, $type, $contains): input {
        echo "<input type='$type' class='$class' id='$id' value='";
        $contains();
        echo "' name='$name'>";
        $input = new input($id, $class, $name);

        return $input;
    }
    
    public function Create($contains) {
        echo "<form action='$this->action' method='$this->method' class='$this->class' id='$this->id'>";
        $contains();
        echo "</form>";

        return $this;
    }
}
?>