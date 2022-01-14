<?php
include_once('../../objects/script.php');
// include all types
foreach (glob('libraries/JS/Vanilla/types/*.php') as $filename)
{
    include_once($filename);
}

class javascript extends script {
    protected string $script;

    public function __construct($script='', $src='') {
        $this->script = $script;
        $this->src = $src;
    }

    // console log
    public function console_log(string $message): console_log {
        // $this->script = "console.log($message);";
        $cl = new console_log($message);
        return $cl;
    }

    // dom selecting elements
    private function QuerySelector(string $id): string {
        return "document.getElementById('$id')";
    }

    // adding event listeners
    public function addEventLisiner(object $element, string $event, string $function_name): Listener {
        $id = $element->id;
        $domElement = $this->QuerySelector($id);
        $listener = "$domElement.addEventListener('$event', $function_name);";
        $this->script .= $listener;
        $l = new Listener($event, $listener);
        return $l;
    }

    // creating functions
    public function jsfunction(string $function_name, $actions): jsfun {
        $function = "function $function_name() {";
        $args = array_slice(func_get_args(), 1);
        foreach ($args as $script) {
            $function .= $script->script;
        }
        $function .= "}";
        $this->script .= $function;
        $jsfun = new jsfun($function_name, $function);

        return $jsfun;
    }

    // changing the styles
    public function style(object $element, string $property, string $value): jstatment {
        $id = $element->id;
        $domElement = $this->QuerySelector($id);
        $script = "$domElement.style.$property = '$value';";
        $js_statment = new jstatment($script);
        
        return $js_statment;
    }
    
    public function getValue(object $element): jstatment {
        $id = $element->id;
        $domElement = $this->QuerySelector($id);
        $script = "$domElement.value;";
        $js_statment = new jstatment($script);
        
        return $js_statment;
    }

    public function var(string $identifier, jstatment|string $value): jstatment {
        if(is_object($value)) {
            $script = "var $identifier = $value->script";
        } else {
            $script = "var $identifier = $value;";
        }
        $js_statment = new jstatment($script);
        
        return $js_statment;
    }
    
    // runing the final script
    public function run() {
        parent::Create(function() {
            echo $this->script;
        });
    }
}
?>