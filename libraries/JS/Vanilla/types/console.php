<?php
class console {
    function __construct() {
        echo "console";
    }
}
class console_log extends console {
    public string $msg = '';
    public string $script;

    public function __construct($msg) {
        $this->msg = $msg;
        $this->script = "console.log('$this->msg')";
    }
}
?>