<?php
// this is a class that creates the html:5 main structure
class Doc {
    protected string $css = '';
    protected string $script = '';
    protected string $title = '';

    public function __construct($css='', $script='', $title='') {
        $this->css = $css;
        $this->script = $script;
        $this->title = $title;
    }
    private function head() {
        echo '<head>';
        echo "<link rel='stylesheet' href='$this->css'>";
        echo "<script src='$this->script'></script>";
        echo "<title>$this->title</title>";
        echo '</head>';
    }
    private function body($class= '', $contains) {
        echo "<body class='$class'>";
        $contains();
        echo "</body>";
    }
    public function Create($body_class='', $contains) {
        echo "<html>";
        $this->head();
        $this->body($body_class, $contains());
        echo "<html>";
    }

    public static function Build($css='', $script='', $title='') {
        return new Doc($css, $script, $title);
    }
}
?>