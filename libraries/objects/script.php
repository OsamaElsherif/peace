<?php
class script {
    protected string $src;

    public function __construct($src='') {
        $this->src = $src;
    }
    
    public function Create($js) {
        if ($src == '') {
            echo "<script>";
            $js();
            echo "</script>";
        } else {
            echo "<script src='$this->src'></script>";
        }
    }

}
?>