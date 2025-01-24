<?php
namespace Peace\Libs\CoreORM\Abstract;

use Peace\Libs\Database\Interface\EntityManagerInterface;
use ReflectionClass;
use Peace\Libs\Database\Interface\ConnectionInterface;

abstract class AbstractCoreORM implements EntityManagerInterface {
    protected ConnectionInterface $connection;

    public function __construct(ConnectionInterface $connection) {
        $this->connection = $connection;
    }

    /**
     * Persists an entity to the database.
     * @param object $entity The entity to persist.
     * @return void
     */
    abstract public function persist(object $entity): void;

    /**
     * Removes an entity from the database.
     * @param object $entity The entity to remove.
     * @return void
     */
    abstract public function remove(object $entity): void;

    /**
     * Finds an entity by its primary key.
     * @param string $className The fully qualified class name of the entity.
     * @param mixed $id The primary key value.
     * @return ?object The entity, or null if not found.
     */
    abstract public function find(string $className, mixed $id): ?object;

    /**
     * Gets all entities of a cretain type
     * @param string $className The fully qualified class name of the entity.
     * @return array<object> All found entities.
     */
    abstract public function getAll(string $className): array;

    /**
     * Returns the current database connection.
     * @return ConnectionInterface The database connection instance.
     */
    public function getConnection(): ConnectionInterface {
        return $this->connection;
    }

    /**
     * Generates table name from an entity object.
     * Converts the class name to lowercase plural form.
     * 
     * @param object $entity The entity object.
     * @return string The generated table name.
     */
    protected function getTableName(object $entity): string {
        $className = (new ReflectionClass($entity))->getShortName();
        return strtolower($className) . 's';
    }

    /**
     * Generates table name from a class name string.
     * Converts the class name to lowercase plural form.
     * 
     * @param string $className The fully qualified class name.
     * @return string The generated table name.
     */
    protected function getTableNameFromClassName(string $className): string {
        $className = substr($className, strrpos($className, '\\') + 1);
        return strtolower($className) . 's';
    }

    public function flush(): void {
        
    }
}