<?php
// includeing query type
include_once("types/query.php");

class connection {
    protected string $Driver;
    protected string $servername;
    protected string $database;
    protected $connection;

    public function __construct(string $Driver, string $servername, string $database) {
        $this->Driver = $Driver;
        $this->servername = $servername;
        $this->database = $database;
    }
    // connecting to the database
    public function connect(string $username, string $password): connection {
        $connectin_string = "Driver={$this->Driver};Server=$this->servername;Database=$this->database;";
        $this->connection = odbc_connect($connectin_string, $username, $password);
        
        return $this;
    }
    // closing the connection
    public function close(): void {
        odbc_close($this->connection);
    }
    public function exec(query $sql) {
        $result = odbc_exec($this->connection, $sql->statment);
        
        return $result;
    }
    // destroying the database
    public function destroy(): void {
        $this->close();
        $this->connection = null;
    }
}
?>