<?php
namespace Peace\Libs\Database\Interface;

/**
 * Interface Connection
 *
 * Provides an interface for Database connections.
 */
interface ConnectionInterface {
    /**
     * Establishes a connection to the database.
     * @return bool True on successful connection, false otherwise.
     * @throws \Exception If the connection fails.
     */
    public function connect(): bool;

    /**
     * Disconnects from the database.
     * @return void
     */
    public function disconnect(): void;

    /**
     * Checks if the connection is currently active.
     * @return bool
     */
    public function isConnected(): bool;

    /**
     * Returns the underlying connection resource (e.g., PDO instance).
     * @return mixed The connection resource.
     */
    public function getResource(): mixed;

    /**
     * Begins a database transaction.
     * @return void
     * @throws \Exception If starting the transaction fails.
     */
    public function beginTransaction(): void;

    /**
     * Commits the current database transaction.
     * @return void
     * @throws \Exception If committing the transaction fails.
     */
    public function commitTransaction(): void;

    /**
     * Rolls back the current database transaction.
     * @return void
     * @throws \Exception If rolling back the transaction fails.
     */
    public function rollbackTransaction(): void;
}