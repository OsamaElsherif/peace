<?php
class Listener {
    public string $event;
    public string $listener;

    function __construct($event, $listener) {
        $this->event = $event;
        $this->listener = $listener;
    }
}
?>