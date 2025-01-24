<?php
namespace Peace\Bridges\EntityManager;

use PDO;
use Peace\Libs\Database\Interface\ConnectionInterface;
use Peace\Libs\Database\Interface\EntityManagerInterface;
use ReflectionClass;
use ReflectionProperty;

class PeaceEntityManager implements EntityManagerInterface
{
    private ConnectionInterface $connection;

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function persist(object $entity): void
    {
        $reflectionClass = new ReflectionClass($entity);
        $tableName = $this->getTableNameFromEntity($entity);
        $properties = $reflectionClass->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_PRIVATE);

        $fields = [];
        $values = [];
        $params = [];

        $id = null;
        foreach ($properties as $property) {
            $property->setAccessible(true);
            $fieldName = $property->getName();
            $fieldValue = $property->getValue($entity);

            // Assuming 'id' is auto-increment and should be excluded from INSERT
            if ($fieldName === 'id') {
                $id = $fieldValue;
                continue;
            }

            $fields[] = $fieldName;
            $values[] = '?';
            $params[] = $fieldValue;
        }

        if ($id === null) {
            // perform Insert
            $sql = sprintf(
                'INSERT INTO %s (%s) VALUES (%s)',
                $tableName,
                implode(', ', $fields),
                implode(', ', $values)
            );
        } else {
            // perform Update
            $setClauses = [];
            foreach ($fields as $field) {
                $setClauses[] = "$field = ?";
            }
            $sql = sprintf(
                'UPDATE %s SET %s WHERE id = ?',
                $tableName,
                implode(', ', $setClauses)
            );
            $params[] = $id;
        }

        try {
            $stmt = $this->connection->getResource()->prepare($sql);
            $stmt->execute($params);

             if ($id === null) {
                // If it's an insert, get the last inserted ID and set it on the entity
                $entity->id = $this->connection->getResource()->lastInsertId();
            }
        } catch (\PDOException $e) {
            throw new \Exception("Error persisting entity: " . $e->getMessage());
        }
    }

    public function remove(object $entity): void
    {
        $reflectionClass = new ReflectionClass($entity);
        $tableName = $this->getTableNameFromEntity($entity);
        $id = null;

        $properties = $reflectionClass->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_PRIVATE);

        foreach ($properties as $property) {
            $property->setAccessible(true);
            $fieldName = $property->getName();
            $fieldValue = $property->getValue($entity);

            if ($fieldName === 'id') {
                $id = $fieldValue;
                break;
            }
        }

        if ($id === null) {
            throw new \Exception("Entity has no ID, cannot remove.");
        }

        $sql = sprintf('DELETE FROM %s WHERE id = ?', $tableName);

        try {
            $stmt = $this->connection->getResource()->prepare($sql);
            $stmt->execute([$id]);
        } catch (\PDOException $e) {
            throw new \Exception("Error removing entity: " . $e->getMessage());
        }
    }

    public function find(string $className, mixed $id): ?object
    {
        $tableName = $this->getTableNameFromClassName($className);

        $sql = sprintf('SELECT * FROM %s WHERE id = ?', $tableName);

        try {
            $stmt = $this->connection->getResource()->prepare($sql);
            $stmt->execute([$id]);
            $stmt->setFetchMode(PDO::FETCH_CLASS, $className);
            $entity = $stmt->fetch();

            return $entity ?: null;
        } catch (\PDOException $e) {
            throw new \Exception("Error finding entity: " . $e->getMessage());
        }
    }

    public function getAll(string $className): array
    {
        $tableName = $this->getTableNameFromClassName($className);

        $sql = sprintf('SELECT * FROM %s', $tableName);

        try {
            $stmt = $this->connection->getResource()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS, $className);
        } catch (\PDOException $e) {
            throw new \Exception("Error getting all entities: " . $e->getMessage());
        }
    }

    public function flush(): void
    {
        // BasicEntityManager doesn't implement Unit of Work, so nothing to flush
    }

    private function getTableNameFromEntity(object $entity): string
    {
        $className = (new ReflectionClass($entity))->getShortName();
        return strtolower($className) . 's';
    }

    private function getTableNameFromClassName(string $className): string
    {
        $className = substr($className, strrpos($className, '\\') + 1);
        return strtolower($className) . 's';
    }
}