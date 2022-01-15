<?php
include_once('types/element.php');

// these classes are for table creations
class table extends element {
    protected string $class;
    private array $data = array();
    private $key = '';
    private $crow = '';
    private $cvalue = '';
    protected string $id;

    public function __construct(string $class, string $id) {
        $this->class = $class;
        $this->id = $id;
    }
    // head of the table
    public static function thead(string $class,string $id, $contains) {
        echo "<thead class='$class' id='$id'>";
        $contains();
        echo "</thead>";
    }
    // body of the table
    public static function tbody(string $class,string $id, $contains) {
        echo "<tbody class='$class' id='$id'>";
        $contains();
        echo "</tbody>";
    }
    // row in the table
    public static function tr(string $class, string $id, $contains) {
        echo "<tr class='$class' id='$id'>";
        $contains();
        echo "</tr>";
    }
    // cell in the table
    public static function td(string $class, string $id, $contains) {
        echo "<td class='$class' id='$id'>";
        $contains();
        echo "</td>";
    }
    // create the table
    public function Create($contains): table {
        echo "<table class='$this->class' id='$this->id'>";
        $contains();
        echo "</table>";
    }
    // auto create table from a database
    public function autoCreate(array $data): table {
        $this->data = $data;
        echo "<table class='$this->class' id='$this->id'>";
        self::thead('thead_class', 'thead_id', function () {
            self::tr('row_class', 'row_id', function () {
                $keys = array_keys($this->data[0]);
                foreach ($keys as $key) {
                    $this->key = $key;
                    self::td('cell_class', 'cell_id', function () {
                        echo "$this->key";
                    });
                }
            });
        });
        self::tbody('tbody_class', 'tbody_id', function () {
            foreach ($this->data as $row) {
                $this->crow = $row;
                self::tr('row_class', 'row_id', function () {
                    foreach ($this->crow as $value) {
                        $this->cvalue = $value;
                        self::td('cell_class', 'cell_id', function () {
                            echo "$this->cvalue";
                        });
                    }
                });
            }
        });
        echo "</table>";

        return $this;
    }
}
// class thead  extends element{
//     protected string $class;
//     protected string $id;

//     public function __construct($class = '', $id = '') {
//         $this->class = $class;
//         $this->id = $id;
//     }
//     public function Create($contains) {
//         echo "<thead class='$this->class' id='$this->id'>";
//         $contains();
//         echo "</thead>";
//     }
// }
// class tbody extends element {
//     protected string $class;
//     protected string $id;

//     public function __construct($class = '', $id = '') {
//         $this->class = $class;
//         $this->id = $id;
//     }
//     public function Create($contains) {
//         echo "<tbody class='$this->class' id='$this->id'>";
//         $contains();
//         echo "</tbody>";
//     }
// }
// class tr {
//     protected string $class;
//     protected string $id;

//     public function __construct($class = '', $id = '') {
//         $this->class = $class;
//         $this->id = $id;
//     }
//     public function Create($contains) {
//         echo "<tr class='$this->class' id='$this->id'>";
//         $contains();
//         echo "</tr>";
//     }
// }
// class td {
//     protected string $class;
//     protected string $id;

//     public function __construct($class = '', $id = '') {
//         $this->class = $class;
//         $this->id = $id;
//     }
//     public function Create($contains) {
//         echo "<td class='$this->class' id='$this->id'>";
//         $contains();
//         echo "</td>";
//     }
// }
?>