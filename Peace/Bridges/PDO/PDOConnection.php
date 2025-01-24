<?php
namespace Peace\Bridges\PDO;

use PDO;
use PDOException;
use Peace\Libs\Config;
use Peace\Libs\Database\Abstract\AbstractConnection;
use Peace\Libs\Database\Interface\ConnectionInterface;

/**
 * Class PDOConnection
 * 
 * This class provides a bridge for connecting to a database using PDO in the Peace framework.
 */
class PDOConnection extends AbstractConnection implements ConnectionInterface {
    private ?PDO $pdo = null;
    
    /**
     * PDOConnection constructor.
     * 
     * @param Config $config Database configuration.
     */
    public function __construct(Config $config) {
        parent::__construct($config);
        
        $this->config = $config;
    }
    
    /**
     * Establishes a connection to the database.
     * 
     * @return bool True on success, throws an exception on failure.
     * @throws \Exception
     */
    public function connect(): bool {
        try{
            $dsn = "{$this->config->get('driver')}:host={$this->config->get('host')};dbname={$this->config->get('database')}";
            $this->pdo = new PDO($dsn, $this->config->get('username'), $this->config->get('password'));
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            
            return true;
        } catch (PDOException $e) {
            throw new \Exception("PDO Connection failed: " . $e->getMessage());
        }
    }

    /**
     * Disconnects from the database.
     */
    public function disconnect(): void {
        $this->pdo = null;
    }

    /**
     * Checks if the connection to the database is established.
     * 
     * @return bool True if connected, false otherwise.
     */
    public function isConnected(): bool {
        return $this->pdo !== null;
    }

    /**
     * Begins a transaction.
     */
    public function beginTransaction(): void {
        $this->pdo->beginTransaction();
    }
    
    /**
     * Commits the current transaction.
     */
    public function commitTransaction(): void {
        $this->pdo->commit();
    }
    
    /**
     * Rolls back the current transaction.
     */
    public function rollbackTransaction(): void {
        $this->pdo->rollBack();
    }
    
    /**
     * Returns the PDO resource.
     * 
     * @return mixed The PDO instance.
     */
    public function getResource(): mixed {
        return $this->pdo;
    }
}