<?php
namespace Peace\Libs\Database\Abstract;

use Peace\Libs\Database\Interface\EntityManagerInterface;

/**
 * Abstract class that defines the basic operations for an entity manager.
 */
abstract class AbstractEntityManager implements EntityManagerInterface {
    /**
     * Persists an entity to the database.
     *
     * @param object $entity The entity to persist.
     */
    abstract public function persist(object $entity): void;

    /**
     * Removes an entity from the database.
     *
     * @param object $entity The entity to remove.
     */
    abstract public function remove(object $entity): void;

    /**
     * Finds an entity by its identifier.
     *
     * @param string $className The class name of the entity.
     * @param mixed $id The identifier of the entity.
     * @return object|null The found entity or null if not found.
     */
    abstract public function find(string $className, mixed $id): ?object;

    /**
     * Retrieves all entities of a given class.
     *
     * @param string $className The class name of the entities.
     * @return array An array of entities.
     */
    abstract public function getAll(string $className): array;

    /**
     * Flushes all changes to the database.
     */
    abstract public function flush(): void;
}