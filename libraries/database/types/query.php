<?php
class query {
    public string $statment;

    public function __construct(string $statment) {
        $this->statment = $statment;
    }

    public static function fetchAll($exec, string $type='array') {
        $res = array();
        while ($row = odbc_fetch_array($exec)) {
            $res[] = $row;
        }
        if ($type == 'array') {
            return $res;
        } elseif ($type == 'json') {
            return json_encode($res);
        }
    }
    
    public static function fetch($exec) {
        return odbc_fetch_object($exec);
    }
}
?>