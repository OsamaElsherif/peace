<?php
namespace Peace\Libs\Database\Interface;

/**
 * Interface EntityManager
 *
 * Provides an interface for managing entities operations.
 */
interface EntityManagerInterface {
    /**
     * Persists an entity to the database.
     * @param object $entity The entity to persist.
     * @return void
     */
    public function persist(object $entity): void;

    /**
     * Removes an entity from the database.
     * @param object $entity The entity to remove.
     * @return void
     */
    public function remove(object $entity): void;

    /**
     * Finds an entity by its primary key.
     * @param string $className The fully qualified class name of the entity.
     * @param mixed $id The primary key value.
     * @return ?object The entity, or null if not found.
     */
    public function find(string $className, mixed $id): ?object;

    /**
     * Gets all entities of a certain type.
     * @param string $className The fully qualified class name of the entity.
     * @return array<object> All found entities.
     */
    public function getAll(string $className): array;

    /**
     * Flushes all persisted changes to the database.
     * @return void
     */
    public function flush(): void;
}